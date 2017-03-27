<?php
//var_dump($_POST);
//$_SESSION['bestelling_id']= 3;
$sql = "SELECT * FROM bestelling WHERE id = ".$_SESSION['bestelling_id'];
$result = $mysqli->query($sql);
if (!empty($_POST['betaal'])){
    $goodTogo = true;

    if (!LOGGED_IN && !empty($_POST['email'])&& !empty($_POST['straatnaam'])&& !empty($_POST['huisnummer'])&& !empty($_POST['postcode'])&& !empty($_POST['plaatsnaam'])){
        $sql = "UPDATE bestelling SET b_email='" . $_POST['email'] . "', b_straatnaam='" . $_POST['straatnaam'] . "', b_huisnummer='" . $_POST['huisnummer'] . "', b_postcode='" . $_POST['postcode'] . "', b_plaatsnaam='" . $_POST['plaatsnaam'] . "' WHERE id=". $row['id'];
        $mysqli->query($sql);

    }elseif (!LOGGED_IN){
        echo "<h1 style='color: red'>Nog niet alle velden zijn ingevuld</h1>";
        $goodTogo = false;
    }
    if (LOGGED_IN || $goodTogo) {
        $row = $result->fetch_assoc();
        $payment = $mollie->payments->create(array(
            "amount" => $row['totale_prijs'],
            "description" => "Betaling Memeshirt",
            "redirectUrl" => $_SERVER['REQUEST_URI'] . "payment_successfull"
        ));
        $_SESSION['payment_id'] = $payment->id;
        $_SESSION['payment_price'] = $row['totale_prijs'];
        $sql = "UPDATE bestelling SET betalings_id='"  . $payment->id . "'";
        $mysqli->query($sql);
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
while ($row = $result->fetch_assoc()) {

    echo "<table>";
    echo "<form method='post' class='formpie'>";
    echo "<input name='id' type='hidden' value='".$row['id']."' />";
    echo "<tr><td></td><td><img src='order_images/" . $row['filename'] . "' width='300px'></td></tr>";
//    echo "<tr><td>Aantal </td><td><input class='aantal' onchange='liveEdit(" .$i++ . ")' min='1' type='number' name='aantal' value='" . $row['aantal'] . "'/></td></tr>";
//    echo "<tr><td>Prijs:</td><td>€<input style='border:none' class='prijs' name='prijs' readonly type='number' value='".$row['prijs']."'  /></td></tr>";
    echo "<tr><td>totaal Prijs:</td><td>€<input style='border:none' readonly class='totaal_prijs' value='". $row['totaal_prijs']."'/></td></tr>";
    echo "<tr><td>XS:</td><td><input name='xs' type='number' min='0' onchange='liveEdit(" .$i . ")' value='".$row['xs']."'/></td></tr>";
    echo "<tr><td>S:</td><td><input name='s' type='number' min='0' onchange='liveEdit(" .$i . ")' value='".$row['s']."'/></td></tr>";
    echo "<tr><td>M:</td><td><input name='m' type='number' min='0' onchange='liveEdit(" .$i . ")' value='".$row['m']."'/></td></tr>";
    echo "<tr><td>L:</td><td><input name='l' type='number' min='0' onchange='liveEdit(" .$i . ")' value='".$row['l']."'/></td></tr>";
    echo "<tr><td>XL:</td><td><input name='xl' type='number' min='0' onchange='liveEdit(" .$i . ")' value='".$row['xl']."'/></td></tr>";
    echo "<tr><td>XXL:</td><td><input name='xxl' type='number' min='0' onchange='liveEdit(" .$i . ")' value='".$row['xxl']."'/></td></tr>";
    echo "<tr><td></td><td><input type='hidden' name='update' value='Sla op' /></td></tr>";
    echo "<tr><td></td><td><input type='submit' name='delete' value='Verwijder' /></td></tr>";
    $totale_prijs += $row['totaal_prijs'];
    echo "</form>";
    echo "</table>";
    echo "<hr>";
    $i++;
}
echo "<p>Totaal: €".$totale_prijs. "</p>";
$sql = "UPDATE bestelling SET totale_prijs = ". $totale_prijs . " WHERE id= ". $_SESSION['bestelling_id'];
$mysqli->query($sql);

echo "<form method='post'>";
if (!LOGGED_IN){
 ?>
    <table>
    <tr><td><label>e-mail</label></td><td><input type="text" name="email" placeholder="e-mail"></td></tr>
            <tr><td><label>Straatnaam</label></td><td><input type="text" name="straatnaam" placeholder="straatnaam"></td></tr>
            <tr><td><label>huisnummer</label></td><td><input type="number" name="huisnummer" placeholder="huisnummer"></td></tr>
            <tr><td><label>postcode</label></td><td><input type="text" name="postcode" placeholder="postcode"></td></tr>
            <tr><td><label>plaatsnaam</label></td><td><input type="text" name="plaatsnaam" placeholder="plaatsnaam"></td></tr>
    </table>
    <?php
};
echo "<input type='submit' name='betaal' value='Betaal' /></form>";

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
    echo "<p>U heeft geen bestellingen</p>";
}

