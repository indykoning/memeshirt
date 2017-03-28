<?php
if (rank == 1){
    if(!empty($_POST['bestellingDone'])) {
        $sql = "UPDATE bestelling SET status = 3 WHERE id='". $_POST['id'] . "'";
        $result = $mysqli->query($sql);
    }

if(!empty($_POST['showBestelling'])) {
    $klaar = (!empty($_POST['klaar'])) ? '1' : '0';
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

    echo "<h3 style='margin-top: 10%  '>Contactgegevens</h3>";
    echo "<div id='trr'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>E-mail</th>";
    echo "<th>Straatnaam</th>";
    echo "<th>Huisnummer</th>";
    echo "<th>Postcode</th>";
    echo "<th>Plaatsnaam</th>";
    if(!empty($_POST['user_id'])) {
        echo "<th>Voornaam</th>";
        echo "<th>Achternaam</th>";
    }
    echo "</tr>";
    echo "<tr>";

    $sql = "SELECT * FROM bestelling WHERE id = " . $_POST['id'] . " ";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        if($row['b_huisnummer']) {
            echo "<td>" . $row['b_email'] . "</td>";
            echo "<td>" . $row['b_straatnaam'] . "</td>";
            echo "<td>" . $row['b_huisnummer'] . "</td>";
            echo "<td>" . $row['b_postcode'] . "</td>";
            echo "<td>" . $row['b_plaatsnaam'] . "</td>";
            echo "</tr>";
        }
    }
    if(!empty($_POST['user_id'])) {
        $sql = "SELECT * FROM users WHERE id = " . $_POST['user_id'] . " ";
        $result = $mysqli->query($sql);


        while ($row = $result->fetch_assoc()) {
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['straatnaam'] . "</td>";
            echo "<td>" . $row['huisnummer'] . "</td>";
            echo "<td>" . $row['postcode'] . "</td>";
            echo "<td>" . $row['plaatsnaam'] . "</td>";
            echo "<td>" . $row['voornaam'] . "</td>";
            echo "<td>" . $row['achternaam'] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";

    echo "<h3>Afbeeldingen</h3>";
    echo "<div id='trr'>";
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
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i += 1;
        echo "<form method='post'>";
        $aantal = 0;
        echo "<tr>";
        $checked = ($row['status_img'] == 1) ? 'checked' : '';
        echo "<input name='id_img' type='hidden' value='" .$row['id']. "' />";
        echo "<td><input $checked type='checkbox' name='klaar' id='$i'><label for='$i'> Deze afbeelding is geprint,gedrukt</label>";
        echo "<input type='submit' name='showBestelling' value='Sla op'/> </td>";
        $checked = ($row['xs_status'] == 1) ? 'checked' : '';$i += 1;
        echo "<td><input $checked type='checkbox' name='xs' id='$i' /><label for='$i'>".$row['xs']."</label> </td>";
        $checked = ($row['s_status'] == 1) ? 'checked' : ''; $i += 1;
        echo "<td><input $checked type='checkbox' name='s' id='$i' /><label for='$i'>".$row['s']."</label> </td>";
        $checked = ($row['m_status'] == 1) ? 'checked' : ''; $i += 1;
        echo "<td><input $checked type='checkbox' name='m' id='$i' /><label for='$i'>".$row['m']."</label> </td>";
        $checked = ($row['l_status'] == 1) ? 'checked' : ''; $i += 1;
        echo "<td><input $checked type='checkbox' name='l' id='$i' /><label for='$i'>".$row['l']."</label> </td>";
        $checked = ($row['xl_status'] == 1) ? 'checked' : ''; $i += 1;
        echo "<td><input $checked type='checkbox' name='xl' id='$i' /><label for='$i'>".$row['xl']."</label> </td>";
        $checked = ($row['xxl_status'] == 1) ? 'checked' : ''; $i += 1;
        echo "<td><input $checked type='checkbox' name='xxl' id='$i' /><label for='$i'>".$row['xxl']."</label> </td>";

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
    echo "</div id='trr'>";

} else {
if(!empty($_POST['edit'])) {
    $sql = "UPDATE memes SET titel = '" . $_POST['titel'] . "', filename = '" . $_POST['filename'] . "' WHERE id='" . $_POST['id'] . "'";
    $result = $mysqli->query($sql);
}

if(!empty($_POST['new'])) {
    $sql = "INSERT INTO memes (titel, filename) VALUES ('" . $_POST['titel'] . "', '" . $_POST['filename'] . "') ";
    $result = $mysqli->query($sql);
}

if(!empty($_POST['delete'])) {
    $sql = "DELETE FROM memes WHERE id=". $_POST['id'] ." ";
    $result = $mysqli->query($sql);
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
    #trr{
        background-color: #f5f5f5;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #F49517;
        color: white;
    }
    tr:hover{background-color:lightgrey}

</style>