<?php

$gamesHistory = getGamesHistory($db);
function makeTable($fetchedData)
{
    foreach ($fetchedData as $row) {
        echo "<tr>";
        foreach ($row as $key => $cell) {
            if ($key == 'date') {
                $dateTimeObject = new DateTime($cell);
                $dateArray = array(
                    'year' => $dateTimeObject->format('Y'),
                    'month' => $dateTimeObject->format('F'),
                    'day' => $dateTimeObject->format('d'),
                    'hours' => $dateTimeObject->format('H'),
                    'minutes' => $dateTimeObject->format('i')
                );
                echo "<td class='p-3'>" . $dateArray['day'] . " " . $dateArray['month'] . " " . $dateArray['year'] . "," . $dateArray['hours'] . ":" . $dateArray['minutes'];
            } else {
                echo "<td class='p-3'>" . $cell . "</td>";
            }
        }
        echo "</tr>";
    }

}