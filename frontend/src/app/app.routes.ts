import { Routes } from '@angular/router';
import { Inicio } from './pages/inicio/inicio';
import { Tupa } from './pages/tupa/tupa';

export const routes: Routes = [
  { path: '', redirectTo: 'inicio', pathMatch: 'full' },
  { path: 'inicio', component: Inicio },
  { path: 'tupa', component: Tupa }
];