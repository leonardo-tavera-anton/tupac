import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({ providedIn: 'root' })
export class TupaService {
  private url = 'http://localhost:8000/api/tramites';

  constructor(private http: HttpClient) {}

  getTramites() {
    const token = localStorage.getItem('access_token');
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this.http.get(this.url, { headers });
  }
}