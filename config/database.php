<?php
/*
A classe Database irá permitir a comunicação com o banco de dados.
Nesta classe teremos a string de conexão com o banco, bem como:
 - Nome de usuário: "root"
 - Senha: "" -> Vazio neste caso
 - Banco de dados: dbloja
 - Porta de comunicação: 3306
 - Servidor: Localhost ou IP(Local ou remoto)
E uma variável para a conexão com o banco que será usada em outros
arquivos e, portanto, será declarada com o modificador public
*/
class Database{
    //definindo uma conexão publica
    public $conexao;
    public function getConnection(){
        try{
            $conexao = new PDO("mysql:host=localhost;port=3306;dbname=dbloja","root","");
            //definir o tipo de caracter para o banco como utf8 que é caracter acentuado
            $conexao->exec("set name utf8");
        }
        catch(PDOException $e){
            echo "Erro ao tentar estabelecer a conexão com o banco de dados. ".$e->getMessage();
        }
        return $conexao;
    }
}


?>