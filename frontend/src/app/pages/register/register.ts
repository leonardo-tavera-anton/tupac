import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { Router, RouterModule } from '@angular/router';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './register.html',
  styleUrl: './register.scss'
})
export class Register {
  newUser = {
    nombre: '',
    correo: '',
    password: ''
  };

  constructor(private auth: AuthService, private router: Router) {}

  onRegister() {
    this.auth.register(this.newUser).subscribe({
      next: (res: any) => {
        alert('¡Registrado con éxito!');
        this.router.navigate(['/login']);
      },
      error: (err: any) => {
        console.error(err);
        alert('Error: Datos inválidos o correo duplicado');
      }
    });
  }
}
