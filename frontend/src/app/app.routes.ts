import { Routes } from '@angular/router';
import { Login } from './pages/login/login';
import { Tupa } from './pages/tupa/tupa';
import { Register } from './pages/register/register'; // 1. Importa el componente

export const routes: Routes = [
  { path: 'login', component: Login },
  { path: 'register', component: Register }, // 2. Añade la ruta de registro
  { path: 'tupa', component: Tupa },
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: '**', redirectTo: 'login' } 
];