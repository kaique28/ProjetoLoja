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

include_once "../../domain/produto.php";

$database = new Database();
$db = $database->getConnection();

$produto = new Produto($db);

/*
O produto irá enviar os dados no formato json. Porém nós precisamos dos dados
 no formato php para atualizar em banco de dados. Para realizar essa conversão
 iremos usar o banco json_decode. Assim o produto enviar os dados, estes são
 lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
 php.
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os campos estão com dados.
if(!empty($data->nome) && !empty($data->descricao) && !empty($data->preco) && !empty($data->imagem1) && !empty($data->imagem2) && !empty($data->imagem3) && !empty($data->imagem4) && !empty($data->id)){

    $produto->nome = $data->nome;
    $produto->descricao = $data->descricao;
    $produto->preco = $data->preco;
    $produto->imagem1 = $data->imagem1;
    $produto->imagem2 = $data->imagem2;
    $produto->imagem3 = $data->imagem3;
    $produto->imagem4 = $data->imagem4;
    $produto->id = $data->id;
    
    if($produto->atualizar()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"produto atualizado com sucesso!"));
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