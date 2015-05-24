<?php
require_once './config.php';
if(isset($_COOKIE['koszyk']))
{
    $checkoutSongs = json_decode($_COOKIE['koszyk'],true);
    $suma = 0;
}
else
{
    header("location: /index.php?page=main");
}

?>
<table>
    <tr>
        <td>SongId</td>
        <td>SongTitle</td>
        <td>Prize</td>
    </tr>
    <?php
        foreach($checkoutSongs as $s)
        {
            $suma = $suma + $s['songPrize'];
            echo '<tr>
                    <td>'.$s['songId'].'</td><td>'.$s['songName'].'</td><td>'.$s['songPrize'].'zł</td>
                  </tr>';
        }
    ?>
</table>
<hr>

<?php
echo 'Do zapłaty    '.$suma.'zł';
?>
<form action="" method="post">
    <input type="submit" id="sub" name="sub" value="Zapłać"/>
</form>


<?php

if(isset($_POST['sub']))
{
    $userMoney = getUserMoney($_SESSION['userId']);
    if($userMoney<$suma)
    {
        echo '<p style="color: red">Nie masz wystarczająco hasju</p>';
    }
    else
    {
        $userMoney = $userMoney - $suma;
        updateUserMoney($_SESSION['userId'],$userMoney);
        foreach($checkoutSongs as $s)
        {
            addBuyedSongToUserAccount($_SESSION['userId'],$s['songId']);
        }
        setcookie("koszyk","",time()-1);
    }


}