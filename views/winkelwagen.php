<?php
//var_dump($_POST);
//$_SESSION['bestelling_id']= 3;

$sql = "SELECT * FROM bestelling WHERE id = ".$_SESSION['bestelling_id'];
$result = $mysqli->query($sql);
if (!empty($_POST['betaal'])){
    $goodTogo = true;

    if (!LOGGED_IN && !empty($_POST['email'])&& !empty($_POST['straatnaam'])&& !empty($_POST['huisnummer'])&& !empty($_POST['postcode'])&& !empty($_POST['plaatsnaam'])){
        $sql = "UPDATE bestelling SET b_email='" . $_POST['email'] . "', b_straatnaam='" . $_POST['straatnaam'] . "', b_huisnummer='" . $_POST['huisnummer'] . "', b_postcode='" . $_POST['postcode'] . "', b_plaatsnaam='" . $_POST['plaatsnaam'] . "' WHERE id=". $_SESSION['bestelling_id'];
        $mysqli->query($sql);
    }elseif (!LOGGED_IN){
        echo "<h1 style='color: red'>Nog niet alle velden zijn ingevuld</h1>";
        $goodTogo = false;
    }

    if (LOGGED_IN || $goodTogo) {
        $row = $result->fetch_assoc();


        try
        {
            $payment = $mollie->payments->create(array(
                "amount" => $row['totale_prijs'],
                "description" => "Betaling Memeshirt",
                "redirectUrl" => str_replace("/winkelwagen", "", $_SERVER['REDIRECT_URL']) . "/paymentsuccessfull"
            ));

            $_SESSION['payment_id'] = $payment->id;
            $_SESSION['payment_price'] = $row['totale_prijs'];
            $sql = "UPDATE bestelling SET betalings_id='"  . $payment->id . "'";
            $mysqli->query($sql);
            ?>
            <script>window.location.href ="<?php echo $payment->links->paymentUrl; ?>";</script>
            <a href="<?php echo $payment->links->paymentUrl; ?>"><h1>Klik hier om door te gaan naar de betaling</h1></a>
            <?php


        }
        catch (Mollie_API_Exception $e)
        {
            echo "Setting up payment failed";

        }


    }
}
if($result->num_rows > 0) {

if(!empty($_POST['update'])) {
    $xs = abs($_POST['xs']) * PRIJS_XS;
    $s = abs($_POST['s']) * PRIJS_S;
    $m = abs($_POST['m']) * PRIJS_M;
    $l = abs($_POST['l']) * PRIJS_L;
    $xl = abs($_POST['xl']) * PRIJS_XL;
    $xxl = abs($_POST['xxl']) * PRIJS_XXL;
    $totaal = $xs+$s+$m+$l+$xl+$xxl;
//    var_dump(PRIJS_XS);
    $sql = "UPDATE images SET totaal_prijs = '".$totaal."', xs = '" . $_POST['xs'] . "', s = '" . $_POST['s'] . "', m = '" . $_POST['m'] . "', l = '" . $_POST['l'] . "', xl = '" . $_POST['xl'] . "', xxl = '" . $_POST['xxl'] . "' WHERE id = ".$_POST['id'];
    $result = $mysqli->query($sql);

}
if(!empty($_POST['delete'])) {
    $sql = "SELECT * FROM images WHERE id = ".$_POST['id'];
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    unlink("order_images/" . $row['filename']);
    $sql = "DELETE FROM images WHERE id = ".$_POST['id'];
    $result = $mysqli->query($sql);

    $sql = "SELECT id FROM images WHERE bestelling_id = " . $_SESSION['bestelling_id'];
    $result2 = $mysqli->query($sql);

    if($result2->num_rows == 0){
        $sql = "DELETE FROM bestelling WHERE id = ".$_SESSION['bestelling_id'];
        $result = $mysqli->query($sql);
        unset($_SESSION['bestelling_id']);
    };
}

$sql = "SELECT * FROM bestelling JOIN images ON bestelling.id = images.bestelling_id WHERE bestelling.id = " . $_SESSION['bestelling_id'];
$result = $mysqli->query($sql);

$totale_prijs = 0;
$i = 0;

echo '    <div class="row">
        <div class="col-xs-12">
            <div class="wrapper_winkelwagen">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="h_bestelling">Winkelwagen</h1>
                        <div class="blue_line"></div>
                    </div>';
            
while ($row = $result->fetch_assoc()) {



echo '
<form method=\'post\' class=\'formpie\'>
    <div class="col-sm-4 col-xs-12 row_winkelwagen">
                        <img class="img_shirt" src="order_images/'.$row["filename"].'" alt="">
                    </div>
                    <div class="col-sm-2 col-xs-6 padding_bestelling">
                        <h1 class="h_bestelling_specs">Kleur: ' . $row["kleur"] . '</h1>
                    </div>
                    <div class="col-sm-4 col-xs-8" style="margin-top: 12px">
                    <table>
<tr><td>XS:</td><td><input name=\'xs\' type=\'number\' min=\'0\' onchange=\'liveEdit(' .$i . ')\' value=\''.$row["xs"].'\'/></td></tr>
<tr><td>S:</td><td><input name=\'s\' type=\'number\' min=\'0\' onchange=\'liveEdit(' .$i . ')\' value=\''.$row["s"].'\'/></td></tr>
<tr><td>M:</td><td><input name=\'m\' type=\'number\' min=\'0\' onchange=\'liveEdit(' .$i .' )\' value=\''.$row["m"].'\'/></td></tr>
<tr><td>L:</td><td><input name=\'l\' type=\'number\' min=\'0\' onchange=\'liveEdit(' .$i . ')\' value=\''.$row["l"].'\'/></td></tr>
<tr><td>XL:</td><td><input name=\'xl\' type=\'number\' min=\'0\' onchange=\'liveEdit(' .$i . ')\' value=\''.$row["xl"].'\'/></td></tr>
<tr><td>XXL:</td><td><input name=\'xxl\' type=\'number\' min=\'0\' onchange=\'liveEdit(' .$i . ')\' value=\''.$row["xxl"].'\'/></td></tr>
</table>
                    </div>
                    <div class="col-sm-2 col-xs-4 padding_bestelling text_align_right_bestelling">
                        <h1 class="h_bestelling_specs2">&euro; '. $row["totaal_prijs"] .'</h1>
                        <p class="verwijderen" style><label style="cursor: pointer;margin-bottom: 145px;" for="delete_wagen_'.$i.'">Verwijderen</label></p>
                    </div>
                    
';
    echo "<input name='id' type='hidden' value='".$row['id']."' />";
    echo "<input type='hidden' name='update' value='Sla op' />";
    echo "<input type='submit' style='display:none' id='delete_wagen_".$i."' name='delete' value='Verwijder'/>";
    $i++;
    $totale_prijs += $row['totaal_prijs'];
    echo "</form>";
}
echo "</div>
                 <div class=\"col-xs-12 row_winkelwagen\">
                        <div class=\"blue_line\"></div>
                    </div>
                 <div class=\"col-sm-3 col-sm-offset-7 col-xs-6 row_winkelwagen\">
                        <h1 class=\"h_verzendkosten\">Verzendkosten:</h1>
                        <h1 class=\"h_totaal_prijs\">Totale prijs:</h1>
                    </div>
                    <div class=\"col-sm-2 col-xs-6 row_winkelwagen text_align_right_totaal\">
                        <h1 class=\"h_verzendkosten\">&euro; 0,00</h1>
                        <h1 class=\"h_totaal_prijs\">&euro; ".$totale_prijs."</h1>
                    </div>
                    ";
$sql = "UPDATE bestelling SET totale_prijs = ". $totale_prijs . " WHERE id= ". $_SESSION['bestelling_id'];
$mysqli->query($sql);

echo "<form method='post'>";
if (!LOGGED_IN){
 ?>
    <div class="row">
    <div class="col-xs-12">
    <div class="wrapper_registreren">
        <div class="col-sm-6 col-xs-12">
        <div class="form-group">
    <span class="p_form">E-mailadres</span><input type="text" name="email" placeholder="e-mail" class="form-control">
            </div>
            </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <span class="p_form">Straatnaam</span><input type="text" name="straatnaam" placeholder="straatnaam" class="form-control">
                </div>
            </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <span class="p_form">Huisnummer</span><input type="number" name="huisnummer" placeholder="huisnummer" class="form-control">
                </div>
                </div>
        <div class="col-sm-2 col-xs-4">
            <div class="form-group">
                <span class="p_form">Postcode</span><input type="text" name="postcode" placeholder="postcode" class="form-control">
                </div>
                </div>
        <div class="col-sm-4 col-xs-8">
            <div class="form-group">
                <span class="p_form">Plaats</span><input type="text" name="plaatsnaam" placeholder="plaatsnaam" class="form-control">
                </div>

    </div>
    </div>
    </div>
    </div>

    <?php
};
    echo "<div class='col-xs-12' style='background-color: white !important;'>
                <input type='submit' name='betaal' value='Betaal' class='btn btn-info btn_ontwerpproces_verder h_button_verder' style='margin-bottom: 10px'/>
            </div></form>";
if(!empty($_POST['update'])) {
    $sql = "UPDATE bestelling SET totale_prijs = '". $totale_prijs ."' WHERE id = ".$_POST['id'];
    $result = $mysqli->query($sql);
}
?>
<script>
    function liveEdit(id){
        document.getElementsByClassName("formpie")[id].submit();
    }
</script>
<?php
}
else{
    echo "<p style='margin-top: 8%'>U heeft geen bestellingen</p>";
}

