import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TupaService {
  private url = 'http://127.0.0.1:8000/api/tramites';

  constructor(private http: HttpClient) { }

  getTramites(): Observable<any> {
    const token = localStorage.getItem('token');
    
    // Configuramos la cabecera de autorización
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });

    return this.http.get(this.url, { headers });
  }
}