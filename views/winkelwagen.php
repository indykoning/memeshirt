<?php
$sql = "SELECT * FROM bestelling JOIN images ON bestelling.id = images.bestelling_id WHERE users_id = " . $_SESSION['ID'];
$result = $mysqli->query($sql);

var_dump($_SESSION['ID']);
$totale_prijs = 0;

if(!empty($_POST['update'])) {
    $sql = "UPDATE images SET aantal = '" . $_POST['aantal'] . "', totaal_prijs = '".$_POST['aantal'] * $_POST['prijs']."' WHERE id = ".$_POST['id'];
    $result = $mysqli->query($sql);
    var_dump(mysqli_error($mysqli));
    var_dump($_POST);

}

while ($row = $result->fetch_assoc()) {
    echo "<table>";
    echo "<form method='post'>";
    echo "<input name='id' type='hidden' value='".$row['id']."' />";
    echo "<tr><td></td><td><img src='" . $row['filename'] . "' width='300px'></td></tr>";
    echo "<tr><td>Aantal </td><td><input type='number' name='aantal' value='" . $row['aantal'] . "'</td></tr>";
    echo "<tr><td>Prijs:</td><td>€<input style='border:none' name='prijs' readonly type='number' value='".$row['prijs']."'  /></td></tr>";
    echo "<tr><td>totaal Prijs:</td><td><p>€". $row['aantal'] * $row['prijs'] . "</p></td></tr>";
    echo "<tr><td></td><td><input type='submit' name='update' value='Sla op' /></td></tr>";
    echo "</form>";
    echo "</table>";
    echo "<hr>";
    $totale_prijs += $row['totaal_prijs'];
}
echo "<p>Totaal: ".$totale_prijs. "</p>";
?>
