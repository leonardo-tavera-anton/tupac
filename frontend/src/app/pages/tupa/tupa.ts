import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
<<<<<<< HEAD
import { FormsModule } from '@angular/forms';
import { TupaService } from '../../services/tupa.service';
=======
import { TupaService } from '../../services/tupa.service'; // Asegúrate de que apunte al archivo .service
>>>>>>> aa2fccf0d093e4b2c927b6f4cc309afe767a5bb5

@Component({
  selector: 'app-tupa',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './tupa.html',
  styleUrls: ['./tupa.scss']
})
<<<<<<< HEAD
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
=======
export class Tupa implements OnInit {
  // Esto quita el error de "Property tramites does not exist"
  tramites: any[] = [];

  constructor(private tupaService: TupaService) {}

  // Esto quita el error de "Property ngOnInit does not exist"
  ngOnInit(): void {
    this.tupaService.getTramites().subscribe({
      next: (data: any) => {
        this.tramites = data;
      },
      error: (err: any) => {
        console.error('Error en el servicio:', err);
      }
>>>>>>> aa2fccf0d093e4b2c927b6f4cc309afe767a5bb5
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