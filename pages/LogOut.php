<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 4/9/2015
 * Time: 1:39 AM
 */
session_start();
unset($_SESSION["username"]);


header("Location: index.php?page=main");

?>