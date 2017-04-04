<?php
$sql = "SELECT * FROM bestelling";
$result = $mysqli->query($sql);
echo "<h2>Nieuwe bestellingen</h2>";
echo "<tr>";
echo "<table>";
echo "<th>E-mail</th>";
echo "<th>Verschillende afbeeldingen</th>";
echo "<th>Aantal afbeeldingen</th>";
echo "<th>Openen</th>";
echo "</tr>";
echo "<tr>";

echo "<div><h2>Nieuwe bestellingen</h2>";
while ($row = $result->fetch_assoc()) {
    $aantal = 0;
    if ($row['users_id'] != Null) {
        if($row['status'] == 1){
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
            echo "<td><input class='btn' type='submit' onclick='refresh()' name='showBestelling' value='Open'/></td>";
            echo "<input type='submit' name='showBestelling' value='Open'/>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "<input name='user_id' type='hidden' value='" .$row['users_id']. "' />";
            echo "</form>";
        }
    }
    if ($row['users_id'] == Null){
        if ($row['status'] == 1) {
            echo "<td>" . $row['b_email'] . "</td>";
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
            echo "<td><input class='btn' type='submit' onclick='refresh()' name='showBestelling' value='Open'/></td>";
            echo "<input type='submit' name='showBestelling' value='Open'/>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "<input name='user_id' type='hidden' value='" .$row['users_id']. "' />";

            echo "</form>";
        }
    }
}
echo "</table>";


echo '                    <div class="col-xs-12">
                        <h1 class="h_bestelling">Bestellingen</h1>
                        <div class="blue_line"></div>
                    </div>

<div class="wrapper_winkelwagen" style="background-color: whitesmoke">
    <div class="row">
        <div class="col-sm-4 col-xs-12 row_winkelwagen">
                            <img class="img_shirt" src="links/greyfree.jpg" alt="">
                        </div>
                        <div class="col-sm-2 col-xs-6 padding_bestelling">
                            <h1 class="h_bestelling_specs">Kleur: Grijs</h1>
                            <h1 class="h_bestelling_specs">Maat: S</h1>
                        </div>
                        <div class="col-sm-2 hidden-xs padding_bestelling">
                            <h1 class="h_bestelling_specs">&euro; 19,95</h1>
                        </div>
                        <div class="col-sm-2 col-xs-8 padding_bestelling">
                            <select class="aantal">
                                <option value="australia">1</option>
                                <option value="canada">2</option>
                                <option value="usa">3</option>
                                <option value="usa">4</option>
                            </select>
                        </div>    <div class="col-sm-2 col-xs-4 padding_bestelling text_align_right_bestelling">
                            <h1 class="h_bestelling_specs2">&euro; 19,95</h1>
                            <p class="verwijderen">Verwijderen</p>
        </div>
    </div>
</div>
';
