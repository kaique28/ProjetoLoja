<?php
/* criando um espelho da tabela usuario que esta no banco dbloja */
class Contato{
    public $id;
    public $telefone;
    public $email;


    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função listar para selecionar todos os contatos cadastrados no banco
     dee dados. Essa função retorno uma lista com todos os dados.
    */
    public function listar(){
        #Seleciona todos os campos da tabela contato
        $query = "select * from contato";

        /*
        Foi criada a variável stmt(Statment -> Sentença) para guardar a preparação da consulta
        select que será executada posteriomente.
        */
        $stmt = $this->conexao->prepare($query);

        #execução da consulta e guarda de dados na variável stmt        
        $stmt->execute();

        #retorna os dados do usuário a camada data.
        return $stmt;
    }

    /*
    Função para cadastrar os contatos no banco de dados
    */
    public function cadastro(){
        $query = "insert into contato set telefone=:t, email=:e";

        $stmt = $this->conexao->prepare($query);

        /*
        Foi utilizada 2 funções para tratar ps dadps que estão vindo do usuário
        para a API.
        strip_tags-> trata os dados em seus formatos inteiro , double ou decimal
        htmlspecialchar -> retira as aspas e os 2 pontos que vem do formato
        json para cadastrar em banco.
        */
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);
        

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }        
    }

    public function alterarContato(){
        $query = "update contato set telefone=:t, email=:e where id=:i";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":i",$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from contato where id=?";

        $stmt=$this->conexao->prepare($query);

        $stmt->bindParam(1,$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}

?>