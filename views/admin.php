<?php
if (rank == 1){
    if(!empty($_POST['bestellingDone'])) {
        $sql = "UPDATE bestelling SET status = 1 WHERE id='". $_POST['id'] . "'";
        $result = $mysqli->query($sql);
    }
if(!empty($_POST['showBestelling'])) {

        $klaar = (!empty($_POST['klaar'])) ? '1' : '0';

    $sql = "SELECT * FROM images WHERE bestelling_id = " . $_POST['id'] . " ";
    $result = $mysqli->query($sql);
    echo "<form method='post'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Al gedownload?</th>";
    echo "<th>Aantal keer printen</th>";
    echo "<th>Downloaden</th>";
    echo "</tr>";
    echo "<tr>";
    while ($row = $result->fetch_assoc()) {
        $aantal = 0;
        echo "<tr>";
        $checked = ($row['status_img'] == 1) ? 'checked' : '';

        echo "<td><input $checked type='checkbox' name='klaar'>Deze afbeelding is geprint,gedrukt</td>";
        $aantal += $row['xs'] + $row['s'] + $row['m'] + $row['l'] + $row['xl'] + $row['xxl'];
        echo "<td>$aantal</td>";
        echo "<td><a href='/order_images' download='".$row['filename']."' >Download</a></td>";
        echo "</tr>";
        echo "<input name='id' type='hidden' value='" .$row['bestelling_id']. "' />";
    }
    echo "</table>";
    echo "<input type='submit' name='bestellingDone' value='Deze bestelling is klaar' />";
    echo "</form>";
} else {
if(!empty($_POST['edit'])) {
    $sql = "UPDATE memes SET titel = '" . $_POST['titel'] . "', filename = '" . $_POST['filename'] . "' WHERE id='" . $_POST['id'] . "'";
    $result = $mysqli->query($sql);
}

if(!empty($_POST['new'])) {
    $sql = "INSERT INTO memes (titel, filename) VALUES ('" . $_POST['titel'] . "', '" . $_POST['filename'] . "') ";
    $result = $mysqli->query($sql);
    var_dump($sql);
}

if(!empty($_POST['delete'])) {
    $sql = "DELETE FROM memes WHERE id=". $_POST['id'] ." ";
    $result = $mysqli->query($sql);
    var_dump($sql);
}
    echo "<form method='post'>";
    echo "<input type='text' name='titel' placeholder='Titel' />";
    echo "<input type='text' name='filename' placeholder='Bestandsnaam' />";
    echo "<input type='submit' name='new' value='Voeg toe'>";
    echo "</form>";

    $sql = "SELECT * FROM memes";
    $result = $mysqli->query($sql);
    echo "<table>";
    echo "<tr>";
    echo "<th>Afbeelding</th>";
    echo "<th>Titel</th>";
    echo "<th>Bestandnaam</th>";
    echo "<th>Aanpassen</th>";
    echo "<th>Verwijderen</th>";
    echo "</tr>";
    echo "<tr>";

//    while ($row = $result->fetch_assoc()) {
//        echo "<tr>";
//        echo "<form method='post'>";
//        echo "<input name='id' type='hidden' value='" .$row['id']. "' />";
//        echo "<td><img src='" . $row['filename'] . "'  height='70px'/> </td>";
//        echo "<td><input type='text' name='titel' value='" . $row['titel'] . "'/></td>";
//        echo "<td><input type='text' name='filename' value='" . $row['filename'] . "' /></td>";
//        echo "<td><input type='submit' name='edit' value='Opslaan'></td>";
//        echo "<td><input type='submit' name='delete' value='Verwijder'></td>";
//        echo "</form>";
//        echo "</tr>";
//    }
    echo "</table>";

    //Nieuwe bestellingen
    $sql = "SELECT * FROM bestelling";
    $result = $mysqli->query($sql);
    echo "<div><h2>Nieuwe</h2>";
    while ($row = $result->fetch_assoc()) {
        $aantal = 0;
        if ($row['users_id'] != Null) {
            if ($row['status'] == 0) {
                echo "<div style='border: 1px solid black;'>";
                $sql3 = "SELECT * FROM users WHERE id = " . $row['users_id'] . " ";
                $result3 = $mysqli->query($sql3);
                while ($row3 = $result3->fetch_assoc()) {
                    echo "<p>" . $row3['voornaam'] . "</p>";
                    echo "<p>" . $row3['achternaam'] . "</p>";
                }

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
        } if ($row['users_id'] == Null){
            if ($row['status'] == 0) {
                echo "<div style='border: 1px solid black;'>";
                echo "<p>" . $row['b_email'] . "</p>";
                echo "<p>" . $row['totale_prijs'] . "</p>";

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
    //Lopende bestellingen
    $sql = "SELECT * FROM bestelling";
    $result = $mysqli->query($sql);
    echo "<div><h2>Lopende bestellingen</h2>";
        while ($row = $result->fetch_assoc()) {
            $aantal = 0;
            if ($row['users_id'] != Null) {
                if($row['status'] == 1){
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
                if ($row['status'] == 1) {
                    echo "<div style='border: 1px solid black;'>";
                    echo "<p>" . $row['b_email'] . "</p>";
                    echo "<p>" . $row['totale_prijs'] . "</p>";

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
}}else{
    echo "Niet ingelogd";
    header("Location: home");
}
?>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #000;
    text-align: left;
    padding: 2px;
}

tr:nth-child(even) {
background-color: #dddddd;
}
</style>