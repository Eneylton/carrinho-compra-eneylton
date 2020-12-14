import { Component } from '@angular/core';
import { AlertController, IonicPage, NavController, NavParams } from 'ionic-angular';
import { CartProvider } from '../../providers/cart/cart';
import { ServiceProvider } from '../../providers/service/service';


@IonicPage({})
@Component({
  selector: 'page-checkout',
  templateUrl: 'checkout.html',
})
export class CheckoutPage {
   
  total:any;
  nome:string = "";
  id:any;
  valor:any;
  produtos_id:any;
  qtd:any;
  items: Array<any> = [];

  constructor(public navCtrl: NavController, 
              private serve: ServiceProvider,
              public alertCtrl: AlertController,
              public navParams: NavParams, public cart: CartProvider) {
  }


  ngOnInit(): void {

    this.total = this.cart.total;
  
    this.cart.items.forEach(item => {
        this.nome = item.nome;
        this.valor  = Number(item.valor);
    });

  }


  finalizar(){
    this.cart.items.forEach(item => {
    let body = {
    
      produtos_id:  item.id,
      nome:  item.nome,
      qtd:  item.qtd,
      valor: Number(item.valor),
      crud: 'add-item'
    };

    this.serve.postData(body, 'produtos.php').subscribe(data => {

    });
    
  })
  this.showInsertOk();
  }


  
  showInsertOk() {
    let alert = this.alertCtrl.create({
      title: 'Sucesso!',
      message: 'Seu pedido foi enviado com sucesso !!!',
      enableBackdropDismiss: false,
      buttons: [
        {
          text: 'Sucesso',
          handler: () => {
            
            this.navCtrl.setRoot('HomePage')
          }
        }
      ]
    });
    alert.present();
  }



}
