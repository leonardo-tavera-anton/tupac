import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { TupaService } from '../../services/tupa.service';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-tupa',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './tupa.html',
  styleUrls: ['./tupa.scss']
})
export class Tupa implements OnInit {
  areas: any[] = [];
  
  // Nuestras dos variables principales para los Combobox
  areaSeleccionada: any = null;
  tramiteSeleccionado: any = null; 

  constructor(
    private tupaService: TupaService,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos(): void {
    this.tupaService.getTupaCompleto().subscribe({
      next: (res: any) => {
        // Adaptamos según la estructura que devuelva tu API
        this.areas = res.data ? res.data : res;
      },
      error: (err: any) => {
        console.error('Error al cargar TUPA:', err);
      }
    });
  }

  logout(): void {
    this.authService.logout();
    this.router.navigate(['/login']);
  }

  // --- NUEVA LÓGICA PARA LOS COMBOBOX ---

  // 1. Al elegir un área en el primer select
  seleccionarArea(area: any): void {
    this.areaSeleccionada = area;
    // Reseteamos el trámite para que el segundo select se limpie automáticamente
    this.tramiteSeleccionado = null; 
  }

  // 2. Al elegir un trámite en el segundo select
  seleccionarTramite(tramite: any): void {
    this.tramiteSeleccionado = tramite;
  }

  // 3. Obtenemos los trámites del área para llenar el segundo select
  get tramitesFiltrados(): any[] {
    if (!this.areaSeleccionada || !this.areaSeleccionada.tramites) {
      return [];
    }
    // Como ya no usamos barra de búsqueda, simplemente devolvemos la lista completa del área
    return this.areaSeleccionada.tramites;
  }
  
}