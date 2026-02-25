import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { TupaService } from '../../services/tupa.service';
import { AuthService } from '../../services/auth.service';

export interface Requisito {
  id: number;
  descripcion: string;
  importe: number | string;
  factor: number | string;
  orden: number;
}

export interface Tramite {
  id_tramite: number;
  codigo_tupa: string | null;
  nombre_tramite: string;
  requisitos: Requisito[];
  area?: any; // Añadido para procesar la respuesta de Laravel
}

export interface Area {
  id: number;
  nombre: string;
  tramites: Tramite[];
}

@Component({
  selector: 'app-tupa',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './tupa.html',
  styleUrls: ['./tupa.scss']
})
export class Tupa implements OnInit {
  areas: Area[] = [];
  areaSeleccionada: Area | null = null;
  tramiteSeleccionado: Tramite | null = null; 
  loading: boolean = false;

  constructor(
    private tupaService: TupaService,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos(): void {
    this.loading = true;
    this.tupaService.getTupaCompleto().subscribe({
      next: (res: any) => {
        const data = res.data ? res.data : res;
        
        // Magia: Si Laravel mandó los 430 trámites sueltos, los agrupamos por Área
        if (data.length > 0 && data[0].nombre_tramite) {
          this.areas = this.agruparPorArea(data);
        } else {
          // Si Laravel ya los mandó agrupados
          this.areas = data;
        }

        this.loading = false;
        console.log('Áreas procesadas para el HTML:', this.areas);
      },
      error: (err: any) => {
        console.error('Error al cargar TUPA:', err);
        this.loading = false;
      }
    });
  }

  /**
   * FUNCIÓN NUEVA: Toma los 430 trámites y crea carpetas (Áreas) con sus trámites dentro
   */
  private agruparPorArea(tramites: Tramite[]): Area[] {
    const areasMap = new Map<number, Area>();

    tramites.forEach(t => {
      // Si el trámite no trae la información del área, lo saltamos
      if (!t.area) return;

      // Si el área no existe en nuestro mapa, la creamos
      if (!areasMap.has(t.area.id)) {
        areasMap.set(t.area.id, {
          id: t.area.id,
          nombre: t.area.nombre,
          tramites: []
        });
      }

      // Metemos el trámite dentro de su área correspondiente
      areasMap.get(t.area.id)?.tramites.push(t);
    });

    // Convertimos el mapa de nuevo a un Array normal para el HTML
    return Array.from(areasMap.values());
  }

  seleccionarArea(area: Area): void {
    this.areaSeleccionada = area;
    this.tramiteSeleccionado = null; 
  }

  seleccionarTramite(tramite: Tramite): void {
    this.tramiteSeleccionado = tramite;
  }

  get tramitesFiltrados(): Tramite[] {
    return this.areaSeleccionada?.tramites || [];
  }

  calcularTotal(requisitos: Requisito[] | undefined): number {
    if (!requisitos || requisitos.length === 0) return 0;
    return requisitos.reduce((acc, curr) => {
      const monto = typeof curr.importe === 'string' ? parseFloat(curr.importe) : curr.importe;
      return acc + (monto || 0);
    }, 0);
  }

  toNumber(valor: number | string | undefined): number {
    if (!valor) return 0;
    return typeof valor === 'string' ? parseFloat(valor) : valor;
  }

  logout(): void {
    this.authService.logout();
    this.router.navigate(['/login']);
  }
}