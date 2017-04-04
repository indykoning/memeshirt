<?php
$sql = "SELECT * FROM bestelling";
$result = $mysqli->query($sql);
echo "<h2>Voltooide bestellingen</h2>";
echo "<table>";
echo "<tr>";
echo "<th>E-mail</th>";
echo "<th>Voltooid op</th>";
echo "<th>Verschillende afbeeldingen</th>";
echo "<th>Aantal afbeeldingen</th>";
echo "<th>Openen</th>";
echo "</tr>";
echo "<tr>";

while ($row = $result->fetch_assoc()) {
    $aantal = 0;
    if ($row['users_id'] != Null) {
        if($row['status'] == 3){
            $sql3 = "SELECT * FROM users WHERE id = " . $row['users_id'] . " ";
            $result3 = $mysqli->query($sql3);
            while ($row3 = $result3->fetch_assoc()) {
                echo "<td>" . $row3['email'] . "</td>";
                echo "<td>" . $row['eindDatum'] . "</td>";
            }

//            $date1 = new DateTime($row['eindDatum']);
//            $date2 = new DateTime();
//            $date2->modify("+2 hours"); $date2->modify("-7 days");
//            if($date1 < $date2){
//                echo "<td>Word delete</td>";
//
//                $sql4 = "DELETE * FROM images WHERE id = ";
//            }

            $sql2 = "SELECT * FROM images WHERE bestelling_id = ".$row['id']. " ";
            $result2 = $mysqli->query($sql2);
            echo "<td>$result2->num_rows</td>";

            while ($row2 = $result2->fetch_assoc()) {
                $aantal += $row2['xs'] + $row2['s'] + $row2['m'] + $row2['l'] + $row2['xl'] + $row2['xxl'];
                $date1 = new DateTime($row['eindDatum']);
                $date2 = new DateTime();
                $date2->modify("+2 hours"); $date2->modify("-7 days");
                if($date1 < $date2){
                    $sql4 = "DELETE FROM images WHERE bestelling_id = ".$row['id']. " ";
                    $result4 = $mysqli->query($sql4);

                    $sql5 = "DELETE FROM bestelling WHERE id = ".$row['id']. " ";
                    $result5 = $mysqli->query($sql5);
                }
            }
            echo "<td>$aantal</td>";
            echo "<form target='_blank' method='post'>";
            echo "<td><input class='btn' type='submit' name='showBestelling' value='Open'/></td>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "<input name='user_id' type='hidden' value='" .$row['users_id']. "' />";
            echo "</tr>";
            echo "</form>";
        }
    }
    if ($row['users_id'] == Null){

        if ($row['status'] == 3) {
            echo "<td>" . $row['b_email'] . "</td>";
            echo "<td>" . $row['eindDatum'] . "</td>";


            $sql2 = "SELECT * FROM images WHERE bestelling_id = " . $row['id'] . " ";
            $result2 = $mysqli->query($sql2);
            echo "<td>$result2->num_rows</td>";

            while ($row2 = $result2->fetch_assoc()) {
                $aantal += $row2['xs'] + $row2['s'] + $row2['m'] + $row2['l'] + $row2['xl'] + $row2['xxl'];
                $date1 = new DateTime($row['eindDatum']);
                $date2 = new DateTime();
                $date2->modify("+2 hours"); $date2->modify("-7 days");
                if($date1 < $date2){
                    $sql4 = "DELETE FROM images WHERE bestelling_id = ".$row['id']. " ";
                    $result4 = $mysqli->query($sql4);

                    $sql5 = "DELETE FROM bestelling WHERE id = ".$row['id']. " ";
                    $result5 = $mysqli->query($sql5);
                }
            }
            echo "<td>$aantal</td>";
            echo "<form target='_blank' method='post'>";
            echo "<td><input class='btn' type='submit' name='showBestelling' value='Open'/></td>";
            echo "<input type='hidden' name='id' value='".$row['id']."' />";
            echo "<input name='user_id' type='hidden' value='" .$row['users_id']. "' />";
            echo "</tr>";
            echo "</form>";
        }
    }
}echo "</table>";