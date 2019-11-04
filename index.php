<?php
require_once('connectvars.php');
?>

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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,500&display=swap" rel="stylesheet">
</head>
<body>

<?php
if (isset($_POST['submit'])) {
    $dbc = mysqli_connect('localhost', 'root', '', 'dca_signature');
    $naam = mysqli_real_escape_string($dbc, trim($_POST['naam']));
    $functie = mysqli_real_escape_string($dbc, trim($_POST['functie']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $telefoonnummer = mysqli_real_escape_string($dbc, trim($_POST['telefoonnummer']));
    $website = mysqli_real_escape_string($dbc, trim($_POST['website']));
    $twitter = mysqli_real_escape_string($dbc, trim($_POST['twitter']));
    $linkedin = mysqli_real_escape_string($dbc, trim($_POST['linkedin']));
    $logo = intval($_POST['logo']);
    $social = $_POST['social'];
    $element1 = mysqli_real_escape_string($dbc, trim($_POST['element1']));

    if (!empty($naam) && !empty($functie) && !empty($email)) {

        $query = "INSERT INTO dca_werknemers (naam, functie, email, telefoonnummer, website, twitter, linkedin, brand, socialmedia, element1)  VALUES ('$naam', '$functie', '$email', '$telefoonnummer', '$website', '$twitter', '$linkedin', '$logo', '$social', '$element1')";

        mysqli_query($dbc, $query);

        echo '<p class="approved">dankjewel ' . $naam . ' voor het invoeren van jou persoonlijke email signature</p> ';

        mysqli_close($dbc);
    } else {
        echo '<p class="error">je hebt iets verkeerds gedaan. check of je alle verplichte velden hebt ingevuld!</p>';
    }

}
?>

<form class="formulier" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768"/>
    <label style="font-weight: normal">vul alle verplichte velden in. <label class="niet_verplicht">*</label> : zijn
        velden die niet verplicht zijn</label><br/>
    <hr/>
    <label for="naam">naam:</label>
    <input type="text" id="naam" name="naam" value="<?php if (!empty($naam)) echo $naam; ?>"/><br/>
    <label for="functie">functie:</label>
    <input type="text" id="functie" name="functie" value="<?php if (!empty($functie)) echo $functie; ?>"/><br/>
    <label for="email">email:</label>
    <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>"/><br/>
    <label for="telefoonnummer">telefoonnummer:</label>
    <input type="text" id="telefoonnummer" name="telefoonnummer"
           value="<?php if (!empty($telefoonnummer)) echo $telefoonnummer; ?>"/><br/>
    <label for="website">website:</label>
    <input type="text" id="website" name="website" value="<?php if (!empty($website)) echo $website; ?>"/><br/>
    <label for="twitter">twitter:</label>
    <input type="text" id="twitter" name="twitter" value="<?php if (!empty($twitter)) echo $twitter; ?>"/>
    <label class="niet_verplicht">*</label><br/>
    <label for="linkedin">linkedIN:</label>
    <input type="text" id="linkedin" name="linkedin" value="<?php if (!empty($linkedin)) echo $linkedin; ?>"/>
    <label class="niet_verplicht">*</label><br/>
    <label for="logo">kies een logo:</label><br/>
    <?php
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT * FROM brands";
    $result = mysqli_query($dbc, $query);



    while ($row = mysqli_fetch_array($result)) {
        echo '<input type="checkbox" id="logo" name="logo" value="' . $row['id']. '">' . $row['bedrijf'] . '<br/><br/>';
    }


    mysqli_close($dbc)
    ?>
    <label for="social">social media iconen: </label>
    <input type="radio" id="social" name="social" value="yes">ja
    <input type="radio" id="social" name="social" value="nee" checked>nee<br/>
    <label for="element1">disclaimer:</label>
    <input type="text" id="element1" name="element1" value="<?php if (!empty($element1)) echo $element1; ?>"/>
    <label class="niet_verplicht">*</label> <br/><br />
    <input class="submit" type="submit" value="add" name="submit">
    <hr/>
    <a href="maken.php">resultaat</a>
    <a href="upload.php">admin</a>
</form>

</body>
</html>
