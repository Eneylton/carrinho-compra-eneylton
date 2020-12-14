import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { CartProvider } from '../../providers/cart/cart';

@IonicPage({})
@Component({
  selector: 'page-my-cart',
  templateUrl: 'my-cart.html',
})
export class MyCartPage {

  brightness: number = 20;
  contrast: number = 0;
  warmth: number = 1300;
  structure: any = { lower: 10, upper: 50 };
  text: number = 0;

  constructor(public navCtrl: NavController,
    public navParams: NavParams,
    public cart: CartProvider) {
  }


  removeItem(index) {
    this.cart.removeItem(index);
  }

  subtotais(item) {
    this.cart.subtotais(item);
  }
  mais(item) {
    this.cart.mais(item);
  }

  menos(item) {
    this.cart.menos(item);
  }

 
  calculateTotal() {
    this.cart.calculateTotal();
  }


}
