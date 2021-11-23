<?php
//conexao com o banco
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script>
        var idProduto = "";
        var formatado = "";
        //salva o valor do id no input de id
        function idValue(id) {
            document.getElementById('idProd').value = id;
        }

        function formatMoney(valor) {
            //var valor = parseInt(document.getElementById("moeda").innerText);
            formatado = valor.toLocaleString('pt-br', {
                style: 'currency',
                currency: 'BRL'
            });
        }
    </script>
</head>

<body>
    <!--inclusao da barra de navegacao-->
    <?php
    include "navbar.php";
    ?>
    <!--fundo-->
    <div style="background-color: white;">
        <br>
        <h1 style="color: orangered; Text-align:center">GN Vendas</h1>
        <br>
        <!--bloco principal da pagina-->
        <div style="background-color:lightgray" class="m-2 p-2">
            <form name="formCadastro" action="comprar.php" method="POST" class="need-validation" target="_blank">

                <!--consultando todos os produtos-->
                <?php
                $SQL = "SELECT * FROM produtos ORDER BY id_produto";
                $query = $conn->query($SQL);
                ?>
                <div class="row">

                    <div class="col-7">
                        <p class="h4" style="text-align: center;">Produtos Cadastrados</p>
                        <br>
                        <!--criação da tabela com os produtos cadastrados-->
                        <table class="table table-sm table-hover bg-white table-bordered">
                            <thead class="thead bg-primary text-white">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Produto</th>
                                    <th class="text-center">Preço</th>

                                </tr>
                            </thead>
                            <!--exibindo todos os registros da consulta -->
                            <?php
                            while ($exibir = $query->fetch_assoc()) {
                                echo '<script> formatMoney(' . $exibir["valor_produto"] . ') </script>';
                                $valor =  '<script>document.write(formatado)</script>';
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <button type="submit" class="btn-success btn form-control" onclick="idValue('<?php echo $exibir['id_produto'] ?>')">Comprar</button>
                                    </td>
                                    <td class="text-center"><?php echo $exibir["nome_produto"] ?></td>
                                    <td class="text-center" id="moeda"><?php echo $valor ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                        
                    </div>
                    <div class="col-5">
                        <!--coleta de dados para geração do boleto-->
                        <h4 style="text-align: center;">Insira os dados que serão exibidos em seu boleto:</h4>
                        <label for="nomePessoa">Nome completo: </label>
                        <input type="text" name="nomeCompleto" id="nomeCompleto" class="form-control" required>
                        <label for="cpf">CPF: </label>
                        <input type="text" name="cpf" id="cpf" class="form-control" required minlength="11" maxlength="11">
                        <label for="telefone">Telefone para contato: </label>
                        <input type="text" name="telefone" id="telefone" class="form-control" required minlength="11" maxlength="11">
                        <input type="hidden" name="idProd" id="idProd">
                    </div>
                </div>
                
                <br>


            </form>

        </div>
    </div>
</body>



</html>