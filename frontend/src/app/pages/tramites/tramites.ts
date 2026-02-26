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
  nombreUsuario: string = '';

  constructor(private router: Router) {}

  ngOnInit(): void {
    this.cargarUsuarioYDatos();
  }

  cargarUsuarioYDatos() {
    const userSession = localStorage.getItem('user_session');
    if (userSession) {
      const user = JSON.parse(userSession);
      this.nombreUsuario = user.nombre;
      
      const data = localStorage.getItem('tupa_fav_2026');
      if (data) {
        const todosLosTramites = JSON.parse(data);
        // FILTRO: Solo mostramos lo que pertenece al ciudadano logueado
        this.guardados = todosLosTramites.filter((t: any) => t.usuario_dueno === this.nombreUsuario);
      }
    } else {
      this.router.navigate(['/login']);
    }
  }

  eliminarTramite(idUnico: number) {
    if (confirm('¿Desea eliminar esta selección de sus favoritos?')) {
      const todos = JSON.parse(localStorage.getItem('tupa_fav_2026') || '[]');
      const actualizados = todos.filter((t: any) => t.id_unico !== idUnico);
      localStorage.setItem('tupa_fav_2026', JSON.stringify(actualizados));
      this.cargarUsuarioYDatos(); // Recarga la lista filtrada
    }
  }

  volverAlPortal() {
    this.router.navigate(['/tupa']);
  }
}