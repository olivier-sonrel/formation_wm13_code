<?php
$arrayUser = [
    [
        'name' => 'Toto',
        'age' => 33,
        'passion' =>'bon con'
    ],
    [
        'name' => 'Tutu',
        'age' => 66,
        'passion' =>'bon cu'
    ],
    [
        'name' => 'Titi',
        'age' => 99,
        'passion' =>'bon ki'
    ],
    [
        'name' => 'Tata',
        'age' => 666,
        'passion' =>'bon k'
    ]
];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css"/>
        <title></title>
    </head>
    <body>
        <table>
        <?php
             foreach ($arrayUser[0] as $key => $value) {
                 echo "<th>$key</th>";
             }
        foreach ($arrayUser as $user) {
            echo "<tr>";
                foreach ($user as $value) {
                    echo "<td>$value</td>";
                }
            echo "</tr>";
        }?>
    </table>
    </body>
</html>
