import { Routes } from '@angular/router';
import { authGuard } from './core/guards/auth.guard';

export const routes: Routes = [
  {
    path: 'login',
    loadComponent: () => import('./pages/auth/login.component').then(m => m.LoginComponent)
  },
  {
    path: 'register',
    loadComponent: () => import('./pages/auth/register.component').then(m => m.RegisterComponent)
  },
  {
    path: 'tupa',
    loadComponent: () => import('./pages/tupa/tupa.component').then(m => m.TupaComponent),
    canActivate: [authGuard] // ¡Ruta protegida!
  },
  // Redirección por defecto a la página principal (protegida) o al login
  { path: '', redirectTo: '/tupa', pathMatch: 'full' },
  { path: '**', redirectTo: '/tupa' } // Redirigir cualquier otra ruta
];