<?php

/*
Vamos contruir os cabeçalhos para o trabalho com a api
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=utf-8");

#Esse cabeçalho define o método de envio com Delete, ou seja, como detelar
header("Access-Control-Allow-Methods:DELETE");

#Define o tempo de espera da api. Neste caso é 1 minuto.
header("Access-Control-Max-Age:3600");

include_once "../../config/database.php";

include_once "../../domain/pedido.php";

$database = new Database();
$db = $database->getConnection();

$pedido = new Pedido($db);

/*
O pedido irá enviar os dados no formato json. Porém nós precisamos dos dados
 no formato php para deletar em banco de dados. Para realizar essa conversão
 iremos usar o comando json_decode. Assim que o pedido enviar os dados, estes são
 lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
 php.
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os campos estão com dados.

if(!empty($data->id)){

    $pedido->id = $data->id;

    if($pedido->apagar()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"pedido apagado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível apagar o pedido."));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa passar todos os dados para apagar o pedido"));
}
?>