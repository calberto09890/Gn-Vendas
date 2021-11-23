# Sistema Gn-Vendas
###### Projeto executado por Carlos Alberto sem fins comerciais.

### Execução do programa:
1. #### Para conseguir executar o programa, primeiramente deve se criar o banco de dados **MySQL**. Para tal, utilize as linhas de código a seguir:

~~~MySQL

CREATE TABLE gn.compras(
  link_pdf VARCHAR(100) NOT NULL,
  id_boleto INT NOT NULL,
  id_produto int(11) NOT NULL,
  PRIMARY KEY (id_boleto));

CREATE TABLE gn.produtos (
  id_produto INT NOT NULL AUTO_INCREMENT,
  nome_produto VARCHAR(45) NOT NULL,
  valor_produto DOUBLE NOT NULL,
  PRIMARY KEY (id_produto));

ALTER TABLE gn.compras ADD
CONSTRAINT fk_produto
FOREIGN KEY (id_produto) REFERENCES
gn.produtos(id_produto);

~~~

2. #### Depois, é necessário clonar o projeto repositório do link https://github.com/calberto09890/Gn-Vendas.git;

3. #### Caso seja necessário alterar algum dado de conexão com o banco, vá até o arquivo connect.php e altere as crerdenciais:

~~~php


<?php
    session_start();

    //dados de acesso ao banco de dados
    $nomeDB = "gn";
    $server = "localhost";
    $user = "root";
    $pass = "";
    $conn = new mysqli($server, $user, $pass, $nomeDB);

    //checkando a conexão
    if ($conn->connect_error) {
	    die("Falha na conexão: " . $conn->connect_error);
	} 
?>

~~~

4. #### Agora, para executar, basta abrir o projeto no seu servidor Wamp.
