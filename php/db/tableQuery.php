<?php
include "connection.php";

function getGamesHistory($db)
{
    $stmt = $db->prepare("SELECT * FROM games_history
    ORDER BY number DESC
    LIMIT 3");
    $stmt->execute();
    $fetchedResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $fetchedResult;
}

function getBestScore($db) {
    $stmt = $db->prepare("SELECT *
    FROM games_history
    ORDER BY score DESC, roundtime DESC
    LIMIT 3");
    $stmt->execute();
    $fetchedResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $fetchedResult;
}
