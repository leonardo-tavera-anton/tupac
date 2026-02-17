import { TestBed } from '@angular/core/testing';
import { provideHttpClient } from '@angular/common/http'; // Necesario para el test
import { TupaService } from './tupa.service'; 

describe('TupaService', () => {
  let service: TupaService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [
        provideHttpClient(), 
        TupaService
      ]
    });
    service = TestBed.inject(TupaService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});