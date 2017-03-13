<?php
$sql = "SELECT * FROM memes";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<a href='#'><img src='" . $row['filename'] . "' width='300px'></a>";
}
?>

