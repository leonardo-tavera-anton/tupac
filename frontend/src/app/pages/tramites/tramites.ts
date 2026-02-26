import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tramites',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './tramites.html',
  styleUrls: ['./tramites.scss']
})
export class Tramites implements OnInit {
  guardados: any[] = [];
  nombreUsuario: string = 'Leonardo'; // Valor por defecto

  constructor(private router: Router) {}

  ngOnInit(): void {
    this.cargarDatos();
    this.cargarUsuario();
  }

  cargarUsuario() {
    // Intentamos obtener el nombre del usuario logueado
    const userSession = localStorage.getItem('user_session'); // Ajusta según tu llave de login
    if (userSession) {
      const user = JSON.parse(userSession);
      this.nombreUsuario = user.nombre || 'Leonardo';
    }
  }

  cargarDatos() {
    const data = localStorage.getItem('tupa_fav_2026');
    if (data) {
      this.guardados = JSON.parse(data);
    }
  }

  // Eliminamos usando el id_unico generado en tupa.ts
  eliminarTramite(idUnico: number) {
    if (confirm('¿Desea eliminar esta selección de sus favoritos?')) {
      this.guardados = this.guardados.filter(t => t.id_unico !== idUnico);
      localStorage.setItem('tupa_fav_2026', JSON.stringify(this.guardados));
    }
  }

  volverAlPortal() {
    this.router.navigate(['/tupa']);
  }
}