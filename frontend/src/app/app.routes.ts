import { Routes } from '@angular/router';
import { authGuard } from './services/auth.guard';

// Importaciones corregidas hacia la carpeta 'pages'
import { Login } from './pages/login/login'; 
import { Register } from './pages/register/register'; 
import { Tupa } from './pages/tupa/tupa'; 

export const routes: Routes = [
  { 
    path: 'login', 
    component: Login 
  },
  { 
    path: 'register', 
    component: Register 
  },
  { 
    path: 'tupa', 
    component: Tupa, 
    canActivate: [authGuard] 
  },
  { 
    path: '', 
    redirectTo: 'login', 
    pathMatch: 'full' 
  },
  { 
    path: '**', 
    redirectTo: 'login' 
  }
];