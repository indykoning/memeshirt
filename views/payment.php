<?php
require_once "includes/mollie/Autoloader.php";

//betaling versturen
$mollie = new Mollie_API_Client();
$mollie->setApiKey('leeg');
$payment = $mollie->payments->create(array(
    "amount"=>$prijs,
    "description" => "Betaling Memeshirt",
    "redirectUrl" => $_SERVER['REQUEST_URI'] . "payment_successfull?id="
));

$_SESSION['payment_id'] = $payment->id;
//betaling binnen halen
$payment = $mollie->payments->get($payment->id);

if($payment->isPaid()){
    echo "ez betaald";
}

