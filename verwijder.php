<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>confirm</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<?php
$id = $_GET['id'];

$dbname = "dca_signature";
$conn = mysqli_connect("localhost", "root", "", $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM brands WHERE id = $id LIMIT 1";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: index.php');
    exit;
} else {
    echo "Error deleting record";
}

?>