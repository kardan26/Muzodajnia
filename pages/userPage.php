<?php
if(!empty($_SESSION['username']))
{
   $userSongs =  findUserSongs($_SESSION['userId']);
}
else{
    header("location: /index.php?main");
}
?>
<table>
    <tr>
        <td>ID</td><td>Autor</td><td>Tytuł</td>
    </tr>
    <?php
    $i =0;
    foreach($userSongs as $son)
    {
        $i++;
        echo '<tr><td>'.$i.'</td><td>'.$son['author'].'</td><td>'.$son['name'].'</td><td><a href="'.$son['longUrl'].'">download</a></td></tr>';
    }
    ?>
</table>