

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My page</title>
    <style>
        table {
            border-collapse: collapse
        }
        td {
            border: 1px solid black; /* Стиль рамки: один піксель товщиною, сірий колір */
            padding: 5px;
        }
        h1 {
            font-size: 20px;
            font-family: helvetica;
        }
         .first-element {
            background-color: green;
        }
        .last-element {
            background-color: red;
        }
    </style>
</head>
<body>
<?php

function generateRandomMatrix($rows, $cols) {
    $matrix = [];
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $matrix[$i][$j] = rand(0, 99);
        }
    }
    return $matrix;
}

function printMatrix($matrix) {
    echo '<table>';
    foreach ($matrix as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function findMin(&$matrix) {
    foreach ($matrix as &$row) {

        $minValue = $row[$minIndex = 0];


        for ($i = 1; $i < count($row); $i++) {
            if ($row[$i] < $minValue) {
                $minValue = $row[$i];
                $minIndex = $i;
            }
        }

        $temp = $row[0];
        $row[0] = $minValue;
        $row[$minIndex] = $temp;
    }
    unset($row);
    return $matrix;
}

function findMax(&$matrix) {
    foreach ($matrix as &$row) {
        $maxValue = $row[count($row) - 1];
        $maxIndex = count($row) - 1;

        for ($i = count($row) - 2; $i >= 0; $i--) {
            if ($row[$i] > $maxValue) {
                $maxValue = $row[$i];
                $maxIndex = $i;
            }
        }

        $temp = $row[count($row) - 1];
        $row[count($row) - 1] = $maxValue;
        $row[$maxIndex] = $temp;
    }
    unset($row);
    return $matrix;
}

function printFinMatrix($matrix) {
    echo '<table>';
    foreach ($matrix as $row) {
        echo '<tr>';
        foreach ($row as $key => $value) {
            $class = '';
            if ($key === 0) {
                $class = ' class="first-element"';
            } elseif ($key === count($row) - 1) {
                $class = ' class="last-element"';
            }
            echo "<td $class>$value</td>";

        }
        echo '</tr>';
    }
    echo '</table>';
}

echo '<h1>First matrix:</h1>';
$matrix = generateRandomMatrix(20, 20);
printMatrix($matrix);

echo '<h1>Second matrix:</h1>';

findMin($matrix);
findMax($matrix);
printFinMatrix($matrix);


echo '<h1>Next Task</h1>';

$dir = './mp3';
$files = scandir($dir);
$sort = "Name song";

if (empty($_GET["sort_button"])) {
    $sort = "Name song";
} else {
    $sort = $_GET["sort"];
}

function splitTheName($first_song, $second_song) {
    global $sort;

    $fileInfo = [
        "Artist" => 0,
        "Year" => 1,
        "Album" => 2,
        "Name song" => 3
    ];

    $first_song_element = explode(" -- ", basename($first_song, ".mp3"));
    $second_song_element = explode(" -- ", basename($second_song, ".mp3"));

    if (count($first_song_element) == 4 && array_key_exists($sort, $fileInfo)) {
        $first_value = $first_song_element[$fileInfo[$sort]];
        $second_value = $second_song_element[$fileInfo[$sort]];

        return strcmp($first_value, $second_value);
    }
}

echo "Currently sorting is used: $sort";
echo " ";
usort($files, 'splitTheName');

echo '<form method="get">
<select name="sort">
    <option value="Artist">Artist</option>
    <option value="Year">Year</option>
    <option value="Album">Album</option>
    <option value="Name">Name song</option>
</select>
<input type="submit" name="sort_button" value="Sort">
</form>';

echo '<table>
    <tr>
        <th>Artist</th>
        <th>Year</th>
        <th>Album</th>
        <th>Name song</th>
        <th>Player</th>
        <th>Download</th>
    </tr>';

foreach ($files as $song) {
    $song_element = explode(" -- ", basename($song, ".mp3"));
    if (count($song_element) == 4) {
        $audioSrc = "$dir/$song";
        $tableRow = "<tr>
            <td>$song_element[0]</td>
            <td>$song_element[1]</td>
            <td>$song_element[2]</td>
            <td>$song_element[3]</td>
            <td><audio controls src='$audioSrc'></audio></td>
            <td><a href='$audioSrc' download>Download</a></td>
            </tr>";
        echo $tableRow;
    }
}

echo '</table>';

?>

</body>
</html>