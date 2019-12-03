import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { AlterarfotoPageRoutingModule } from './alterarfoto-routing.module';

import { AlterarfotoPage } from './alterarfoto.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    AlterarfotoPageRoutingModule
  ],
  declarations: [AlterarfotoPage]
})
export class AlterarfotoPageModule {}
