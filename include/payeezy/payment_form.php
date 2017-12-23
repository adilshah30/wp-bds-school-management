<?php
require_once 'vendor/autoload.php';

$client = new Payeezy_Client();
$client->setApiKey("HuvCdLpNsiFEIVoPg24JGR2pAER7PI41");
$client->setApiSecret("f1e777357c94aefdc47350a9b3032bfad91d3f5e692dcf7ef3c9d4c1d10c9ec4");
$client->setMerchantToken("fdoa-4c92e0793dfb4ae60b314aa81fda13d04c92e0793dfb4ae6");
$client->setUrl("https://api-cert.payeezy.com/v1/transactions");
//$client->setTokenUrl("https://api-cert.payeezy.com/v1/transactions/tokens");
//$client->setUrl("https://api.demo.globalgatewaye4.firstdata.com/transaction");
$card_transaction = new Payeezy_CreditCard($client);
$response = $card_transaction->purchase([
  //"merchant_ref" => "Astonishing-Sale",
  "transaction_type"=> "purchase",
  "method"=>"credit_card",
  "amount" => "200",
  "currency_code" => "USD",
  "partial_redemption"=> "false",
  "credit_card" => array(
    "type" => "visa",
    "cardholder_name" => "Adil Shah Test Transaction",
    "card_number" => "4012000033330026",
    "exp_date" => "0418",
    "cvv" => "123"
  )
]);
echo "<pre>";
if($response);
echo "</pre>";
//echo "ssss";
?>