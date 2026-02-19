import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
// RUTA CORREGIDA:
import { AuthService } from './services/auth.service';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './app.html', // Cambiado para que coincida con tu carpeta
  styleUrls: ['./app.scss']  // Cambiado para que coincida con tu carpeta
})
export class LoginComponent {
  credentials = { dni: '', password: '' };
  errorMessage: string = '';

  constructor(private authService: AuthService, private router: Router) {}

  onSubmit(): void {
    this.authService.login(this.credentials).subscribe({
      next: () => this.router.navigate(['/tupa']),
      error: () => this.errorMessage = 'Error en el login'
    });
  }
}