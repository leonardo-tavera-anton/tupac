import { Routes } from '@angular/router';
import { authGuard } from './services/auth.guard';

import { Login } from './pages/login/login'; 
import { Register } from './pages/register/register'; 
import { Tupa } from './pages/tupa/tupa'; 
import { Tramites } from './pages/tramites/tramites'; // Importación añadida

export const routes: Routes = [
  { path: 'login', component: Login },
  { path: 'register', component: Register },
  { 
    path: 'tupa', 
    component: Tupa, 
    canActivate: [authGuard] 
  },
  { 
    path: 'tramites', // Ruta para ver los guardados
    component: Tramites, 
    canActivate: [authGuard] 
  },
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: '**', redirectTo: 'login' }
];