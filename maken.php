<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
      integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="background-color: lightgrey; margin: 5px; height: 50px; padding: 13px;">
    <label for="footer" style="font-weight: bold; font-family: Arial;">Jouw persoonlijke email signatures: </label>
    <input type="text" id="footer" name="footer" value="<?php if (!empty($footer)) echo $footer; ?>"/>
    <input type="submit" value="zoek" name="submit" style="background-color: #ffed00; border-radius: 5px; border: 0; height: 22px;">
</form>
<hr />
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

    i{
        margin-top: 10px;
        color: darkgrey;
    }

    body{
        margin: 0;
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

   $brandresolve = array(0 => array('klasse' => "footerboerenbusiness", 'logo' => 'img/boerenbusiness.jpg.JPG', 'color_disc' => '#aeaeae', 'icon_email' => 'goede_icons/email_ui_bb.png', 'icon_telefoon' => 'goede_icons/telefoon_ui_bb.png', 'icon_website' => 'goede_icons/internet_ui_bb.png', 'icon_twitter' => 'goede_icons/twitter_ui_bb.png', 'icon_linkedin' => 'goede_icons/linkedIN_ui_bb.png', 'color_icon' => '#3da0d5', 'icon_height' => '33px', 'icon_width' => '33px' ),
                         1 => array('klasse' => "footeruienhandel", 'logo' => 'img/Capture.JPG', 'color_primary' => '#950057', 'color_disc' => '#aeaeae', 'icon_email' => 'goede_icons/email_ui_bb.png', 'icon_telefoon' => 'goede_icons/telefoon_ui_bb.png', 'icon_website' => 'goede_icons/internet_ui_bb.png', 'icon_twitter' => 'goede_icons/twitter_ui_bb.png', 'icon_linkedin' => 'goede_icons/linkedIN_ui_bb.png', 'color_icon' => '#950057', 'icon_height' => '33px', 'icon_width' => '33px'),
                         2 => array('klasse' => "footerDCA", 'logo' => 'img/DCA-MULTIMEDIA-logo-2016-CMYK.png', 'color_disc' => '#d6dee3', 'icon_email' => 'goede_icons/email_dca.png', 'icon_telefoon' => 'goede_icons/telefoon_dca.png', 'icon_website' => 'goede_icons/internet_dca.png', 'icon_twitter' => 'goede_icons/twitter_dca.png', 'icon_linkedin' => 'goede_icons/linkedIN_dca.png' ),
                         3 => array('klasse' => "footerDCA", 'logo' => 'img/ICT-logo-2017-CMYK.png', 'color_disc' => '#d6dee3', 'icon_email' => 'goede_icons/email_dca.png', 'icon_telefoon' => 'goede_icons/telefoon_dca.png', 'icon_website' => 'goede_icons/internet_dca.png', 'icon_twitter' => 'goede_icons/twitter_dca.png', 'icon_linkedin' => 'goede_icons/linkedIN_dca.png' ),
                         4 => array('klasse' => "footerDCA", 'logo' => 'img/DCAGROEP-logo-2015-CMYK.jpg', 'color_disc' => '#d6dee3', 'icon_email' => 'goede_icons/email_dca.png', 'icon_telefoon' => 'goede_icons/telefoon_dca.png', 'icon_website' => 'goede_icons/internet_dca.png', 'icon_twitter' => 'goede_icons/twitter_dca.png', 'icon_linkedin' => 'goede_icons/linkedIN_dca.png' ),
                         5 => array('klasse' => "footerDCA", 'logo' => 'img/DCA_logo_2015_CMYK.png', 'color_disc' => '#d6dee3', 'icon_email' => 'goede_icons/email_dca.png', 'icon_telefoon' => 'goede_icons/telefoon_dca.png', 'icon_website' => 'goede_icons/internet_dca.png', 'icon_twitter' => 'goede_icons/twitter_dca.png', 'icon_linkedin' => 'goede_icons/linkedIN_dca.png' ),
                         6 => array('klasse' => "footerDCA", 'logo' => 'img/DCA-Markets_logo_2018.png', 'color_disc' => '#d6dee3', 'icon_email' => 'goede_icons/email_dca.png', 'icon_telefoon' => 'goede_icons/telefoon_dca.png', 'icon_website' => 'goede_icons/internet_dca.png', 'icon_twitter' => 'goede_icons/twitter_dca.png', 'icon_linkedin' => 'goede_icons/linkedIN_dca.png' )
   );


        echo '<span class="copy" onclick="javascript:copyFooter(\''.$row['id'].'\')"><i class="fas fa-clipboard"></i></span>';
        echo '<div id="'.$row['id'].'" class="'.$brandresolve[$row["logo"]]["klasse"].'" style="padding: 30px;">';
        echo '<p>Met vriendelijke groet,</p> <br/>';
        echo '<span style="font-weight: bold;">' . $row['naam'] . '</span><br />';
        echo '<div style="color: '.$brandresolve[$row["logo"]]["color_primary"].'; font-style: italic;  font-size: 14px;">' . $row['functie'] . '</div><br />';

        if($row['logo'] == 1) echo '<div style="display: inline-block; border-left: solid 2px #aeaeae">';
        else if($row['logo'] > 1) echo '<hr style="width: 30px; margin-left: 0;">';

        echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $brandresolve[$row['logo']]['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$brandresolve[$row['logo']]['icon_height'].'; width: 33px; text-align: center;"><img src="'. $brandresolve[$row['logo']]['icon_email'] .'" style="padding-top: 8px; "></div><p  class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['email'] . '</p><br/>';
        echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $brandresolve[$row['logo']]['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$brandresolve[$row['logo']]['icon_height'].'; width: 33px; text-align: center;"><img src="'. $brandresolve[$row['logo']]['icon_telefoon'] .'" style="padding-top: 8px; "></div><p  class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['telefoonnummer'] . '</p><br/>';
        echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $brandresolve[$row['logo']]['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$brandresolve[$row['logo']]['icon_height'].'; width: 33px; text-align: center;"><img src="'. $brandresolve[$row['logo']]['icon_website'].'" style="padding-top: 8px; "></div><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['website'] . '</p><br/>';

        // twitter ROW deze is niet verplicht
        if (!empty($row['twitter'])) {
            echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $brandresolve[$row['logo']]['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$brandresolve[$row['logo']]['icon_height'].'; width: 33px; text-align: center;"><img src="'. $brandresolve[$row['logo']]['icon_twitter'] .'" style="padding-top: 8px; "></div><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['twitter'] . '</p><br/>';
        }

        // linkedIN ROW deze is niet verplicht
        if (!empty($row['linkedin'])) {
            echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $brandresolve[$row['logo']]['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$brandresolve[$row['logo']]['icon_height'].'; width: 33px; text-align: center;"><img src="'. $brandresolve[$row['logo']]['icon_linkedin'] .'" style="padding-top: 8px margin-top: 5px; margin-left: 5px;"></div><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['linkedin'] . '</p><br/>';
        }

        if($row['logo'] == 1) echo '</div>';
        // Disclaimer 1

// dit is de functie die bepaald welke image wordt afgebeeld

     echo '<img style="margin-top: 10px;" src="'.$brandresolve[$row["logo"]]["logo"].'" /><br/>';

        //dit is de functie die bepaald of er wel of geen social media iconen moeten komen te staan
        if ($row['socialmedia'] == 'yes'){
            echo '<div class="socialicons" style="display: inline-block; margin-left: 172.8px; margin-top: 20px;">';
            echo '<img src="goede_icons/facebook_social.png" style="margin-left: 5px;">';
            echo '<img src="goede_icons/twitter_social.png" style="margin-left: 5px;">';
            echo '<img src="goede_icons/youtube_social.png" style="margin-left: 5px;">';
            echo '</div><hr class="streepje2" style="width: 230.4px; color: #e3e3e3; margin-left: 28.8px;" />';
        }

        if (!empty($row['element1']) && $row['socialmedia']== 'yes'){
            echo '<p style="color: '.$brandresolve[$row['logo']]['color_disc'].'; font-style: italic; padding-left: 30px;  padding-right: 30px; font-family: arial; width: 228px;">' . $row['element1'] . '</p>';
        }
        elseif (!empty($row['element1']) && ($row['socialmedia']== 'no')){
            echo '<hr class="streepje2" style="width: 230.4px; color: #e3e3e3; margin-left: 28.8px;" />';
            echo '<p class="disclaimer" style="color: '.$brandresolve[$row['logo']]['color_disc'].'; font-style: italic; padding-left: 30px; width: 228px;">' . $row['element1'] . '</p>';
        }

        echo '</div></div>';


}

mysqli_close($dbc)
?>
