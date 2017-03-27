<?php
if (rank == 1){
    if(!empty($_POST['bestellingDone'])) {
        $sql = "UPDATE bestelling SET status = 3 WHERE id='". $_POST['id'] . "'";
        $result = $mysqli->query($sql);
    }
//    if(!empty($_POST['textboxUpdate'])) {
//        $klaar = (!empty($_POST['klaar'])) ? '1' : '0';
//        $sql = "UPDATE images SET status_img = ". $klaar . " WHERE id='". $_POST['id_img'] . "'";
//        $result = $mysqli->query($sql);
//
//    }

if(!empty($_POST['showBestelling'])) {
    var_dump($_POST);
    $klaar = (!empty($_POST['klaar'])) ? '1' : '0';
//    $sql = "UPDATE images SET status_img = ". $klaar . " WHERE id='". $_POST['id_img'] . "'";
//    $result = $mysqli->query($sql);


    $xs = (!empty($_POST['xs'])) ? '1' : '0';
    $s = (!empty($_POST['s'])) ? '1' : '0';
    $m = (!empty($_POST['m'])) ? '1' : '0';
    $l = (!empty($_POST['l'])) ? '1' : '0';
    $xl = (!empty($_POST['xl'])) ? '1' : '0';
    $xxl = (!empty($_POST['xxl'])) ? '1' : '0';

    $sql = "UPDATE images SET status_img = ". $klaar . ", xs_status = ".$xs.", s_status = ".$s.", m_status = ".$m.", l_status = ".$l.", xl_status = ".$xl.", xxl_status = ".$xxl." WHERE id='". $_POST['id_img'] . "'";
    $result = $mysqli->query($sql);



    $sql = "SELECT * FROM bestelling WHERE id = " . $_POST['id'] . " ";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if($row['status'] == 1){
        $sql = "UPDATE bestelling SET status = 2 WHERE id='". $_POST['id'] . "'";
        $result = $mysqli->query($sql);
    }

    echo "<h3>Contactgegevens</h3>";
    $sql = "SELECT * FROM bestelling WHERE id = " . $_POST['id'] . " ";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        if($row['b_huisnummer']) {
            echo "<p>" . $row['b_email'] . "</p>";
            echo "<p>" . $row['b_straatnaam'] . "</p>";
            echo "<p>" . $row['b_huisnummer'] . "</p>";
            echo "<p>" . $row['b_postcode'] . "</p>";
        }
    }
    $sql = "SELECT * FROM users WHERE id = " . $_POST['id'] . " ";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row['voornaam'] . "</p>";
        echo "<p>" . $row['achternaam'] . "</p>";
        echo "<p>" . $row['email'] . "</p>";
        echo "<p>" . $row['straatnaam'] . "</p>";
        echo "<p>" . $row['huisnummer'] . "</p>";
        echo "<p>" . $row['postcode'] . "</p>";
        echo "<p>" . $row['plaatsnaam'] . "</p>";
    }

    $sql = "SELECT * FROM images WHERE bestelling_id = " . $_POST['id'] . " ";
    $result = $mysqli->query($sql);
    echo "<table>";
    echo "<tr>";
    echo "<th>Al gedownload?</th>";
    echo "<th>xs</th>";
    echo "<th>s</th>";
    echo "<th>m</th>";
    echo "<th>l</th>";
    echo "<th>xl</th>";
    echo "<th>xxl</th>";
    echo "<th>Downloaden</th>";
    echo "</tr>";
    echo "<tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<form method='post'>";
        $aantal = 0;
        echo "<tr>";
        $checked = ($row['status_img'] == 1) ? 'checked' : '';
        echo "<input name='id_img' type='hidden' value='" .$row['id']. "' />";
        echo "<td><input $checked type='checkbox' name='klaar'>Deze afbeelding is geprint,gedrukt";
        echo "<input type='submit' name='showBestelling' value='Sla op'/> </td>";
        $checked = ($row['xs_status'] == 1) ? 'checked' : '';
        echo "<td>".$row['xs']."<input $checked type='checkbox' name='xs' /></td>";
        $checked = ($row['s_status'] == 1) ? 'checked' : '';
        echo "<td>".$row['s']."<input $checked type='checkbox' name='s' /></td>";
        $checked = ($row['m_status'] == 1) ? 'checked' : '';
        echo "<td>".$row['m']."<input $checked type='checkbox' name='m' /></td>";
        $checked = ($row['l_status'] == 1) ? 'checked' : '';
        echo "<td>".$row['l']."<input $checked type='checkbox' name='l' /></td>";
        $checked = ($row['xl_status'] == 1) ? 'checked' : '';
        echo "<td>".$row['xl']."<input $checked type='checkbox' name='xl' /></td>";
        $checked = ($row['xxl_status'] == 1) ? 'checked' : '';
        echo "<td>".$row['xxl']."<input $checked type='checkbox' name='xxl' /></td>";
        echo "<td><a href='/order_images' download='".$row['filename']."' >Download</a></td>";
        echo "</tr>";
        echo "<input name='id' type='hidden' value='" .$row['bestelling_id']. "' />";
        echo "</form>";
        echo "<form method='post'>";
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
    include "model/nieuweBestellingen.php";

    //Lopende bestellingen
    include "model/lopendeBestellingen.php";

    //Voltooide bestellingen
    include "model/voltooideBestellingen.php";


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