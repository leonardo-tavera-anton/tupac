import { ComponentFixture, TestBed } from '@angular/core/testing';
import { Tupa } from './tupa';
import { provideHttpClient } from '@angular/common/http';
import { TupaService } from '../../services/tupa.service';

describe('TupaComponent', () => {
  let component: Tupa;
  let fixture: ComponentFixture<Tupa>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Tupa],
      providers: [provideHttpClient(), TupaService]
    }).compileComponents();

    fixture = TestBed.createComponent(Tupa);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});