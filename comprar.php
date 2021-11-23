<?php
//inclusão da conexao com o BD
include "connect.php";

//recebendo os dados vindos do formulario de compra
$nomeCompleto = (string)$_POST["nomeCompleto"];
$telefone = $_POST["telefone"];
$cpf = $_POST["cpf"];
$idProd = $_POST["idProd"];

$datahoje = new DateTime();
$prazo = new DateInterval('P2D');
$valido = $datahoje->add($prazo);
$valido = $valido->format("Y-m-d");

//pesquisa do item que está sendo comprado
$sqlProduto = "SELECT * FROM produtos WHERE id_produto = '{$idProd}';";
$query = $conn->query($sqlProduto) or die($conn->error);
$prod = $query->fetch_assoc();
//salvando os valores em variaveis separadas
$nomeP = $prod["nome_produto"];
$valorP = (int)$prod["valor_produto"];
//multiplicando os valores decimais
$valorP = $valorP * 100;



   require __DIR__ . './vendor/autoload.php'; // caminho relacionado a SDK

   use Gerencianet\Exception\GerencianetException;
   use Gerencianet\Gerencianet;

   $clientId = 'Client_Id_4e4327e045ceb277ed5f62db8c46c399c309e0bf';
   $clientSecret = 'Client_Secret_bb1ad596c70e1c17089cd27ec860816670412681';

    $options = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'sandbox' => true 
    ];
    
   $item_1 = [
       'name' => $nomeP, // nome do item, produto ou serviço
       'amount' => 1, // quantidade
       'value' => $valorP // valor (1000 = R$ 10,00) (Obs: É possível a criação de itens com valores negativos. Porém, o valor total da fatura deve ser superior ao valor mínimo para geração de transações.)
   ];
   $items = [
       $item_1
   ];
   $customer = [
       'name' => $nomeCompleto, // nome do cliente
       'cpf' => $cpf, // cpf válido do cliente
       'phone_number' => $telefone, // telefone do cliente
   ];
   $discount = [ // configuração de descontos
       'type' => 'currency', // tipo de desconto a ser aplicado
       'value' => null // valor de desconto 
   ];
   $configurations = [ // configurações de juros e mora
       'fine' => 200, // porcentagem de multa
       'interest' => 33 // porcentagem de juros
   ];
   $conditional_discount = [ // configurações de desconto condicional
       'type' => 'percentage', // seleção do tipo de desconto 
       'value' => null, // porcentagem de desconto
       'until_date' => $valido // data máxima para aplicação do desconto
   ];
   $bankingBillet = [
       'expire_at' => $valido, // data de vencimento do titulo
       'message' => 'teste\nteste\nteste\nteste', // mensagem a ser exibida no boleto
       'customer' => $customer,
       //'discount' =>$discount,
       //'conditional_discount' => $conditional_discount
   ];
   $payment = [
       'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
   ];
   $body = [
       'items' => $items,
       'payment' => $payment
   ];
   try {
     $api = new Gerencianet($options);
     $pay_charge = $api->oneStep([],$body);
     $linkBoleto = $pay_charge["data"]["pdf"]["charge"];
     $idBoleto = $pay_charge["data"]["charge_id"];
     $SQL = "INSERT INTO compras (id_boleto, link_pdf, id_produto)
     VALUES ('$idBoleto', '$linkBoleto', '$idProd')";
     $conn->query($SQL) or die($conn->error);
    header("location: ".$linkBoleto);

    } catch (GerencianetException $e) {
       print_r($e->code);
       print_r($e->error);
       print_r($e->errorDescription);
   } catch (Exception $e) {
       print_r($e->getMessage());
   }
?>