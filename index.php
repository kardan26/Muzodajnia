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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta charset="utf-8"/>
</head>
<body>
        <nav class="top-menu">
            <ul>
                <li><a href="index.php?page=main">Main</a></li>
                <?php
                    if(isset($_SESSION['username']))
                    {
                        echo '<li class="nav-right" >
                                  <a href="#">'.$_SESSION['username'].'<span class="caret"></span></a>
                                  <div>
                                    <ul>
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
            </ul>
        </div>
        <div id="body" >
            <?php
                include('pages/'.$page.'.php');
            ?>
        </div>

</body>
</html>
