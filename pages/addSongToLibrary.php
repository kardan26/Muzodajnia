<?php
    $lokalizacja = './httpd/fullMusic/';
    if(is_uploaded_file($_FILES['nazwa_pliku']['tmp_name']))
    {
        if(!move_uploaded_file($_FILES['nazwa_pliku']['tmp_name'], $lokalizacja))
        {
            echo 'problem: Nie udało się skopiować pliku do katalogu.';
            return false;
        }
    }

?>

<form enctype="multipart/form-data" action="../index.php?page=addSongToLibrary"
      method="post" >
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
    <input type="file" name="nazwa_pliku" />
    <input type="submit" value="wyślij" />
</form>