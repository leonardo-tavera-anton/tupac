import { Routes } from '@angular/router';
<<<<<<< HEAD
import { TupaComponent } from './pages/tupa/tupa'; // <--- Cambiado de Tupa a TupaComponent

export const routes: Routes = [
  {
    path: 'tupa',
    component: TupaComponent // <--- Debe coincidir con el nombre de la clase
  },
  {
    path: '',
    redirectTo: 'tupa',
    pathMatch: 'full'
  }
=======
import { Login } from './pages/login/login';
import { Tupa } from './pages/tupa/tupa';
import { Register } from './pages/register/register'; // 1. Importa el componente

export const routes: Routes = [
  { path: 'login', component: Login },
  { path: 'register', component: Register }, // 2. Añade la ruta de registro
  { path: 'tupa', component: Tupa },
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: '**', redirectTo: 'login' } 
>>>>>>> aa2fccf0d093e4b2c927b6f4cc309afe767a5bb5
];