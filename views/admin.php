<script>
    function refresh() {
        window.setTimeout(function () {
            document.location.href = document.location.href;
        }, 3000);
    }
</script>

<?php
$message = 'Welkom';

if (rank == 1){
    if(!empty($_POST['bestellingDone'])) {
        $sql = "UPDATE bestelling SET status = 3, eindDatum = CURRENT_TIMESTAMP WHERE id='". $_POST['id'] . "'";
        $sql = "SELECT * from bestelling WHERE id = ".$_POST['id']." ";
        $result = $mysqli->query($sql);

        $xs =  [];
        $s = [];
        $m = [];
        $l = [];
        $xl =  [];
        $xxl = [];

        $xs2 =  [];
        $s2 = [];
        $m2 = [];
        $l2 = [];
        $xl2 =  [];
        $xxl2 = [];

        $nogwat = 0;

        $sql = "SELECT * from images WHERE bestelling_id = ".$_POST['id']." ";
        $result = $mysqli->query($sql);
        $compleetKlaar = 0;
        while ($row = $result->fetch_assoc()) {
            $nogwat++;
            if($row['xs'] > 0){
                if($row['xs_status'] == 0){
                    $xs[$nogwat] = $row['xs'];
                    $compleetKlaar = 1;
                } else{
                    $xs2[$nogwat] = $row['xs'];
                }
            }
            if($row['s'] > 0){
                if($row['s_status'] == 0){
                    $s[$nogwat] = $row['s'];
                    $compleetKlaar = 1;
                } else{
                    $s2[$nogwat] = $row['s'];
                }
            }
            if($row['m'] > 0){
                if($row['m_status'] == 0){
                    $m[$nogwat] = $row['m'];
                    $compleetKlaar = 1;
                }else{
                    $m2[$nogwat] = $row['m'];
                }
            }
            if($row['l'] > 0){
                if($row['l_status'] == 0){
                    $l[$nogwat] = $row['l'];
                    $compleetKlaar = 1;

                }else{
                    $l2[$nogwat] = $row['l'];
                }
            }
            if($row['xl'] > 0){
                if($row['xl_status'] == 0){
                    $xl[$nogwat] = $row['xl'];
                    $compleetKlaar = 1;

                }else{
                    $xl2[$nogwat] = $row['xl'];
                }
            }
            if($row['xxl'] > 0){
                if($row['xxl_status'] == 0){
                    $xxl[$nogwat] = $row['xxl'];
                    $compleetKlaar = 1;

                }else{
                    $xxl2[$nogwat] = $row['xxl'];

                }
            }
        }
//        var_dump($sql);
//        echo "wat je nog krijgt: <br>xs: ".$xs." <br> s: ".$s."<br>m: ".$m." <br>l: ".$l."  <br>xl: ".$xl." <br>xxl: ".$xxl." ";

//        for ($i = 0; $i < count($s); $i++) {
//            echo $xs[$i]['xs'];
//            echo $s[$i]['s'];
//            echo $m[$i]['m'];
//            echo $l[$i]['l'];
//            echo $xl[$i]['xl'];
//            echo $xxl[$i]['xxl'];
//        }
//            print_r($s);
        ?>
        <table>
             <?php for ($i = 1; $i < $result->num_rows+1; $i++) {
            ?>
            <tr>
                <td>
                </td>
                <td>
                    <table>
                        <th>De maten</th>
                        <th>Gestuurd</th>
                        <th>Nog niet gestuurd</th>
                        <tr><td>xs </td><td><?php echo $xs2[$i] ?></td><td><?php echo $xs[$i]?></td></tr>
                        <tr><td>s </td><td><?php echo $s2[$i]  ?></td><td><?php echo $s[$i]?></td></tr>
                        <tr><td>m </td><td><?php echo $m2[$i]  ?></td><td><?php echo $m[$i]?></td></tr>
                        <tr><td>l </td><td><?php echo $l2[$i]  ?></td><td><?php echo $l[$i]?></td></tr>
                        <tr><td>xl </td><td><?php echo $xl2[$i]  ?></td><td><?php echo $xl[$i]?></td></tr>
                       <tr><td>xxl </td><td><?php echo $xxl2[$i]  ?></td><td><?php echo $xxl[$i]?></td></tr>
                    </table>
                </td>
            </tr>
                 <?php }?>
        </table>
<?php
        if($compleetKlaar == 0 ){
            $sql = "UPDATE bestelling SET status = 3, eindDatum = CURRENT_TIMESTAMP WHERE id='" . $_POST['id'] . "'";
            $result = $mysqli->query($sql);
        } else{
            $sql = "UPDATE bestelling set verstuurd_Status = 1 WHERE id='" . $_POST['id'] . "'";
            $result = $mysqli->query($sql);
        }
    }

if(!empty($_POST['showBestelling'])) {
    echo "<a href='?page=admin' class='button'>Ga terug</a>";

    $xs = (!empty($_POST['xs'])) ? '1' : '0';
    $s = (!empty($_POST['s'])) ? '1' : '0';
    $m = (!empty($_POST['m'])) ? '1' : '0';
    $l = (!empty($_POST['l'])) ? '1' : '0';
    $xl = (!empty($_POST['xl'])) ? '1' : '0';
    $xxl = (!empty($_POST['xxl'])) ? '1' : '0';

    $sql = "UPDATE images SET xs_status = ".$xs.", s_status = ".$s.", m_status = ".$m.", l_status = ".$l.", xl_status = ".$xl.", xxl_status = ".$xxl." WHERE id='". $_POST['id_img'] . "'";
    $result = $mysqli->query($sql);

    $sql = "SELECT * FROM bestelling WHERE id = " . $_POST['id'] . " ";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    if($row['status'] == 1){
        $sql = "UPDATE bestelling SET status = 2 WHERE id='". $_POST['id'] . "'";
        $result = $mysqli->query($sql);
    }
    echo "<div id='print'>";
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
    echo "<table id='table1'>";
    echo "<tr>";
    echo "<th>Opslaan</th>";
    echo "<th>Afbeelding</th>";
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
        echo "<input name='id_img' type='hidden' value='" .$row['id']. "' />";
        echo "<td><input type='submit' name='showBestelling' value='Sla op'/> </td>";
        echo "<td><div style='width: 200px'><img style=' display: block;width: 100%;height: auto;' src='order_images/" . $row['filename'] ."'></div></td>";
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

        echo "<td><a class='btn' href='order_images/".$row['filename']."' download='".$row['filename']."' >Download</a></td>";
        echo "</tr>";
        echo "<input name='id' type='hidden' value='" .$row['bestelling_id']. "' />";
        echo "</form>";
        echo "<form method='post'>";
        echo "<input name='id' type='hidden' value='" .$row['bestelling_id']. "' />";
    }
    echo "</table>";
    echo "<input type='submit' name='bestellingDone' value='Deze bestelling is klaar' />";
    echo "</form>";
    echo "</div>";
    echo "</div>";
?>
    <script>
        function PrintDiv() {
            var divToPrint = document.getElementById('print');
            var popupWin = window.open('', '_blank');
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }
    </script>
    <div>
        <input type="button" value="print" onclick="PrintDiv();" />
    </div>
<?php
} else {
    echo "<button class='button' onclick='window.location.href = \"?page=admin\"'>Bestellingen</button>";
    echo "<button class='button' onclick='window.location.href = \"?page=meme\"'>Memes</button>";
    echo "<button class='button' onclick='window.location.href = \"?page=prijs\"'>Prijzen</button>";

if(!empty($_POST['edit'])) {
    $sql = "UPDATE memes SET titel = '" . $_POST['titel'] . "', filename = '" . $_POST['filename'] . "' WHERE id='" . $_POST['id'] . "'";
    $result = $mysqli->query($sql);
    $message = 'Succesvol veranderd';
}

if(!empty($_POST['new'])) {
    $sql = "INSERT INTO memes (titel, filename) VALUES ('" . $_POST['titel'] . "', '" . $_POST['filename'] . "') ";
    $result = $mysqli->query($sql);
    $message = 'Succesvol toegevoegd';
}

if(!empty($_POST['delete'])) {
    $sql = "DELETE FROM memes WHERE id=". $_POST['id'] ." ";
    $result = $mysqli->query($sql);
    $message = 'Succesvol verwijderd';
}
    if($_GET['page'] == 'prijs'){

        if(isset($_POST['editprijs'])){
            $sql = "UPDATE prijzen SET XS=".$_POST['XS'].",S=".$_POST['S'].",M=".$_POST['M'].",L=".$_POST['L'].",XL=".$_POST['XL'].",XXL=".$_POST['XXL'] . " WHERE id=1";
            $mysqli->query($sql);
        }
        $sql = "SELECT * FROM prijzen WHERE id=1";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        echo "<form method='post' id='prijsForm'><table>
<input type='hidden' name='editprijs' value='edit'>
                <tr><td>XS</td><td>&euro;<input name='XS' onchange='document.getElementById(\"prijsForm\").submit()' type='number' min='0' value='" . $row['XS'] . "'></td></tr>
                <tr><td>S</td><td>&euro;<input name='S' onchange='document.getElementById(\"prijsForm\").submit()' type='number' min='0' value='" . $row['S'] . "'></td></tr>
                <tr><td>M</td><td>&euro;<input name='M' onchange='document.getElementById(\"prijsForm\").submit()' type='number' min='0' value='" . $row['M'] . "'></td></tr>
                <tr><td>L</td><td>&euro;<input name='L' onchange='document.getElementById(\"prijsForm\").submit()' type='number' min='0' value='" . $row['L'] . "'></td></tr>
                <tr><td>XL</td><td>&euro;<input name='XL' onchange='document.getElementById(\"prijsForm\").submit()' type='number' min='0' value='" . $row['XL'] . "'></td></tr>
                <tr><td>XXL</td><td>&euro;<input name='XXL' onchange='document.getElementById(\"prijsForm\").submit()' type='number' min='0' value='" . $row['XXL'] . "'></td></tr>
      </table></form>";
    }
    elseif($_GET['page'] == 'meme'){

    echo "<form method='post' style='margin-top: 7%'>";
    echo "<input type='text' name='titel' placeholder='Titel' />";
    echo "<input type='text' name='filename' placeholder='Bestandsnaam' />";
    echo "<input type='submit' name='new' value='Voeg toe'>";
    echo "</form>";

    $sql = "SELECT * FROM memes";
    $result = $mysqli->query($sql);
    echo "<table style='margin-top: 8%'>";
    echo "<tr>";
    echo "<th>Afbeelding</th>";
    echo "<th>Titel</th>";
    echo "<th>Bestandnaam</th>";
    echo "<th>Aanpassen</th>";
    echo "<th>Verwijderen</th>";
    echo "</tr>";
    echo "<tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<form method='post'>";
        echo "<input name='id' type='hidden' value='" .$row['id']. "' />";
        echo "<td><img src='" . $row['filename'] . "'  height='70px'/> </td>";
        echo "<td><input type='text' name='titel' value='" . $row['titel'] . "'/></td>";
        echo "<td><input type='text' name='filename' value='" . $row['filename'] . "' /></td>";
        echo "<td><input class='btn' type='submit' name='edit' value='Opslaan'></td>";
        echo "<td><input class='btn' type='submit' name='delete' value='Verwijder'></td>";
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
    }
    elseif($_GET['page'] == 'admin') {
        //Nieuwe bestellingen
        include "model/nieuweBestellingen.php";
        //Lopende bestellingen
        include "model/lopendeBestellingen.php";
        //Voltooide bestellingen
        include "model/voltooideBestellingen.php";
    }
    echo "<p style='   position: fixed; top: 87px; color: white; font-size: 120%; padding-top: 10px; padding-bottom: 10px; width: 100%; background-color: grey; text-align: center'>$message</p>";


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

    label{
        height: 10px;
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

    .button {
        background-color: lightsalmon;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10%;
        cursor: pointer;
    }
    a:link {
        text-decoration: none;
        color: white;
    };

    a:hover{
        color: white;
    }

    .button:hover{
        background-color: #F49517;
    }
    .btn {
        -webkit-border-radius: 4;
        -moz-border-radius: 4;
        border-radius: 4px;
        color: #ffffff;
        font-size: 20px;
        background: lightsalmon;
        padding: 10px 20px 10px 20px;
        text-decoration: none;
    }

    .btn:hover {
        background: #F49517;
        text-decoration: none;
    }
</style>

<!--<script>-->
<!--    var bestaandeMemes = document.getElementById("bestaandeMemes");-->
<!--    var bestelling = document.getElementById("bestelling");-->
<!---->
<!--    function showBestelling(){-->
<!--        bestelling.style.display = "inline";-->
<!--        bestaandeMemes.style.display = "none";-->
<!--    }-->
<!---->
<!--    function showMemes(){-->
<!--        bestaandeMemes.style.display = "inline";-->
<!--        bestelling.style.display = "none";-->
<!--    }-->
<!--    showBestelling()-->
<!--</script>-->