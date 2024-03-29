<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,500&display=swap" rel="stylesheet">
</head>
<body style="font-family: Arial;">

<form class="aanmaken" action="upload.php" method="post" enctype="multipart/form-data">
    <h2>bedrijf uploaden</h2>
    <label for="fileToUpload">selecteer bestand om te uploaden:</label>
    <input type="file" name="fileToUpload" id="fileToUpload"/><br/><br/>
    <label for="bedrijf">voer het naam in van het bedrijf:</label>
    <input type="text" name="bedrijf" id="bedrijf"><br /><br /><br/>
    <label for=""><strong>selecteer een template</strong></label>
    <input type="checkbox" name="boerenbusiness" id="checkbox"><div style="height: 33px; background-color: #4facfe; display: inline-block; border-radius: 50%; width: 33px; "><img src="goede_icons/email_ui_bb.png" alt="#" style="padding-top: 8px; padding-left:8px;"></div>
    <input type="checkbox" name="dca" id="checkbox"><div style="display: inline-block"><img src="goede_icons/email_dca.png" alt=""></div>
    <input type="color" name="color" id="color" ><br>
    <small style="font-style: italic">je kan de kleur alleen toevoegen als je voor de linker optie gaat</small><br />
    <input type="submit" value="Upload Image" name="submit"/>
    <a href="index.php">home</a>
</form>

<div class="verwijderen">
    <?php
    //verbinding met de database.
    $dbc = mysqli_connect("localhost", "root", "", "dca_signature");
    $query = "SELECT * FROM brands";
    $data = mysqli_query($dbc, $query);

    echo '<form>';
    echo '<h2>bedrijf verwijderen</h2>';
    //while loop die alle row's laat zien.
    while ($row = mysqli_fetch_array($data)) {
        echo '<tr><td><strong>' . $row['bedrijf'] . '</strong></td>';
        echo '<td><a href="verwijder.php?id='.$row['id'].'">Remove</a></td></tr><br />';
    }
    echo '</form>';
    //verbinding met database verbroken.
    mysqli_close($dbc);
    ?>
</div>

</body>
</html>

<?php
include_once 'connectvars.php';
$target_dir = "uploads/";
if(isset($_FILES["fileToUpload"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// check of het plaatje wel een plaatje is.
    if (isset($_POST["submit"])) {
        $bedrijf = $_POST['bedrijf'];
        $naam = $_FILES['fileToUpload']['name'];
        $boerenbusiness = $_POST['boerenbusiness'];
        $dca = $_POST['dca'];
        $color = $_POST['color'];

        if (!isset($boerenbusiness) && !isset($dca)) {
            echo 'mislukt';
        }


        if (!empty($naam) && !empty($bedrijf)) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            $dbc = mysqli_connect("localhost", "root", "", "dca_signature");
            if (isset($boerenbusiness)) {
                $query = "INSERT INTO brands (image, bedrijf, color_primary, color_disc, icon_email, icon_telefoon, icon_website, icon_twitter, icon_linkedin, color_icon, icon_height ) VALUES ('$naam', '$bedrijf', '0', '#d6dee3', 'email_ui_bb.png', 'telefoon_ui_bb.png', 'internet_ui_bb.png', 'twitter_ui_bb.png', 'linkedIN_ui_bb.png', '$color', '33')";
            } elseif (isset($dca)) {
                $query = "INSERT INTO brands (image, bedrijf, color_primary, color_disc, icon_email, icon_telefoon, icon_website, icon_twitter, icon_linkedin, color_icon, icon_height ) VALUES ('$naam', '$bedrijf', '0', '#d6dee3', 'email_dca.png', 'telefoon_dca.png', 'internet_dca.png', 'twitter_dca.png', 'linkedIN_dca.png', '', '16')";
            }
            mysqli_query($dbc, $query);
            mysqli_close($dbc);

        }


// Check of het bestand al bestaat
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// check de grootte van het bestand
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// toegestane bestand types
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check of $uploadOk 0 is
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// als alles ok is, upload het bestand
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        if (!empty($naam) && empty($bedrijf)) {
            echo '<p class="error">Sorry, het uploaden is niet gelukt voer de naam van het bedrijf in.</p>';
        }

        if (empty($naam) && !empty($bedrijf)) {
            echo '<p class="error">Sorry, het uploaden is niet gelukt voer het bestand in.</p>';
        }
    }
}
?>

