import 'zone.js'; 
import { bootstrapApplication } from '@angular/platform-browser';
import { appConfig } from './app/app.config';
import { App } from './app/app';

// Añadimos un pequeño log para verificar que el archivo carga
console.log('Cargando aplicación con Zone.js...');

bootstrapApplication(App, appConfig)
  .catch((err) => console.error(err));