import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { AlterarsenhaPage } from './alterarsenha.page';

describe('AlterarsenhaPage', () => {
  let component: AlterarsenhaPage;
  let fixture: ComponentFixture<AlterarsenhaPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AlterarsenhaPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(AlterarsenhaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
