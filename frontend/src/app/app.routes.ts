import { Routes } from '@angular/router';
import { authGuard } from './services/auth.guard';

// Importaciones corregidas según tus archivos .ts y carpetas
import { LoginComponent as Login } from './login.component'; 
import { RegisterComponent as Register } from './register.component'; 
import { Tupa } from './pages/tupa/tupa'; 

export const routes: Routes = [
  { 
    path: 'login', 
    component: Login // Antes decía LoginComponent
  },
  { 
    path: 'register', 
    component: Register // Antes decía RegisterComponent
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