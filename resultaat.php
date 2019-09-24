<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
</body>
<?php
require_once ('connectvars.php');


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM dca_werknemers";

$data = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($data)) {

    echo '<div class="footer">';
    echo '<p class="groet">Met vriendelijke groet,</p> <br/>';
    echo '<p class="naam">' . $row['naam'] .'</p>';
    echo '<p class="functie">' . $row['functie'] . '</p><hr class="streepje">';
    echo '<i class="far fa-envelope"></i><p  class="icontekst">'. $row['email'] .'</p><br/>';
    echo '<i class="fas fa-phone"></i><p  class="icontekst">'. $row['telefoonnummer'] .'</p><br/>';
    echo '<i class="fab fa-wordpress-simple"></i><p class="icontekst">'. $row['website'] .'</p><br/>';

    // twitter ROW deze is niet verplicht
    if (!empty($row['twitter'])) {
        echo '<i class="fab fa-twitter"></i><p class="icontekst">' . $row['twitter'] . '</p><br/>';
    }else {
        echo '';
    }

    // linkedIN ROW deze is niet verplicht
if (!empty($row['linkedin'])) {
    echo '<i class="fab fa-linkedin-in"></i><p class="icontekst">' . $row['linkedin'] . '</p><br/>';
}else {
    echo '';
}

// dit is de functie die bepaald welke image wordt afgebeeld
        if ($row['logo'] == 0){
            echo '<img class="logoformaat" src="img/BB_logo_2017.jpg">';
        }else if ($row['logo'] == 1){
            echo '<img class="ui" src="img/Capture.JPG">';
        }else if ($row['logo'] == 2){
            echo '<img class="dca" src="img/DCA-MULTIMEDIA-logo-2016-CMYK.png">';
        }else if ($row['logo'] == 3){
            echo '<img class="dca" src="img/ICT-logo-2017-CMYK.png">';
        }else if ($row['logo'] == 4){
            echo '<img class="dca2015" src="img/DCAGROEP-logo-2015-CMYK.jpg">';
        }else if ($row['logo'] == 5){
            echo '<img class="dca" src="img/DCA_logo_2015_CMYK.png">';
        }else if ($row['logo'] == 6){
            echo '<img class="dca" src="img/DCA-Markets_logo_2018.png">';
        }



    echo '</div>';
}



mysqli_close($dbc)
?>
</body>
</html>