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
$query = "SELECT * FROM dca_werknemers WHERE naam = '$footer'";

$data = mysqli_query($dbc, $query);




mysqli_close($dbc)
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="footer">Jou persoonlijke email signatures: </label>
    <input type="text" id="footer" name="footer" value="<?php if (!empty($footer)) echo $footer; ?>"/>
    <input type="submit" value="zoek" name="submit">
</form>
</body>
</html>