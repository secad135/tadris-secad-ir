<?php

$students = [
    [
        "name" => "ali",
        "family" => "asayee",
        "nomre" => 18,
    ],
    [
        "name" => "taha",
        "family" => "sehati",
        "nomre" => 15,
    ],
    [
        "name" => "pirooz",
        "family" => "heydari",
        "nomre" => 20,
    ],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
            direction: rtl;
        }
        th,td{
            border: solid 1px #000;
            padding: 8px;
            text-align: center;
        }
        th{
            background-color: lime;
            color:beige;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>name</th>
            <th>family</th>
            <th>nomre</th>
        </tr>

        <?php
        foreach ($students as $k => $v): ?>
            <tr>
                <td><?= $v['name']; ?></td>
                <td><?= $v['family']; ?></td>
                <td><?= $v['nomre']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>