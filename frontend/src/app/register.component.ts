import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
// RUTA CORREGIDA:
import { AuthService } from './services/auth.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './app.html', 
  styleUrls: ['./app.scss']
})
export class RegisterComponent {
  userData = { nombre: '', dni: '', password: '', password_confirmation: '' };
  // ... resto de tu lógica de registro
} // <--- Cierra la llave correctamente