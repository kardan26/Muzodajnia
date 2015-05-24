<?php
require_once './config.php';
$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);
$lokalizacja = '../fullMusic/';
$plik_tmp = $_FILES['plik']['tmp_name'];
$plik_nazwa = $_FILES['plik']['name'];
$plik_rozmiar = $_FILES['plik']['size'];
if(is_uploaded_file($plik_tmp)) {
    move_uploaded_file($plik_tmp, "fullMusic/$plik_nazwa");
    echo "Plik: <strong>$plik_nazwa</strong> o rozmiarze
    <strong>$plik_rozmiar bajtów</strong> został przesłany na serwer!";
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