<?php
$_SESSION['bestelling_id']= 1;

$sql = "SELECT id FROM bestelling WHERE id = ".$_SESSION['bestelling_id'];
$result = $mysqli->query($sql);
if($result->num_rows > 0) {

var_dump($_SESSION['ID']);
if(!empty($_POST['update'])) {
    $sql = "UPDATE images SET totaal_prijs = '".$_POST['prijs'] * ($_POST['xs'] + $_POST['s'] + $_POST['m'] + $_POST['l'] + $_POST['xl'] + $_POST['xxl'])."', xs = '" . $_POST['xs'] . "', s = '" . $_POST['s'] . "', m = '" . $_POST['m'] . "', l = '" . $_POST['l'] . "', xl = '" . $_POST['xl'] . "', xxl = '" . $_POST['xll'] . "' WHERE id = ".$_POST['id'];
    $result = $mysqli->query($sql);
    var_dump(mysqli_error($sql));

}
if(!empty($_POST['delete'])) {
    $sql = "DELETE FROM images WHERE id = ".$_POST['id'];
    $result = $mysqli->query($sql);
    if($result->num_rows == 0){
        $sql = "DELETE FROM bestelling WHERE id = ".$_SESSION['bestelling_id'];
        $result = $mysqli->query($sql);
    };
}

$sql = "SELECT * FROM bestelling JOIN images ON bestelling.id = images.bestelling_id WHERE bestelling.id = " . $_SESSION['bestelling_id'];
$result = $mysqli->query($sql);

$totale_prijs = 0;
var_dump($_POST);

$i = 0;
while ($row = $result->fetch_assoc()) {

    echo "<table>";
    echo "<form method='post' class='formpie'>";
    echo "<input name='id' type='hidden' value='".$row['id']."' />";
    echo "<tr><td></td><td><img src='" . $row['filename'] . "' width='300px'></td></tr>";
//    echo "<tr><td>Aantal </td><td><input class='aantal' onchange='liveEdit(" .$i++ . ")' min='1' type='number' name='aantal' value='" . $row['aantal'] . "'/></td></tr>";
    echo "<tr><td>Prijs:</td><td>€<input style='border:none' class='prijs' name='prijs' readonly type='number' value='".$row['prijs']."'  /></td></tr>";
    echo "<tr><td>totaal Prijs:</td><td><input style='border:none' readonly class='totaal_prijs' value='". $row['prijs'] * ($row['xs'] + $row['s'] + $row['m'] + $row['l'] + $row['xl'] + $row['xxl'])."'/></td></tr>";
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
echo "<input type='submit' name='betal' value='Betaal' />";

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

