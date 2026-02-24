import { ApplicationConfig, provideZoneChangeDetection } from '@angular/core';
import { provideRouter } from '@angular/router';
import { provideHttpClient, withFetch, withInterceptorsFromDi } from '@angular/common/http';
import { HTTP_INTERCEPTORS } from '@angular/common/http';

import { routes } from './app.routes';
import { AuthInterceptor } from './services/auth.interceptor';

export const appConfig: ApplicationConfig = {
  providers: [
    // Activa Zone.js para la detección de cambios
    provideZoneChangeDetection({ eventCoalescing: true }), 
    // Configura las rutas de la aplicación
    provideRouter(routes), 
    // Habilita el cliente HTTP con soporte para SSR
    provideHttpClient(withFetch(), withInterceptorsFromDi()), 
    // Registra tu interceptor de autenticación
    { provide: HTTP_INTERCEPTORS, useClass: AuthInterceptor, multi: true }
  ]
};