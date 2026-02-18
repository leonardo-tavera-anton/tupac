import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { tap } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class AuthService {
  private url = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) {}

  register(userData: any) {
    return this.http.post(`${this.url}/register`, userData);
  }

  login(credentials: any) {
    return this.http.post(`${this.url}/login`, credentials).pipe(
      tap((res: any) => {
        if (res.token) localStorage.setItem('token', res.token);
      })
    );
  }
}