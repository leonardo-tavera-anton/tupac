import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router'; 
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
  misTramitesGuardados: any[] = [];

  // NUEVO: Control de selección de ítems
  itemsSeleccionados: Set<any> = new Set();

  constructor(private tupaService: TupaService, private router: Router) {}

  ngOnInit(): void {
    this.tupaService.getTupaCompleto().subscribe((res: any) => {
      const data = res.data || res || [];
      this.todosLosTramites = data; 
      this.areas = this.agruparDatos(data);
    });

    const guardados = localStorage.getItem('tupa_fav_2026');
    if (guardados) {
      this.misTramitesGuardados = JSON.parse(guardados);
    }
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

  // --- BUSCADOR Y FILTROS (Tus métodos originales) ---
  buscarPorTexto() {
    const term = this.terminoBusqueda.trim().toLowerCase();
    if (term.length < 2) {
      this.resultadosBusqueda = [];
      return;
    }
    this.resultadosBusqueda = this.todosLosTramites.filter(t => 
      (t.nombre_tramite || '').toLowerCase().includes(term) ||
      String(t.codigo_tupa || '').toLowerCase().includes(term)
    ).slice(0, 15);
  }

  seleccionarDesdeBusqueda(tramite: any) {
    this.resetearBusqueda();
    this.seleccionarTramite(tramite);
    const areaId = tramite.area?.id || tramite.id_area;
    const match = this.areas.find(a => a.id === areaId);
    if (match) this.areaSeleccionada = match;
  }

  seleccionarArea(a: any) { 
    this.areaSeleccionada = a; 
    this.tramiteSeleccionado = null; 
    this.itemsSeleccionados.clear();
  }
  
  seleccionarTramite(t: any) { 
    this.tramiteSeleccionado = t; 
    this.itemsSeleccionados.clear();
  }

  resetearBusqueda() {
    this.terminoBusqueda = '';
    this.resultadosBusqueda = [];
    this.areaSeleccionada = null;
    this.tramiteSeleccionado = null;
    this.itemsSeleccionados.clear();
  }

  get tramitesFiltrados() { 
    return this.areaSeleccionada?.tramites || []; 
  }

  // --- LÓGICA DE SELECCIÓN E IMPORTE ---
  toggleItem(req: any) {
    if (this.itemsSeleccionados.has(req)) {
      this.itemsSeleccionados.delete(req);
    } else {
      this.itemsSeleccionados.add(req);
    }
  }

  calcularTotalSeleccionado(): number {
    let total = 0;
    this.itemsSeleccionados.forEach(item => total += (Number(item.importe) || 0));
    return total;
  }

  // --- GUARDADO ESPECÍFICO (CORREGIDO CON USUARIO) ---
  guardarTramite(tramite: any) {
    if (this.itemsSeleccionados.size === 0) {
      alert('⚠️ Por favor, seleccione al menos una opción.');
      return;
    }

    // Rescatamos el nombre del usuario logueado para que el guardado sea personal
    const sesion = localStorage.getItem('user_session');
    if (!sesion) {
      alert('Debe iniciar sesión para guardar trámites.');
      this.router.navigate(['/login']);
      return;
    }
    const usuarioActual = JSON.parse(sesion).nombre;

    const data = localStorage.getItem('tupa_fav_2026');
    let actuales: any[] = data ? JSON.parse(data) : [];

    const seleccionParaGuardar = {
      id_unico: Date.now(), 
      usuario_dueno: usuarioActual, // <--- Esto evita que otros vean tus trámites
      codigo_tupa: tramite.codigo_tupa,
      nombre_tramite: tramite.nombre_tramite,
      area_nombre: tramite.area?.nombre || 'General',
      requisitos: Array.from(this.itemsSeleccionados),
      montoTotal: this.calcularTotalSeleccionado(),
      fecha: new Date().toLocaleString()
    };

    actuales.push(seleccionParaGuardar);
    localStorage.setItem('tupa_fav_2026', JSON.stringify(actuales));
    this.misTramitesGuardados = actuales;
    alert(`✅ Guardado en tu cuenta (${usuarioActual}).`);
  }

  // --- NAVEGACIÓN ---
  verMisTramites() { this.router.navigate(['/tramites']); }

  cerrarSesion() {
    if (confirm('¿Desea cerrar su sesión actual?')) {
      localStorage.removeItem('user_token');
      localStorage.removeItem('user_session'); // Limpiamos también la sesión del nombre
      this.router.navigate(['/login']); 
    }
  }
}