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
  user = { nombre: '', password: '' };

  constructor(private auth: AuthService, private router: Router) {}

  onLogin() {
    if (!this.user.nombre || !this.user.password) {
      alert('Por favor, completa todos los campos');
      return;
    }

    this.auth.login(this.user).subscribe({
      next: (res: any) => {
        // GUARDADO DINÁMICO: Guardamos lo que el usuario escribió
        const sessionData = { 
          nombre: this.user.nombre,
          fecha: new Date().toISOString() 
        };
        
        localStorage.setItem('user_session', JSON.stringify(sessionData));

        if (res.token) {
          localStorage.setItem('user_token', res.token);
        }

        this.router.navigate(['/tupa']); 
      },
      error: (err: any) => {
        alert('Nombre o contraseña incorrectos');
      }
    });
  }
}