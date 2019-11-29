<?php

/*
Este cabeçalho permite o acesso a listagem de usuário
com diversas origens. Por isso estamos usando o *(asterisco)
para essa permissão que será para http,https,file,ftp
*/
header("Access-Control-Allow-Origin:*");

/*
Vamos definir qual será o formato de dados que o usuário
irá enviar a API. Este formato será do tipo JSON(Javascript On
Notation)
*/
header("Content-Type: application/json;charset=utf-8");

header("Access-Control-Allow-Methods:GET");

/*
Abaixo estamos incluindo o arquivo database.php que possui a 
classe Database com a conexão com o banco de dados
*/
include_once "../../config/database.php";

/*
O arquivo cliente.php foi incluido para que a classe cliente fosse
utilizada. Vale lembrar que esta classe possui o CRUD para o usuário.
*/
include_once "../../domain/cliente.php";

/*
Criamos um objeto chamado $database. É uma instância da classe Database.
Quando usamos o termo new, estamos criando uma instância, ou seja,
um objeto da classe Database. Isso nos dará acesso a todos os dados
da classe Database.
*/
$database = new Database();

/*
Executamos a função getConnection que estabelece a conexão com o banco de
dados. E retorna essa conexão realizada para a variável $db
*/
$db = $database->getConnection();

/*
Instância da classe cliente e, portanto, criação do objeto chamado $cliente.
Isso fará com que todos as funções que estão dentro da classe cliente sejam
transferidas para o objeto $cliente.
Durante a instância foi passada como paramêtro a variável $db que possui
a comunicação com o banco de dados e também a variável conexao. Utilizada
para a uso dos comandos de CRUD
*/
$cliente = new Cliente($db);


$data = json_decode(file_get_contents("php://input"));


/*
A variável $stmt(Statement ->sentenção) foi criada para guardar o retorno
da consulta que está na função listar. Dentro da função listar() temos uma
consulta no formato sql que seleciona todos os usuário("Select * from cliente")

*/
$cliente->nome = $data->nome;

$stmt = $cliente->pesquisar_nome();

/*
Se a consulta retornar uma quantidade de linhas maior que 0(Zero), então será
contruido um array com os dados dos endereços.
Caso contrário será exibida uma mensagem que não clientes cadastrados
*/
if($stmt->rowCount() > 0){
/*
Para organizar os clientes cadastrados em banco e exibi-los em tela, foi
criado uma array com o nome de saida e assim guardar todos clientes.
*/
    $cliente_arr["saida"]=array();
    /*
    A estrutura while(enquanto) realizar a busca e todos os clientes
    cadastrados até chegar ao final da tabela e tras os dados
    para fetch array organizar em formato de array.
    Assim será mais fácil de adicionar no array de usuários para ser
    apresentado ao usuário.
    */
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        /*
        O comando extract é capaz de separar de forma mais simples
        os campos da tabela clientes.
        */
        extract($linha);

        /*
        Pegar um campo por vez do comando extract e adicionar em um
        array de itens, pois será assim que os clientes serão tratados,
        um cliente por vez com seus respectivos dados.
        */
        $array_item = array(
            "id"=>$id,
            "nome"=>$nome,
            "cpf"=>$cpf,
            "id_endereco"=>$id_endereco,
            "id_contato"=>$id_contato, #Utilizamos o utf8 para endereços do assento.
            "id_usuario"=>$id_usuario 
        );
        /*
        Pegar um item gerado pelo array_item e adicionar a saida, que
        também é um array.
        array_push é um comando em que você pode adicionar algo em um
        array. Assim estamos adicionando ao cliente_arr[saido] um item
        que é um cliente com seus respectivos dados.
        */
        array_push($cliente_arr["saida"],$array_item);
    }

    /*
    O comando header(cabeçalho) responde via HTTP o status code 200 que
    representa sucesso no consulta de dados.
    */
    header("HTTP/1.0 200");

    /*
    Pegamos o array cliente_arr que foi construido em php com os dados
    dos cliente e convertemos para o formato json para exibir ao
    cliente requisitante.
    */
    echo json_encode($cliente_arr);



}
else{
    /*
    O comando header(cabeçalho) responde ao cliente o status code 400(badrequest)
    caso não haja clientes cadastrados no banco. Junto ao status code será exibida
    a mensagem "mensagem: Não há clientes cadastrados" que será mostrada por meio
    do comando json_encode
    */
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há clientes cadastrados"));
}





?>