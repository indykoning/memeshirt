<?php
include_once "config.php";
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_errno) {
    echo "Kan niet connecten met database, Error MySQL:
    (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

