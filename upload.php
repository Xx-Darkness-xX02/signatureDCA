<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="font-family: Arial;">
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">selecteer bestand om te uploaden:</label>
    <input type="file" name="fileToUpload" id="fileToUpload"/><br/><br/>
    <label for="bedrijf">voer het naam in van het bedrijf:</label>
    <input type="text" name="bedrijf" id="bedrijf">
    <input type="submit" value="Upload Image" name="submit"/><br/>


    <div>

        <?php
        if (isset($_GET['id']) && isset($_GET['image']) && isset($_GET['bedrijf'])) {
            $id = $_GET['id'];
            $image = $_GET['image'];
            $bedrijf = $_GET['bedrijf'];
        }
        //verbinding met de database.
        $dbc = mysqli_connect("localhost", "root", "", "dca_signature");
        $query = "SELECT bedrijf FROM brands";
        $data = mysqli_query($dbc, $query);

        //while loop die alle row's laat zien.
        while ($row = mysqli_fetch_array($data)) {
            echo '<form action="verwijder.php">';
            echo '' . $row['bedrijf'] . '';
            echo '<input type="button" value="verwijderen" name="remove"><br />';
            echo '</form>';
        }

        if (isset($_POST['verwijderen'])) {
            $delete = "DELETE FROM brands WHERE id = $id LIMIT 1;";
            $verwijderen = mysqli_query($dbc, $delete);
            mysqli_close($dbc);
            echo 'het bedrijf is succesvol verwijderd';
        } else {
            echo 'er gaat hier iets mis.';
        }

        //verbinding met database verbroken.
        mysqli_close($dbc);
        ?>
    </div>
</form>
</body>
</html>

<?php
include_once 'connectvars.php';
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// check of het plaatje wel een plaatje is.
if (isset($_POST["submit"])) {
    $bedrijf = $_POST['bedrijf'];
    $naam = $_FILES['fileToUpload']['name'];
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
        $query = "INSERT INTO images (image, bedrijf) VALUES ('$naam', '$bedrijf')";
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
?>

