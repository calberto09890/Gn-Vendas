<?php
//conexao com o banco
include "connect.php";

//recebendo os dados vindos do form de cadastro de produtos
$nome = $_POST["nomeProduto"];
$valor = $_POST["valorProduto"];


//Insert no banco
$SQL = "INSERT INTO produtos (nome_produto, valor_produto)
     VALUES ('$nome', '$valor')";

$conn->query($SQL) or die($conn->error);
?>
<script>
    alert('Cadastro do produto efetuado com sucesso!');
    window.location = 'cadprodutos.php';
</script>