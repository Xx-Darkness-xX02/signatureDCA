<link rel="stylesheet" href="test.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<?php
require_once ('connectvars.php');


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM dca_werknemers";

$data = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($data)) {
//BOERENBUSINESS FOOTERS
    if ($row['logo'] == 0) {
        echo '<div class="footerboerenbusiness">';
        echo '<p class="groet">Met vriendelijke groet,</p> <br/>';
        echo '<p class="naam">' . $row['naam'] . '</p>';
        echo '<p class="functie">' . $row['functie'] . '</p>';
        echo '<i class="far fa-envelope"></i><p  class="icontekst">' . $row['email'] . '</p><br/>';
        echo '<i class="fas fa-phone"></i><p  class="icontekst">' . $row['telefoonnummer'] . '</p><br/>';
        echo '<i class="fab fa-wordpress-simple"></i><p class="icontekst">' . $row['website'] . '</p><br/>';

        // twitter ROW deze is niet verplicht
        if (!empty($row['twitter'])) {
            echo '<i class="fab fa-twitter"></i><p class="icontekst">' . $row['twitter'] . '</p><br/>';
        } else {
            echo '';
        }

        // linkedIN ROW deze is niet verplicht
        if (!empty($row['linkedin'])) {
            echo '<i class="fab fa-linkedin-in"></i><p class="icontekst">' . $row['linkedin'] . '</p><br/>';
        } else {
            echo '';
        }

        // Disclaimer 1

// dit is de functie die bepaald welke image wordt afgebeeld
        if ($row['logo'] == 0) {
            echo '<img class="logoformaat" src="img/boerenbusiness.jpg.JPG"><br/>';
        } else if ($row['logo'] == 1) {
            echo '<img class="ui" src="img/Capture.JPG"><br/>';
        } else if ($row['logo'] == 2) {
            echo '<img class="dca" src="img/DCA-MULTIMEDIA-logo-2016-CMYK.png"><br/>';
        } else if ($row['logo'] == 3) {
            echo '<img class="dca" src="img/ICT-logo-2017-CMYK.png"><br/>';
        } else if ($row['logo'] == 4) {
            echo '<img class="dca2015" src="img/DCAGROEP-logo-2015-CMYK.jpg"><br/>';
        } else if ($row['logo'] == 5) {
            echo '<img class="dca" src="img/DCA_logo_2015_CMYK.png"><br/>';
        } else if ($row['logo'] == 6) {
            echo '<img class="dca" src="img/DCA-Markets_logo_2018.png"><br/>';
        }

        //dit is de functie die bepaald of er wel of geen social media iconen moeten komen te staan
        if ($row['socialmedia'] == 'yes'){
            echo '<div class="socialicons">';
            echo '<i class="fab fa-facebook-f"></i>';
            echo '<i class="fab fa-twitter"></i>';
            echo '<i class="fab fa-youtube"></i>';
            echo '</div><hr class="streepje2 " />';
        }elseif ($row['socialmedia'] == 'no'){
            echo '';
        }

        if (!empty($row['element1']) && $row['socialmedia']== 'yes'){
            echo '<p class="disclaimer">' . $row['element1'] . '</p>';
        }
        elseif (!empty($row['element1']) && ($row['socialmedia']== 'no')){
            echo '<hr class="streepje2" />';
            echo '<p class="disclaimer">' . $row['element1'] . '</p>';
        } elseif (empty($row['element1'])){
            echo '';
        }

        echo '</div>';
    }


    //UIENHANDEL FOOTERS
    else    if ($row['logo'] == 1) {
        echo '<div class="footeruienhandel">';
        echo '<p class="groet">Met vriendelijke groet,</p> <br/>';
        echo '<p class="naam">' . $row['naam'] . '</p>';
        echo '<p class="functie">' . $row['functie'] . '</p>';
        echo '<div class="lijntje">';
        echo '<i class="far fa-envelope"></i><p  class="icontekst">' . $row['email'] . '</p><br/>';
        echo '<i class="fas fa-phone"></i><p  class="icontekst">' . $row['telefoonnummer'] . '</p><br/>';
        echo '<i class="fab fa-wordpress-simple"></i><p class="icontekst">' . $row['website'] . '</p><br/>';

        // twitter ROW deze is niet verplicht
        if (!empty($row['twitter'])) {
            echo '<i class="fab fa-twitter"></i><p class="icontekst">' . $row['twitter'] . '</p><br/>';
        } else {
            echo '';
        }

        // linkedIN ROW deze is niet verplicht
        if (!empty($row['linkedin'])) {
            echo '<i class="fab fa-linkedin-in"></i><p class="icontekst">' . $row['linkedin'] . '</p><br/>';
        } else {
            echo '';
        }


        echo '</div>';

// dit is de functie die bepaald welke image wordt afgebeeld
        if ($row['logo'] == 0) {
            echo '<img class="logoformaat" src="img/BB_logo_2017.jpg"><br/>';
        } else if ($row['logo'] == 1) {
            echo '<img class="ui" src="img/Capture.JPG"><br/>';
        } else if ($row['logo'] == 2) {
            echo '<img class="dca" src="img/DCA-MULTIMEDIA-logo-2016-CMYK.png"><br/>';
        } else if ($row['logo'] == 3) {
            echo '<img class="dca" src="img/ICT-logo-2017-CMYK.png"><br/>';
        } else if ($row['logo'] == 4) {
            echo '<img class="dca2015" src="img/DCAGROEP-logo-2015-CMYK.jpg"><br/>';
        } else if ($row['logo'] == 5) {
            echo '<img class="dca" src="img/DCA_logo_2015_CMYK.png"><br/>';
        } else if ($row['logo'] == 6) {
            echo '<img class="dca" src="img/DCA-Markets_logo_2018.png"><br/>';
        }
//dit is de functie die bepaald of er wel of geen social media iconen moeten komen te staan
        if ($row['socialmedia'] == 'yes'){
            echo '<div class="socialicons">';
            echo '<i class="fab fa-facebook-f"></i>';
            echo '<i class="fab fa-twitter"></i>';
            echo '<i class="fab fa-youtube"></i>';
            echo '</div><hr class="streepje2 " />';
        }elseif ($row['socialmedia'] == 'no'){
            echo '';
        }

        if (!empty($row['element1']) && $row['socialmedia']== 'yes'){
            echo '<p class="disclaimer">' . $row['element1'] . '</p>';
        }
        elseif (!empty($row['element1']) && ($row['socialmedia']== 'no')){
            echo '<hr class="streepje2" />';
            echo '<p class="disclaimer">' . $row['element1'] . '</p>';
        } elseif (empty($row['element1'])){
            echo '';
        }

        echo '</div>';
    }


    //DCA FOOTER
    else    if ($row['logo'] == 2 || 3 || 4 || 5 || 6) {
        echo '<div class="footerDCA">';
        echo '<p class="groet">Met vriendelijke groet,</p> <br/>';
        echo '<p class="naam">' . $row['naam'] . '</p>';
        echo '<p class="functie">' . $row['functie'] . '</p><hr class="streepje">';
        echo '<i class="far fa-envelope"></i><p  class="icontekst">' . $row['email'] . '</p><br/>';
        echo '<i class="fas fa-phone"></i><p  class="icontekst">' . $row['telefoonnummer'] . '</p><br/>';
        echo '<i class="fab fa-wordpress-simple"></i><p class="icontekst">' . $row['website'] . '</p><br/>';

        // twitter ROW deze is niet verplicht
        if (!empty($row['twitter'])) {
            echo '<i class="fab fa-twitter"></i><p class="icontekst">' . $row['twitter'] . '</p><br/>';
        } else {
            echo '';
        }

        // linkedIN ROW deze is niet verplicht
        if (!empty($row['linkedin'])) {
            echo '<i class="fab fa-linkedin-in"></i><p class="icontekst">' . $row['linkedin'] . '</p><br/>';
        } else {
            echo '';
        }

// dit is de functie die bepaald welke image wordt afgebeeld
        if ($row['logo'] == 0) {
            echo '<img class="logoformaat" src="img/boerenbusiness.jpg.JPG"><br/>';
        } else if ($row['logo'] == 1) {
            echo '<img class="ui" src="img/Capture.JPG"><br/>';
        } else if ($row['logo'] == 2) {
            echo '<img class="dca" src="img/DCA-MULTIMEDIA-logo-2016-CMYK.png"><br/>';
        } else if ($row['logo'] == 3) {
            echo '<img class="dca" src="img/ICT-logo-2017-CMYK.png"><br/>';
        } else if ($row['logo'] == 4) {
            echo '<img class="dca2015" src="img/DCAGROEP-logo-2015-CMYK.jpg"><br/>';
        } else if ($row['logo'] == 5) {
            echo '<img class="dca" src="img/DCA_logo_2015_CMYK.png"><br/>';
        } else if ($row['logo'] == 6) {
            echo '<img class="dca" src="img/DCA-Markets_logo_2018.png"><br/>';
        }
        //dit is de functie die bepaald of er wel of geen social media iconen moeten komen te staan
        if ($row['socialmedia'] == 'yes'){
            echo '<div class="socialicons">';
            echo '<i class="fab fa-facebook-f"></i>';
            echo '<i class="fab fa-twitter"></i>';
            echo '<i class="fab fa-youtube"></i>';
            echo '</div><hr class="streepje2 " />';
        }elseif ($row['socialmedia'] == 'no'){
            echo '';
        }

        if (!empty($row['element1']) && $row['socialmedia']== 'yes'){
            echo '<p class="disclaimer">' . $row['element1'] . '</p>';
        }
        elseif (!empty($row['element1']) && ($row['socialmedia']== 'no')){
            echo '<hr class="streepje2" />';
            echo '<p class="disclaimer">' . $row['element1'] . '</p>';
        } elseif (empty($row['element1'])){
            echo '';
        }

        if (!empty($row['element2'])){
            echo '<hr class="streepje2" />';
            echo '<p>'. $row['element2'] .'</p>';
        }elseif (empty($row['element2'])){
            echo '';
        }

        echo '</div>';

    }

}

mysqli_close($dbc)
?>
