create database dbloja;
use dbloja;
create table usuario(
id int auto_increment primary key,
nomeusuario varchar(30) not null unique,
senha varchar(200) not null,
foto varchar(250) not null
)engine InnoDB;

create table contato(
id int auto_increment primary key,
telefone varchar(15) not null,
email varchar(100) not null unique
)engine InnoDB;

create table endereco(
id int auto_increment primary key,
logradouro varchar(200),
numero varchar(10) not null,
complemento varchar(20) not null,
bairro varchar(50) not null,
cep varchar(10) not null
)engine InnoDB;

create table cliente(
id int auto_increment primary key,
nome varchar(50) not null,
cpf varchar(13) not null unique,
id_endereco int not null,
id_contato int not null,
id_usuario int not null
)engine InnoDB;

create table produto(
id int auto_increment primary key,
nome varchar(100) not null,
descricao text not null,
preco decimal(10,2) not null,
imagem1 varchar(250) not null,
imagem2 varchar(250) not null,
imagem3 varchar(250) not null,
imagem4 varchar(250) not null
)engine InnoDB;

create table estoque(
id int auto_increment primary key,
id_produto int not null,
quantidade int not null,
alterado timestamp default current_timestamp()
)engine InnoDB;

create table pedido(
id int auto_increment primary key,
id_cliente int not null,
data_pedido timestamp default current_timestamp()
)engine InnoDB;

create table detalhepedido(
id int auto_increment primary key,
id_pedido int not null,
id_produto int not null,
quantidade int not null
)engine InnoDB;

create table pagamento(
id int auto_increment primary key,
id_pedido int not null,
valor decimal(10,2) not null,
formapagamento varchar(20) not null,
descricao text not null,
numeroparcelas int not null,
valorparcela decimal(10,2) not null
)engine InnoDB;

