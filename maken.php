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
        background-color: rgba(255, 255, 255, 0.62);

    }

    *{
        box-sizing: border-box;
    }

    i{
        margin-top: 10px;
        color: rgba(169, 169, 169, 0.44);
    }

    body{
        margin: 0;
        background-image: linear-gradient(180deg, #2af598 0%, #009efd 100%);
        height: 100%;
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
if(!empty($footer)) $query = "SELECT * FROM dca_werknemers d INNER JOIN brands b ON d.brand = b.id WHERE d.naam = '$footer'";
else $query = "SELECT * FROM dca_werknemers d INNER JOIN brands b ON d.brand = b.id";
$data = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($data)) {


    echo '<div class="footer_wrapper" style="font-family: Arial; box-sizing: border-box; height: 550px; width: 350px;">';


    $url = "http://localhost/website/signature";




        echo '<span class="copy" onclick="javascript:copyFooter(\''.$row['id'].'\')"><i class="fas fa-clipboard"></i></span>';
        echo '<div id="'.$row['id'].'" class="'.$row["klasse"].'" style="padding: 30px;">';
        echo '<p>Met vriendelijke groet,</p> <br/>';
        echo '<span style="font-weight: bold; font-size: 17px;">' . $row['naam'] . '</span><br />';
        echo '<div style="color: '.$row[$row["logo"]]["color_primary"].'; font-style: italic;  font-size: 13px;">' . $row['functie'] . '</div><br />';

        if($row[  'logo'] == 1) echo '<div style="display: inline-block; border-left: solid 2px #aeaeae">';
        else if($row['logo'] > 1) echo '<hr style="width: 30px; margin-left: 0;">';

        echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $row['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$row['icon_height'].'; width: 33px; text-align: center;"><img src="'.$url .'/goede_icons/'. $row['icon_email'] .'" style="padding-top: 8px; "></div><p  class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['email'] . '</p><br/>';
        echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $row['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$row['icon_height'].'; width: 33px; text-align: center;"><img src="'.$url .'/goede_icons/'. $row['icon_telefoon'] .'" style="padding-top: 8px; "></div><p  class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['telefoonnummer'] . '</p><br/>';
        echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $row['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$row['icon_height'].'; width: 33px; text-align: center;"><img src="'.$url .'/goede_icons/'. $row['icon_website'].'" style="padding-top: 8px; "></div><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['website'] . '</p><br/>';

        // twitter ROW deze is niet verplicht
        if (!empty($row['twitter'])) {
            echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $row['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$row['icon_height'].'; width: 33px; text-align: center;"><img src="'.$url .'/goede_icons/'. $row['icon_twitter'] .'" style="padding-top: 8px; "></div><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['twitter'] . '</p><br/>';
        }

        // linkedIN ROW deze is niet verplicht
        if (!empty($row['linkedin'])) {
            echo '<div style="margin-top: 5px; margin-left: 5px; background-color:'. $row['color_icon'] .'; border-radius: 50%; display: inline-block; height: '.$row['icon_height'].'; width: 33px; text-align: center;"><img src="'.$url .'/goede_icons/'. $row['icon_linkedin'] .'" style="padding-top: 8px;"></div><p class="icontekst" style="display: inline-block; margin: 6px 0 0 10px;">' . $row['linkedin'] . '</p><br/>';
        }

        if($row['logo'] == 1) echo '</div>';


// dit is de functie die bepaald welke image wordt afgebeeld

     echo '<img style="margin-top: 15px;" src="uploads/'.$row['image'].'" /><br/>';

        //dit is de functie die bepaald of er wel of geen social media iconen moeten komen te staan
        if ($row['socialmedia'] == 'yes'){
            echo '<div class="socialicons" style="display: inline-block; margin-left: 172.8px; margin-top: 20px;">';
            echo '<img src="goede_icons/facebook_social.png" style="margin-left: 5px;">';
            echo '<img src="goede_icons/twitter_social.png" style="margin-left: 5px;">';
            echo '<img src="goede_icons/youtube_social.png" style="margin-left: 5px;">';
            echo '</div><hr class="streepje2" style="width: 230.4px; color: #e3e3e3; margin-left: 28.8px;" />';
        }

        if (!empty($row['element1']) && $row['socialmedia']== 'yes'){
            echo '<p style="color: '.$row['color_disc'].'; font-style: italic; padding-left: 30px;  padding-right: 30px; font-family: arial; width: 228px;">' . $row['element1'] . '</p>';
        }
        elseif (!empty($row['element1']) && ($row['socialmedia']== 'nee')){
            echo '<hr class="streepje2" style="width: 230.4px; color: #e3e3e3; margin-left: 28.8px; margin-top: 20px;" />';
            echo '<p class="disclaimer" style="color: '.$row['color_disc'].'; font-style: italic; padding-left: 30px; width: 228px;">' . $row['element1'] . '</p>';
        }

        echo '</div></div>';


}

mysqli_close($dbc)
?>
