import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { AlterarfotoPage } from './alterarfoto.page';

describe('AlterarfotoPage', () => {
  let component: AlterarfotoPage;
  let fixture: ComponentFixture<AlterarfotoPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AlterarfotoPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(AlterarfotoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
