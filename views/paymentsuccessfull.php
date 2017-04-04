<?php
echo "<h1>payment</h1>";
$payment = $mollie->payments->get($_SESSION['payment_id']);
if (LOGGED_IN){
    $sql = "SELECT * FROM users WHERE id=" . $_SESSION['ID'];
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $to = $row['email'];
}else{
    $sql = "SELECT * FROM bestelling WHERE id=" . $_SESSION['bestelling_id'];
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $to = $row['b_email'];
}



$headers = "From: " . EMAIL . "\r\n";
$headers .= "Reply-To: ". EMAIL . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if($payment->isPaid()){
    $sql = "SELECT * FROM bestelling WHERE id = ".$_SESSION['bestelling_id'];
    $result = $mysqli->query($sql);
    if ($result->fetch_assoc()['totale_prijs'] == $_SESSION['payment_price']){
        $sql = "UPDATE bestelling SET status=1 WHERE id = ". $_SESSION['bestelling_id'];
        $result2 = $mysqli->query($sql);
        echo "<h1 style='color: green'>Payment successfull</h1>";
        $message = "<h1 style='color: green'>Betaling Succesvol</h1>";
        $subject = 'Bestelling successvol';
        unset($_SESSION['bestelling_id']);
    }else{
        //price changed since payment
        $refund = $mollie->payments->refund($payment);
        echo "<h1 style='color: red'>The price changed since the payment (did you add another item to cart?), you have been refunded</h1>";
        $subject = 'Bestelling mislukt';
        $message = "<h1 style='color: green'>Betaling Succesvol</h1>";
    }
}else{
    $subject = 'Bestelling mislukt';
    //not paid
}

$message = '<h1>leeg</h1>';
mail($to, $subject, $message, $headers);