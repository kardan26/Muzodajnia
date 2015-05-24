<?php
session_start();
require_once('config.php');
require_once('sqlQueries.php');
$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page = 'main';
}
?>
<html>
<head>
    <link href="css/Site.css" type="text/css" rel="stylesheet"/>
    <meta charset="utf-8"/>
</head>
<body>
        <nav class="top-menu">
            <ul>
                <li><a href="index.php?page=main">Main</a></li>
                <?php
                    if(isset($_SESSION['username']))
                    {
                        echo '<li class="nav-right"><a href="#">Koszyk<span class="caret"></span></a>
                                <div style="padding: 7px; margin-left:-100px; width: 191px">
                                    <ul>';
                                        if(!empty($_COOKIE['koszyk']))
                                        {
                                            $tablica = json_decode($_COOKIE['koszyk'],true);
                                            foreach ($tablica as $s)
                                            {
                                                echo '<li><a href="#" style="height: 15px; padding-left: 2px">'.$s['songId'].'    '.$s['songName'].'</a> </li>';
                                            }
                                            echo '<li><a href="index.php?page=checkout" style="padding-left: 70px">Kup</a> ';

                                        }
                                        else{
                                            echo '<li>Dodaj coś do koszyka :)</li>';
                                        }

                        echo'       </ul>
                                </div>
                              </li>';
                        echo '<li class="nav-right" >
                                  <a href="#">'.$_SESSION['username'].'<span class="caret"></span></a>
                                  <div style="padding: 7px; margin-left:-100px; width: 191px">
                                    <ul>';
                        if(!empty($_SESSION['userRole']) && $_SESSION['userRole']=='admin')
                        {

                            echo '<li ><a href="index.php?page=addSongToLibrary ">Dodaj Piosenkę</a></li>';
                        }
                        echo'
                                        <li><a href="index.php?page=userPage">Zarządzaj</a></li>
                                        <li><a href="index.php?page=LogOut">Wyloguj</a></li>
                                    </ul>
                                  </div>';
                    }
                    else
                    {
                        echo '<li class="nav-right"><a href="index.php?page=Register">Zarejestruj</a></li>
                              <li class="nav-right"> <a href="index.php?page=LogIn">Zaloguj</a></li>';
                    }
                ?>
            </ul>
        </nav>
        <div class="left-menu">
            <ul>

                <?php
                    $categories = getMainCategories();
                    foreach($categories as $cat)
                    {
                        echo '<li><a href="index.php?page=SongList&category='.$cat['id'].'">'.$cat['categoryName'].'</a></li>';
                    }
                ?>
                <li>
                    <div id="zegar">
                        <div id="minuta"><img src="images/minuta.png" ></div>
                        <div id="godzina"><img src="images/godzina.png" ></div>
                        <div id="sekunda"><img src="images/sekunda.png" ></div>
                        <div id="tarcza">
                            <img src='images/tarcza2.png'>
                        </div>
                    </div>
        </div>
                </li>
            </ul>
        </div>
        <div id="body" >
            <?php
                include('pages/'.$page.'.php');
            ?>
        </div>

</body>
</html>

<script type="application/javascript">
    function Czas(){
        var data = new Date();
        var sekunda = data.getSeconds();
        var minuta = data.getMinutes();
        var godzina = data.getHours();

        var s = sekunda*6;
        var m = minuta*6;
        var Hm = minuta*0.5;
        if (godzina > 12) {
            h = (godzina - 12 )* 30;
        }
        else {
            h = godzina * 30;
        }

        var divS = document.getElementById("sekunda");
        divS.style.webkitTransform = "rotate("+ s +"deg)";
        divS.style.MozTransform = "rotate("+ s +"deg)";
        divS.style.OTransform = "rotate("+ s +"deg)";
        divS.style.msTransform = "rotate("+ s +"deg)";
        var divM = document.getElementById("minuta");
        divM.style.webkitTransform = "rotate("+ m +"deg)";
        divM.style.MozTransform = "rotate("+ m +"deg)";
        divM.style.OTransform = "rotate("+ m +"deg)";
        divM.style.msTransform = "rotate("+ m +"deg)";
        var divH = document.getElementById("godzina");
        divH.style.webkitTransform = "rotate("+ (h+Hm) +"deg)";
        divH.style.MozTransform = "rotate("+ (h+Hm) +"deg)";
        divH.style.OTransform = "rotate("+ (h+Hm) +"deg)";
        divH.style.msTransform = "rotate("+ (h+Hm) +"deg)";

        setTimeout(Czas, 1000);
    }
    window.onload = Czas;
</script>
