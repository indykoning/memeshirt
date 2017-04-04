<?php
$sql = "SELECT * FROM bestelling";
$result = $mysqli->query($sql);
echo "<h2>Lopende bestellingen</h2>";
echo "<table>";
echo "<tr>";
echo "<th>Status</th>";
echo "<th>E-mail</th>";
echo "<th>Verschillende afbeeldingen</th>";
echo "<th>Aantal afbeeldingen</th>";
echo "<th>Openen</th>";
echo "</tr>";
echo "<tr>";

while ($row = $result->fetch_assoc()) {
    $aantal = 0;
    if ($row['users_id'] != Null) {
        if($row['status'] == 2){
            if($row['verstuurd_Status'] == 1){
                echo "<td style='background-color: lightsalmon'></td>";
            }else{
                echo "<td style='background-color: white'></td>";
            };
            $sql3 = "SELECT * FROM users WHERE id = " . $row['users_id'] . " ";
            $result3 = $mysqli->query($sql3);
            while ($row3 = $result3->fetch_assoc()) {
                echo "<td>" . $row3['email'] . "</td>";
            }
            $sql2 = "SELECT * FROM images WHERE bestelling_id = ".$row['id']. " ";
            $result2 = $mysqli->query($sql2);
            echo "<td>$result2->num_rows</td>";

            while ($row2 = $result2->fetch_assoc()) {
                $aantal += $row2['xs'] + $row2['s'] + $row2['m'] + $row2['l'] + $row2['xl'] + $row2['xxl'];
            }
            echo "<td>$aantal</td>";
            echo "<form target='_blank' method='post'>";
            echo "<td><input class='btn' type='submit' onclick='refresh()' name='showBestelling' value='Open'/></td>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "<input name='user_id' type='hidden' value='" .$row['users_id']. "' />";
            echo "</tr>";
            echo "</form>";
        }
    }
    if ($row['users_id'] == Null){
        if ($row['status'] == 2) {
            if($row['verstuurd_Status'] == 1){
                echo "<td style='background-color: lightsalmon'></td>";
            }else{
                echo "<td style='background-color: white'></td>";
            };
            echo "<td>" . $row['b_email'] . "</td>";

            $sql2 = "SELECT * FROM images WHERE bestelling_id = " . $row['id'] . " ";
            $result2 = $mysqli->query($sql2);
            echo "<td>$result2->num_rows</td>";

            while ($row2 = $result2->fetch_assoc()) {
                $aantal += $row2['xs'] + $row2['s'] + $row2['m'] + $row2['l'] + $row2['xl'] + $row2['xxl'];
            }
            echo "<td>$aantal</td>";            echo "<form target='_blank' method='post'>";
            echo "<td><input class='btn' type='submit' onclick='refresh()' name='showBestelling' value='Open'/></td>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "<input name='user_id' type='hidden' value='" .$row['users_id']. "' />";
            echo "</tr>";
            echo "</form>";
        }
    }
}echo "</table>";

