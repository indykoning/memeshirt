<?php

$sql = "SELECT * FROM memes";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<div class='col-xs-12 col-md-3 col-sm-4 no_padding'>";
    echo "<div class='wrapper_product' onclick='window.location.href = \"ontwerpen?foto=" . urlencode($row['filename']) . "\";'>";
    echo "<div class='wrapper_product'>";
    echo "<img class='img_product' src='".$row['filename']."' alt='' onmouseover='this.src=".$row['filename']." onmouseout='this.src=".$row['filename'].">";
    echo "</div></div></div>";
}
