<?php
include('./config.php');
$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if(isset($_POST['submit']))
    {
     
        $username = mysqli_real_escape_string($dbc,  trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc,  trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc,  trim($_POST['password2']));
        $email =  mysqli_real_escape_string($dbc,  trim($_POST['email']));
        
        if(!empty($username)&& !empty($email) && !empty($password1) && !empty($password2) && ($password2 == $password1))
        {
            $query = "SELECT * FROM users WHERE username = '$username'";
           
            $data = mysqli_query($dbc, $query);
           
            if(mysqli_num_rows($data) == 0)
            {
              
                $query = "INSERT INTO users( username, email ,password,role,srodki) VALUES ('$username','$email',SHA('$password1'),'user',10)";
                echo $query;
                $data = mysqli_query($dbc, $query);
                echo '<p> Tworzenie konta zakończone poprawnie, Teraz się zaloguj <a href="../index.php?page=LogIn">Zaloguj</a></p>';
                mysqli_close($dbc); 
                exit();
            }
            else{
                echo "Błąd logowania";
                $username ="";
            }             
        }
    }
?>


<form method="post" action='/pages/Register.php' class="form-sign_in_up" id="register">
          <h2>Zarejestruj</h2>
          <input type="text" id="username" name="username" placeholder="Username" class="form-input"  /><br>

          <div class="error"></div>
          <input type="email" id="email" name="email" placeholder="Email" class="form-input"/><br>
          <div class="error"></div>
          <input type="password" id="password1" name="password1" placeholder="Hasło" class="form-input"/><br>
          <div class="error"></div>
          <input type="password" id="password2" name="password2" placeholder="Powtórz Hasło" class="form-input"/><br>
          <div class="error"></div>
          <input type="submit" class="przycisk" value="Zarejestruj" name="submit"/>

</form>
