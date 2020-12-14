import { Injectable } from "@angular/core";
import { AlertController, ToastController } from "ionic-angular";

@Injectable()
export class CartProvider {
    items: Array<any> = [];
    total = 0;
    sum = 0;
    valor = 0;

    constructor(
        public alertCtrl: AlertController,
        public toastCtrl: ToastController) {


    }

    addItem(item) {
        let possion = this.items.findIndex(produto => produto.id == item.id);
        if (possion == -1) {
            this.items.push(item);
            this.calculateTotal();
        }


    }

    mais(item) {
       
        let possion = this.items.findIndex(produto => produto.id == item.id);
        if (possion != -1) {
            this.items[possion].qtd++;
           
            this.calculateTotal();
        }
        
    }

    menos(item) {
        let possion = this.items.findIndex(produto => produto.id == item.id);
        if (possion != -1) {
            this.items[possion].qtd--;
            if(this.items[possion].qtd < 1){
                
                this.removeItem(possion);
                this.calculateTotal();
                
            }
            this.calculateTotal();
        }
       
    }



    removeItem(index) {
        this.items.splice(index, 1);
        this.calculateTotal();
    }

    calculateTotal() {
        let total = 0;
        this.items.forEach(item => {
            total += Number(item.valor * item.qtd);
        });
        this.total = total;
    }

}
