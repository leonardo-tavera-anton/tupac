import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TupaService } from '../../services/tupa.service'; // Sin el .ts al final

@Component({
  selector: 'app-tupa',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './tupa.html',
  styleUrl: './tupa.scss'
})
export class Tupa implements OnInit {
  // Define esta variable para que tupa.html no de error
  tramites: any[] = [];

  constructor(private tupaService: TupaService) {}

  // Define esta función para el botón (click)
  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos(): void {
    this.tupaService.getTramites().subscribe({
      next: (data: any) => this.tramites = data,
      error: (err: any) => console.error('Error:', err)
    });
  }
}