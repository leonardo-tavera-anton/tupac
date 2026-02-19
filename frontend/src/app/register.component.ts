import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { AuthService } from '../../../core/services/auth.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent {
  userData = {
    nombre: '',
    dni: '',
    password: '',
    password_confirmation: ''
  };
  errorMessage: string = '';

  constructor(private authService: AuthService, private router: Router) {}

  onSubmit(): void {
    if (this.userData.password !== this.userData.password_confirmation) {
      this.errorMessage = 'Las contraseñas no coinciden.';
      return;
    }

    this.authService.register(this.userData).subscribe({
      next: () => {
        this.router.navigate(['/tupa']);
      },
      error: (err) => {
        this.errorMessage = 'Error en el registro. Verifique los datos (el DNI puede ya estar en uso).';
        console.error('Error en el registro:', err);
      }
    });
  }
}