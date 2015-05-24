<?php
require_once './config.php';
$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    $lokalizacja = './httpd/fullMusic/';
    if(is_uploaded_file($_FILES['nazwa_pliku']['tmp_name']))
    {
        if(!move_uploaded_file($_FILES['nazwa_pliku']['tmp_name'], $lokalizacja))
        {
            echo 'problem: Nie udało się skopiować pliku do katalogu.';
            return false;
        }
    }

if(isset($_POST['submit']))
{
    $author = $_POST['author'];
    $name =  $_POST['name'];
    $album = $_POST['album'];
    $prize = $_POST['prize'];

    if(!empty($author) && !empty($name) && !empty($album) && !empty($prize))
    {
        $query = "INSERT INTO songs( name, album ,prize,author,shortUrl,longUrl) VALUES ('$name','$album','$prize'),'$author','http://kardan.wc.lt/shortMusic/'.$name.'mp3','http://kardan.wc.lt/fullMusic/'.$name.'mp3')";
        $data = mysqli_query($dbc, $query);
        mysqli_close($dbc);
    }
}
?>

<form enctype="multipart/form-data" action="../index.php?page=addSongToLibrary"
      method="post" >
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
    <input type="file" name="nazwa_pliku" /><br>
    Autor: <input type="text" name="author"/><br>
    Tytuł: <input type="text" name="name"/><br>
    Album: <input type="text" name="album"/><br>
    Cena: <input type="text" name="prize"/><br>
    <input type="submit" value="wyślij" />
</form>