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
        $message = '<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Memeshirt</title>
</head>

<body>

  <style type="text/css">
    .apple-footer a {
        text-decoration: none !important;
        color: #999999 !important;
        border: none !important;
      }
      .apple-email a {
        text-decoration: none !important;
        color: #448BFF !important;
        border: none !important;
      }
  </style>
  <div id="wrapper" style="background-color:#ffffff; margin:0 auto; text-align:center; width:100%" bgcolor="#ffffff" align="center" width="100%">
    <table class="main-table" align="center" style="-premailer-cellpadding:0; -premailer-cellspacing:0; background-color:#ffffff; border:0; margin:0 auto; max-width:480px; mso-table-lspace:0; mso-table-rspace:0; padding:0; text-align:center; width:480" cellpadding="0"
      cellspacing="0" bgcolor="#ffffff" width="480">

      <tbody>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="logo" align="center" style="background-color:#ffffff; text-align:center; width:480" bgcolor="#ffffff" width="480">
            <a href="http://memeshirt.nl/" target="_blank"><img src="http://memeshirt.nl/links/logo.png" title="Google" alt="Google"></a>
          </td>
        </tr>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>

        <tr>
          <td>

          </td>
        </tr>
        <tr>
          <td class="headline" style="color:#444444; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:30px; font-weight:100; line-height:36px; margin:0 auto; padding:0; text-align:center" align="center">Bedankt voor uw aankoop!</td>
        </tr>
        <tr>
          <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="copy" style="color:#666666; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:18px; line-height:30px; text-align:center" align="center">Uw shirt(s) zijn binnen twee werkdagen in huis.</td>
        </tr>


        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td>
            <table class="footer-table" style="-premailer-width:480; background-color:#ececec; margin:0 auto; text-align:center" width="480" bgcolor="#ececec" align="center">
              <tbody>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
                <tr>
                  <td class="social-text" style="color:#999999; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:16px; line-height:26px">Contact</td>
                </tr>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
                <tr>
                  <td class="social-text" style="color:#999999; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:16px; line-height:18px">E: info@Thisway.nl</td>
                </tr>
                <tr>
                  <td class="social-text" style="color:#999999; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:16px; line-height:18px">T: 035-6560168</td>
                </tr>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
                <tr>
                  <td>
                    <table class="footer-content" align="center" style="-premailer-width:420; margin:0 auto; padding:0; text-align:center" width="420">
                      <tbody>
                        <tr>
                        

                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
              </tbody>
            </table>

          </td>
        </tr>
      </tbody>
    </table>
  </div>


</body>';
        $subject = 'Bestelling successvol';
        unset($_SESSION['bestelling_id']);
        mail($to, $subject, $message, $headers);
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

