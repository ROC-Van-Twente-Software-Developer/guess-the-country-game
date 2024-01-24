<?php

function makeTable($fetchedData)
{
    if ($fetchedData == null) {
        echo "<tr><td> <h5 class='text-center'> There's nothing right now. 
        Just play to add your game result here!</h5></td></tr>";
    } else {
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
                    echo "<td class='p-3'>" . $dateArray['day'] . " " . $dateArray['month']
                        . " " . $dateArray['year'] . ", <strong>" . $dateArray['hours'] . ":" . $dateArray['minutes']
                        . "</strong>";
                } else {
                    echo "<td class='p-3'>" . $cell . "</td>";
                }
            }
            echo "</tr>";
        }
    }
}