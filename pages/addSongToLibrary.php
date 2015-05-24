<?php
require_once './config.php';
$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);
/*$lokalizacja = '/home/u355698726/public_html/fullMusic/';
$plik_tmp = $_FILES['plik']['tmp_name'];
$plik_nazwa = $_FILES['plik']['name'];
$plik_rozmiar = $_FILES['plik']['size'];
if(is_uploaded_file($plik_tmp)) {
    move_uploaded_file($plik_tmp, "fullMusic/$plik_nazwa");
    echo "Plik: <strong>$plik_nazwa</strong> o rozmiarze
    <strong>$plik_rozmiar bajtów</strong> został przesłany na serwer!";
}*/

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
    print_r($_FILES['plik']['tmp_name']);
    $max_rozmiar = 90240000;
    if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
        if ($_FILES['plik']['size'] > $max_rozmiar) {
            echo 'B³¹d! Plik jest za du¿y!';
        } else {
            echo 'Odebrano plik. Pocz¹tkowa nazwa: <a href="http://yonji.m4ud.jrk.ovh/'.$_FILES['plik']['name'].'>'.$_FILES['plik']['name'].'</a>';
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
}
?>

<form action="http://kardan.wc.lt/plik2.php" method="POST" ENCTYPE="multipart/form-data" >
    <input type="file" name="plik"/><br/>
    Autor: <input type="text" name="author"/><br>
    Tytuł: <input type="text" name="name"/><br>
    Album: <input type="text" name="album"/><br>
    Cena: <input type="text" name="prize"/><br>
    Kategoria:<select name="kategoria" id="asd">
        <option value="4">Disco Polo</option>
        <option value="3">Hip-Hop</option>
        <option value="6">Metal</option>
        <option value="5">POP</option>
        <option value="7">Punk Rock</option>
        <option value="8">Techno</option>
    </select><br>
    <input type="submit" name="submit" value="wyślij" />
</form>
<?