import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { TupaService } from '../../services/tupa.service';

@Component({
  selector: 'app-tupa',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './tupa.html',
  styleUrls: ['./tupa.scss']
})
export class Tupa implements OnInit {
  areas: any[] = [];
  areaSeleccionada: any = null;
  tramiteSeleccionado: any = null;
  
  todosLosTramites: any[] = [];
  terminoBusqueda: string = '';
  resultadosBusqueda: any[] = [];

  constructor(private tupaService: TupaService) {}

  ngOnInit(): void {
    this.tupaService.getTupaCompleto().subscribe((res: any) => {
      const data = res.data || res || [];
      this.todosLosTramites = data; 
      this.areas = this.agruparDatos(data);
    });
  }

  agruparDatos(tramites: any[]): any[] {
    const map = new Map();
    tramites.forEach(t => {
      const area = t.area || { id: 0, nombre: 'Otras Áreas' };
      if (!map.has(area.id)) {
        map.set(area.id, { id: area.id, nombre: area.nombre, tramites: [] });
      }
      map.get(area.id).tramites.push(t);
    });
    return Array.from(map.values());
  }

  buscarPorTexto() {
    const term = this.terminoBusqueda.trim().toLowerCase();
    if (term.length < 2) {
      this.resultadosBusqueda = [];
      return;
    }
    // Buscamos en toda la lista plana
    this.resultadosBusqueda = this.todosLosTramites.filter(t => 
      (t.nombre_tramite || '').toLowerCase().includes(term) ||
      String(t.codigo_tupa || '').toLowerCase().includes(term)
    ).slice(0, 15); // Lista extendida a 15 resultados
  }

  seleccionarDesdeBusqueda(tramite: any) {
    this.resetearBusqueda(); // Limpiamos estados previos
    this.tramiteSeleccionado = tramite;
    
    // Intentamos marcar el área en el combo para coherencia visual
    const areaId = tramite.area?.id || tramite.id_area;
    const match = this.areas.find(a => a.id === areaId);
    if (match) this.areaSeleccionada = match;
  }

  seleccionarArea(a: any) { 
    this.areaSeleccionada = a; 
    this.tramiteSeleccionado = null; 
  }
  
  seleccionarTramite(t: any) { 
    this.tramiteSeleccionado = t; 
  }
  
  get tramitesFiltrados() { 
    return this.areaSeleccionada?.tramites || []; 
  }

  resetearBusqueda() {
    this.terminoBusqueda = '';
    this.resultadosBusqueda = [];
    this.areaSeleccionada = null;
    this.tramiteSeleccionado = null;
  }

  calcularTotal(reqs: any[]): number {
    if (!reqs) return 0;
    return reqs.reduce((acc, c) => acc + (Number(c.importe) || 0), 0);
  }
}