<?php
$sql = "SELECT * FROM bestelling";
$result = $mysqli->query($sql);
echo "<div><h2>Voltooide bestellingen</h2>";
while ($row = $result->fetch_assoc()) {
    $aantal = 0;
    if ($row['users_id'] != Null) {
        if($row['status'] == 3){
            echo "<div style='border: 1px solid black;'>";
            $sql3 = "SELECT * FROM users WHERE id = " . $row['users_id'] . " ";
            $result3 = $mysqli->query($sql3);
            while ($row3 = $result3->fetch_assoc()) {
                echo "<p>" . $row3['voornaam'] . "</p>";
                echo "<p>" . $row3['achternaam'] . "</p>";
            }
            $sql2 = "SELECT * FROM images WHERE bestelling_id = ".$row['id']. " ";
            $result2 = $mysqli->query($sql2);
            echo "Aantal verschillende afbeelding: $result2->num_rows";

            while ($row2 = $result2->fetch_assoc()) {
                $aantal += $row2['xs'] + $row2['s'] + $row2['m'] + $row2['l'] + $row2['xl'] + $row2['xxl'];
            }
            echo "<br>Aantal afbeeldingen om te printen: $aantal";
            echo "<form target='_blank' method='post'>";
            echo "<input type='submit' name='showBestelling' value='Open'/>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    }
    if ($row['users_id'] == Null){
        if ($row['status'] == 3) {
            echo "<div style='border: 1px solid black;'>";
            echo "<p>" . $row['b_email'] . "</p>";
            echo "<p>" . $row['totale_prijs'] . "</p>";
            echo "<p>" . $row['eindDatum'] . "</p>";

            $sql2 = "SELECT * FROM images WHERE bestelling_id = " . $row['id'] . " ";
            $result2 = $mysqli->query($sql2);
            echo "Aantal verschillende afbeelding: $result2->num_rows";

            while ($row2 = $result2->fetch_assoc()) {
                $aantal += $row2['xs'] + $row2['s'] + $row2['m'] + $row2['l'] + $row2['xl'] + $row2['xxl'];
            }
            echo "<br>Aantal afbeeldingen om te printen: $aantal";
            echo "<form target='_blank' method='post'>";
            echo "<input type='submit' name='showBestelling' value='Open'/>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    }
}