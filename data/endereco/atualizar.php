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

include_once "../../domain/endereco.php";

$database = new Database();
$db = $database->getConnection();

$endereco = new Endereco($db);

/*
O cliente irá enviar os dados no formato json. Porém nós precisamos dos dados
 no formato php para atualizar em banco de dados. Para realizar essa conversão
 iremos usar o banco json_decode. Assim o cliente enviar os dados, estes são
 lidos pela entrada php: e seu conteúdo é capturado e convertido para o formato
 php.
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os campos estão com dados.
if(!empty($data->logradouro) && !empty($data->numero) && !empty($data->complemento) && !empty($data->bairro) && !empty($data->cep) && !empty($data->id)){

    $endereco->logradouro = $data->logradouro;
    $endereco->numero = $data->numero;
    $endereco->complemento = $data->complemento;
    $endereco->bairro = $data->bairro;
    $endereco->cep = $data->cep;
    $endereco->id = $data->id;
    
    if($endereco->atualizar()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"endereco atualizado com sucesso!"));
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