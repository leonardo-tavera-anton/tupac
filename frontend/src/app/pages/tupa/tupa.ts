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
  filterText: string = '';
  areaSeleccionada: any = null;

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

  seleccionarArea(area: any): void {
    this.areaSeleccionada = area;
  }

  get tramitesFiltrados(): any[] {
    if (!this.areaSeleccionada || !this.areaSeleccionada.tramites) {
      return [];
    }
    
    if (!this.filterText.trim()) {
      return this.areaSeleccionada.tramites;
    }

    const search = this.filterText.toLowerCase();
    return this.areaSeleccionada.tramites.filter((t: any) =>
      (t.nombre_tramite || '').toLowerCase().includes(search)
    );
  }
}