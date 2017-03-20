<?php
if (rank == 1){
    echo "ezfix";

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

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<form method='post'>";
        echo "<input name='id' type='hidden' value='" .$row['id']. "' />";
        echo "<td><img src='" . $row['filename'] . "'  height='70px'/> </td>";
        echo "<td><input type='text' name='titel' value='" . $row['titel'] . "'/></td>";
        echo "<td><input type='text' name='filename' value='" . $row['filename'] . "' /></td>";
        echo "<td><input type='submit' name='edit' value='Opslaan'></td>";
        echo "<td><input type='submit' name='delete' value='Verwijder'></td>";
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";

    $sql = "SELECT * FROM bestelling";
    $result = $mysqli->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<td><input type='text' name='titel' value='" . $row['id'] . "'/></td>";
        echo "<td><input type='text' name='titel' value='" . $row['status'] . "'/></td>";
    }

}else{
    echo "Niet ingelogd";
//    header("Location: home");
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