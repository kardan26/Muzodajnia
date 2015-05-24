<?php
if(!empty($_SESSION['username']))
{
    print_r(findUserSongs($_SESSION['userId']));
}
else{
    header("location: /index.php?main");
}

