import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TupaService } from '../../services/tupa.service'; // Asegúrate de que apunte al archivo .service

@Component({
  selector: 'app-tupa',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './tupa.html',
  styleUrl: './tupa.scss'
})
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
    });
  }
}