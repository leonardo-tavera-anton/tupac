import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TupaService {
  private apiUrl = 'http://localhost:8000/api'; // La misma URL base

  constructor(private http: HttpClient) { }

  getTupaCompleto(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/tramites`);
  }
}