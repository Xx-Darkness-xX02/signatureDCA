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
</head>
<body>

<?php
if (isset($_POST['submit'])) {

    $naam = $_POST['naam'];
    $functie = $_POST['functie'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $website = $_POST['website'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $logo = $_POST['logo'];
    $social = $_POST['social'];
    $element1 = $_POST['element1'];
    $element2 = $_POST['element2'];
    $footer = $_POST['footer'];

    if (!empty($naam) && !empty($functie) && !empty($email)) {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "INSERT INTO dca_werknemers (naam, functie, email, telefoonnummer, website, twitter, linkedin, logo, socialmedia, element1, element2)  VALUES ('$naam', '$functie', '$email', '$telefoonnummer', '$website', '$twitter', '$linkedin', '$logo', '$social', '$element1', '$element2' )";

        mysqli_query($dbc, $query);

        echo '<p class="approved">dankjewel ' . $naam . ' voor het invoeren van jou persoonlijke email signature</p> ';

        mysqli_close($dbc);
    } else {
        echo '<p class="error">je hebt iets verkeerds gedaan. check of je alle verplichte velden hebt ingevuld!</p>';
    }

}
?>
<hr/>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
    <input type="text" id="twitter" name="twitter" value="<?php if (!empty($twitter)) echo $twitter; ?>"/> *niet
    verplicht<br/>
    <label for="linkedin">linkedIN:</label>
    <input type="text" id="linkedin" name="linkedin" value="<?php if (!empty($linkedin)) echo $linkedin; ?>"/>*niet
    verplicht<br/>
    <label for="logo">kies een logo:</label><br/>
    1<input type="checkbox" id="logo" name="logo" value="0" <br/><br/>
    2<input type="checkbox" id="logo" name="logo" value="1" <br/><br/>
    3<input type="checkbox" id="logo" name="logo" value="2" <br/><br/>
    4<input type="checkbox" id="logo" name="logo" value="3" <br/><br/>
    5<input type="checkbox" id="logo" name="logo" value="4" <br/><br/>
    6<input type="checkbox" id="logo" name="logo" value="5" <br/><br/>
    7<input type="checkbox" id="logo" name="logo" value="6" <br/><br/>
    <label for="social">social media iconen: </label>
    <input type="radio" id="social" name="social" value="yes">ja
    <input type="radio" id="social" name="social" value="nee" checked>nee<br/>
    <label for="element1">disclaimer:</label>
    <input type="text" id="element1" name="element1" value="<?php if (!empty($element1)) echo $element1; ?>"/> *niet
    verplicht <br/>
    <label for="element2">andere info:</label>
    <input type="text" id="element2" name="element2" value="<?php if (!empty($element2)) echo $element2; ?>"/> *niet
    verplicht <br/>
    <input type="submit" value="add" name="submit">
    <hr/>
</form>
</body>
</html>
