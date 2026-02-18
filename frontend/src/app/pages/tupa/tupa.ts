import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { TupaService } from '../../services/tupa.service';

@Component({
  selector: 'app-tupa',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './tupa.html',
  styleUrls: ['./tupa.scss']
})
export class TupaComponent implements OnInit {
  areas: any[] = [];
  filterText: string = '';
  areaSeleccionada: any = null; // Controla el área activa

  constructor(private tupaService: TupaService) {}

  ngOnInit(): void {
    this.tupaService.getTupaCompleto().subscribe({
      next: (res: any) => {
        this.areas = res.data ? res.data : res;
      },
      error: (err: any) => console.error('Error:', err)
    });
  }

  // Al hacer clic en un área del primer listado
  seleccionarArea(area: any) {
    this.areaSeleccionada = area;
  }

  // Filtrado global por texto (si el usuario busca algo específico directamente)
  get tramitesFiltrados() {
    if (!this.areaSeleccionada) return [];
    if (!this.filterText.trim()) return this.areaSeleccionada.tramites;

    const search = this.filterText.toLowerCase();
    return this.areaSeleccionada.tramites.filter((t: any) =>
      (t.nombre_tramite || '').toLowerCase().includes(search)
    );
  }
}