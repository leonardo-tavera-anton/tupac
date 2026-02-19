import { Routes } from '@angular/router';
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
];