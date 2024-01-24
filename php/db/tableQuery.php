<?php
include "connection.php";

function getGamesHistory($db)
{
    $stmt = $db->prepare("SELECT * FROM games_history");
    $stmt->execute();
    $fetchedResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $fetchedResult;
}
