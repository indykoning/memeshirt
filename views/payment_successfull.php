<?php
$payment = $mollie->payments->get($_SESSION['payment_id']);

if($payment->isPaid()){
    $sql = "SELECT * FROM bestelling WHERE id = ".$_SESSION['bestelling_id'];
    $result = $mysqli->query($sql);
    if ($result->fetch_assoc()['totale_prijs'] == $_SESSION['payment_price']){
        $sql = "UPDATE bestelling SET status=1 WHERE id = ". $_SESSION['bestelling_id'];
        $result2 = $mysqli->query($sql);
    }else{
        //price changed since payment
        $refund = $mollie->payments->refund($payment);
        echo "<h1 style='color: red'>The price changed since the payment (did you add another item to cart?), you have been refunded</h1>";
    }
}