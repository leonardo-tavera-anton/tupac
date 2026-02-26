import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { Router, RouterModule } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './login.html',
  styleUrl: './login.scss'
})
export class Login {
  // Sincronizado con el controlador de Laravel
  user = { nombre: '', password: '' };

  constructor(private auth: AuthService, private router: Router) {}

  onLogin() {
    // Validamos que los campos no estén vacíos antes de enviar
    if (!this.user.nombre || !this.user.password) {
      alert('Por favor, completa todos los campos');
      return;
    }

    this.auth.login(this.user).subscribe({
      next: (res: any) => {
        /** * MEJORA: Guardamos la sesión para que "Tramites" la reconozca.
         * Guardamos el objeto con el nombre que el usuario ingresó.
         */
        const sessionData = { 
          nombre: this.user.nombre,
          fecha: new Date().toISOString() 
        };
        
        localStorage.setItem('user_session', JSON.stringify(sessionData));

        // Si tu backend devuelve un token, también lo guardamos aquí
        if (res.token) {
          localStorage.setItem('user_token', res.token);
        }

        this.router.navigate(['/tupa']); 
      },
      error: (err: any) => {
        console.error('Error de login:', err);
        // Manejo de errores más amigable
        const msg = err.error?.message || 'Nombre o contraseña incorrectos';
        alert(msg);
      }
    });
  }
}