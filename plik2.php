<?php
require_once 'config.php';
$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);

$author = $_POST['author'];
$name =  $_POST['name'];
$album = $_POST['album'];
$prize = $_POST['prize'];
$kat = $_POST['kategoria'];



$max_rozmiar = 90240000;
if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
    if ($_FILES['plik']['size'] > $max_rozmiar) {
        echo 'B³¹d! Plik jest za du¿y!';
    } else {
        if(!empty($author) && !empty($name) && !empty($album) && !empty($prize))
        {
            $nam = $_FILES['plik']['name'];
            $short = 'http://kardan.wc.lt/fullMusic/'.$nam;

            $query = "INSERT INTO Songs( name, album ,prize,author,shortUrl,longUrl) VALUES ('".$name."','".$album."','".$prize."','".$author."','".$short."','".$short."')";
            $data = mysqli_query($dbc, $query);
            $a= mysqli_insert_id($dbc);
            $query = "INSERT INTO Song_Category ( songId, categoryId) VALUES ('".$a."','".$kat."')";
            $data = mysqli_query($dbc, $query);
            mysqli_close($dbc);
        }
        echo '<br/>';
        if (isset($_FILES['plik']['type'])) {
            echo 'Typ: '.$_FILES['plik']['type'].'<br/>';
        }
        move_uploaded_file($_FILES['plik']['tmp_name'],
            '/home/u355698726/public_html/fullMusic/'.$_FILES['plik']['name']);
    }
} else {
    echo 'B³¹d przy przesy³aniu danych!';
}
header('Location:http://kardan.wc.lt/index.php?page=addSongToLibrary');
?> 