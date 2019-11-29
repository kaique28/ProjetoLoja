<?php

/*
Vamos contruir os cabeçalhos para o trabalho a api
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=utf-8");

#Esse cabeçalho define o método de envio com PUT, ou seja, como atualizar
header("Access-Control-Allow-Methods:PUT");

#Define o tempo de espera da api. Neste caso é 1 minuto.
header("Access-Control-Max-Age:3600");

include_once "../../config/database.php";

include_once "../../domain/detalhepedido.php";

$database = new Database();
$db = $database->getConnection();

$detalhepedido = new Detalhepedido($db);

/*
O detalhepedido irá enviar os dados no formato json. Porém nós precisamos dos dados
 no formato php para atualizar em banco de dados. Para realizar essa conversão
 iremos usar o banco json_decode. Assim o detalhepedido enviar os dados, estes são
 lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
 php.
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os campos estão com dados.
if(!empty($data->id_pedido) && !empty($data->id_produto) && !empty($data->quantidade) && !empty($data->id)){

    $detalhepedido->id_pedido = $data->id_pedido;
    $detalhepedido->id_produto = $data->id_produto;
    $detalhepedido->quantidade = $data->quantidade;
    $detalhepedido->id = $data->id;
    
    if($detalhepedido->atualizar()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"detalhepedido atualizado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível atualizar."));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa passar todos os dados para atualizar"));
}
?>