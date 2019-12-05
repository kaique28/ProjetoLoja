import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  //url para listar os produtos cadastrados
  private url:string="http://localhost/dbloja/data/produto/listar.php"
  /*
  Vamos receber os produtos cadastrados na forma de json da
  API por meio da url acima.
  O conteúdo que virá será uma lista de objetos, ou seja, uma
  lista de produtos.
  Para utilizar essa lista na página pricipal(home.html) estamos
  usando um Array de objetos que receberá os dados da API
  e irá repassar para o nosso laço(*ngFor) na home.
  usa
  */
  public produtos:Array<Object>=[];
    constructor(private http:HttpClient) {}

    /*
    O comando ngOnInit(ng->todos os comando internos do Angular|
      On->Ativar, Ligar | Init->Iniciatize = Iniciar).
      No momento em que a página home inicializa será feita uma
      requisição http dentro do método ngOnInit para buscar os
      produtos cadastrados.
      O comando ngOnInit é iniciado automáticamente, portanto
      não é necessário chamar.
    */
    ngOnInit(){
      /*
      Os comandos:
        this -> refere-se a esssa classe HomePage e todo o seu
        conteúdo;
        http-> é um elemento tipado como HttpClient responsável
        por fazer as requisições do REST com os verbos: get,
        post, put e delete. Essa elemento foi declarado no
        construtor da classe. Construtor é responsável por iniciar
        a classe com o seu conteúdo;
        get -> significa obter é responsável por chamar o conteúdo
        da página listar com todos os seus produtos.
        ___________________________________________________________
        O comando get requisita a url para fazer chamada dos 
        dados do produtos, por isso é passado entre parênteses a
        url criada no contexto da classe e chamada com o comando
        this.url .
        Comando subscribe(Observable) é responsável por recepcionar
        os dados vindos da url listar produtos com todos os seus
        produtos. Estes são repassados para o objeto data e seu
        conteúdo é tratado de forma genérica com o comando
        (data as any) e atribuido a constante prod.
        
        Com todos os produto na constante prod, fazemos a exibição
        deste na tela de console.

        Mais abaixo, o comando error trata os eventuais erros ocorridos
        durrante a requisição da API.

      */
      this.http.get(this.url).subscribe(
        data => {
          const prod = (data as any);
          this.produtos = prod.saida;
        }, error=>{
          console.log("Erro ao requisitar a API "+error);
        }
      )
    }

}
