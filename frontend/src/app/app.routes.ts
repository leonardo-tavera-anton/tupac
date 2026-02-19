import { Routes } from '@angular/router';
import { authGuard } from './services/auth.guard';
import { LoginComponent } from './login.component';
import { RegisterComponent } from './register.component';
// CAMBIO AQUÍ: Importamos 'Tupa' porque así se llama en tupa.ts
import { Tupa } from './pages/tupa/tupa'; 

export const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { 
    path: 'tupa', 
    component: Tupa, // CAMBIO AQUÍ TAMBIÉN
    canActivate: [authGuard] 
  },
  { path: '', redirectTo: '/login', pathMatch: 'full' },
  { path: '**', redirectTo: '/login' }
];