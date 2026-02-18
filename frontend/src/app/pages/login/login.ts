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
    this.auth.login(this.user).subscribe({
      next: (res: any) => {
        this.router.navigate(['/tupa']); 
      },
      error: (err: any) => {
        console.error('Error de login:', err);
        alert('Nombre o contraseña incorrectos');
      }
    });
  }
}