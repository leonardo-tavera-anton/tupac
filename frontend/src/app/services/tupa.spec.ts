import { TestBed } from '@angular/core/testing';

import { Tupa } from './tupa';

describe('Tupa', () => {
  let service: Tupa;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(Tupa);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
