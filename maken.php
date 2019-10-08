<link rel="stylesheet" href="test.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">



<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="footer">Jouw persoonlijke email signatures: </label>
    <input type="text" id="footer" name="footer" value="<?php if (!empty($footer)) echo $footer; ?>"/>
    <input type="submit" value="zoek" name="submit">
</form>
<style>
    span.copy{

        margin: 20px;
    }

    div.footer_wrapper  {
        border: solid 1px black;
        display: inline-block;
        margin-left: 10px;
    }

    *{
        box-sizing: border-box;
    }

</style>
<script>
    function copyFooter(containerid) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select().createTextRange();
            document.execCommand("copy");

        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().addRange(range);
            document.execCommand("copy");
            alert("Tekst gekopieerd");
        }
    }
</script>

<?php
error_reporting(0);
require_once ('connectvars.php');

$footer = isset($_POST['footer']) ? $_POST['footer'] : '';


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!empty($footer)) $query = "SELECT * FROM dca_werknemers WHERE naam = '$footer'";
else $query = "SELECT * FROM dca_werknemers";

$data = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($data))
{
//BOERENBUSINESS FOOTERS
    echo '<div class="footer_wrapper" style="font-family: Arial; box-sizing: border-box; height: 550px; width: 350px;">';

   $brandresolve = array(0 => array('klasse' => "footerboerenbusiness", 'logo' => 'img/boerenbusiness.jpg.JPG', 'color_disc' => '#', ),
                         1 => array('klasse' => "footeruienhandel", 'logo' => 'img/Capture.JPG', 'color_primary' => '#950057', 'color_disc' => '#aeaeae', ),
                         2 => array('klasse' => "footerDCA", 'logo' => 'img/DCA-MULTIMEDIA-logo-2016-CMYK.png', 'color_disc' => '#d6dee3',  ),
                         3 => array('klasse' => "footerDCA", 'logo' => 'img/ICT-logo-2017-CMYK.png', 'color_disc' => '#d6dee3',  ),
                         4 => array('klasse' => "footerDCA", 'logo' => 'img/DCAGROEP-logo-2015-CMYK.jpg', 'color_disc' => '#d6dee3',  ),
                         5 => array('klasse' => "footerDCA", 'logo' => 'img/DCA_logo_2015_CMYK.png', 'color_disc' => '#d6dee3',  ),
                         6 => array('klasse' => "footerDCA", 'logo' => 'img/DCA-Markets_logo_2018.png', 'color_disc' => '#d6dee3',  )
   );

        echo '<span class="copy" onclick="javascript:copyFooter(\''.$row['id'].'\')"><i class="fas fa-clipboard"></i></span>';
        echo '<div id="'.$row['id'].'" class="'.$brandresolve[$row["logo"]]["klasse"].'" style="padding: 30px;">';
        echo '<p>Met vriendelijke groet,</p> <br/>';
        echo '<span style="font-weight: bold;">' . $row['naam'] . '</span><br />';
        echo '<div style="color: '.$brandresolve[$row["logo"]]["color_primary"].'; font-style: italic;  font-size: 14px;">' . $row['functie'] . '</div><br />';

        if($row['logo'] == 1) echo '<div style="display: inline-block; border-left: solid 2px #aeaeae">';
        else if($row['logo'] > 1) echo '<hr style="width: 30px; margin-left: 0;">';

        echo '<i class="far fa-envelope"></i><p  class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['email'] . '</p><br/>';
        echo '<i class="fas fa-phone"></i><p  class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['telefoonnummer'] . '</p><br/>';
        echo '<i class="fab fa-wordpress-simple"></i><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['website'] . '</p><br/>';

        // twitter ROW deze is niet verplicht
        if (!empty($row['twitter'])) {
            echo '<i class="fab fa-twitter"></i><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['twitter'] . '</p><br/>';
        }

        // linkedIN ROW deze is niet verplicht
        if (!empty($row['linkedin'])) {
            echo '<i class="fab fa-linkedin-in"></i><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['linkedin'] . '</p><br/>';
        }

        if($row['logo'] == 1) echo '</div>';
        // Disclaimer 1

// dit is de functie die bepaald welke image wordt afgebeeld

     echo '<img src="'.$brandresolve[$row["logo"]]["logo"].'" /><br/>';

        //dit is de functie die bepaald of er wel of geen social media iconen moeten komen te staan
        if ($row['socialmedia'] == 'yes'){
            echo '<div class="socialicons">';
            echo '<i class="fab fa-facebook-f"></i>';
            echo '<i class="fab fa-twitter"></i>';
            echo '<i class="fab fa-youtube"></i>';
            echo '</div><hr class="streepje2" style="width: 80%; color: #e3e3e3; " />';
        }

        if (!empty($row['element1']) && $row['socialmedia']== 'yes'){
            echo '<p style="color: '.$brandresolve[$row['logo']]['color_disc'].'; font-style: italic; padding-left: 30px;  padding-right: 30px; font-family: arial;">' . $row['element1'] . '</p>';
        }
        elseif (!empty($row['element1']) && ($row['socialmedia']== 'no')){
            echo '<hr class="streepje2" style="width: 80%; color: #e3e3e3;" />';
            echo '<p class="disclaimer" style="color: '.$brandresolve[$row['logo']]['color_disc'].'; font-style: italic; padding: 30px; ">' . $row['element1'] . '</p>';
        }

        echo '</div></div>';


}

mysqli_close($dbc)
?>
