import { HttpClient,HttpHeaders} from '@angular/common/http';
import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/timeout';


@Injectable()
export class ServiceProvider {

    serve: string = 'http://localhost/Servidores/Carrinho-Estoque/';
  //serve: string = 'http://192.168.100.14/Servidores/Pedidos/';

  constructor(public http: HttpClient) { }

  postData(body,file){
    
    let headers =  new HttpHeaders({ 'Content-Type': 'application/json; charset=UTF-8'});
    let options = ({ headers:headers});

    return this.http.post(this.serve + file,
           JSON.stringify(body),options)
           .timeout(59000)
           .map(res => res);
  }

}