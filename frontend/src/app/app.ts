import { Component, signal } from '@angular/core';
import { RouterOutlet } from '@angular/router';
// No necesitas importar Sidebar aquí si está comentado en el HTML

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet], // Quitamos Sidebar de aquí
  templateUrl: './app.html',
  styleUrl: './app.scss'
})
export class App {
  protected readonly title = signal('frontend');
}