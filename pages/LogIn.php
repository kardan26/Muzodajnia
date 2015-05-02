<?php
require_once './config.php';
$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);
session_start();

if(isset($_POST['submit']))
    { 
        $password = mysqli_real_escape_string($dbc,  trim($_POST['password']));
        $email =  mysqli_real_escape_string($dbc,  trim($_POST['email']));
        
        if(!empty($email) && !empty($password))
        {
            $query = "SELECT * FROM users WHERE email = '$email' and password=SHA('$password')";
           
            $data = mysqli_query($dbc, $query);
            
            if(mysqli_num_rows($data) == 1)
            {
                $user = mysqli_fetch_array($data);
                $_SESSION['username'] = $user['username'];
                header("location: /index.php?main");
            }
            else 
            {
                //echo "błąd";
                echo print_r($data);
            }
        }
    }
?>


<form method="post" action='../index.php?page=LogIn' class="form-sign_in_up" id="login">
          <h2>Zaloguj</h2>
          <input type="email" id="email" name="email" placeholder="Email" class="form-input"/><br>
          <input type="password" id="password" name="password" placeholder="Hasło" class="form-input"/><br>
          <input type="submit" value="Zaloguj" name="submit" class="przycisk "/>
</form>

