import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, BehaviorSubject, tap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = 'http://localhost:8000/api'; 
  private _isLoggedIn$ = new BehaviorSubject<boolean>(false);
  isLoggedIn$ = this._isLoggedIn$.asObservable();

  constructor(private http: HttpClient) {
    const token = this.getToken();
    this._isLoggedIn$.next(!!token);
  }

  private saveToken(token: string): void {
    localStorage.setItem('auth_token', token);
    this._isLoggedIn$.next(true);
  }

  getToken(): string | null {
    return localStorage.getItem('auth_token');
  }

  register(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/register`, data).pipe(
      tap((response: any) => this.saveToken(response.token))
    );
  }

  login(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/login`, data).pipe(
      tap((response: any) => this.saveToken(response.token))
    );
  }

  logout(): void {
    localStorage.removeItem('auth_token');
    this._isLoggedIn$.next(false);
  }
}