<?php
require_once 'config.php';

$dbc = mysqli_connect($db_host, $db_username, $db_password, $db_name);

function getMainCategories()
{
    global $dbc;

    $query = 'SELECT id,categoryName FROM Category WHERE parrentId=0 ORDER BY categoryName ASC';
    $data = mysqli_query($dbc,$query);
    $categories = array();
    while($row = $data->fetch_array() )
    {
        array_push($categories,array(
            'id' => $row['id'],
            'categoryName' => $row['categoryName']));
    }
    return $categories;


}

function findSongsByCategoryId($id,$col=null,$ascOrDesc='ASC')
{
    global $dbc;
    if($col==null)
    {
        $query = "SELECT s.id , s.name , s.album , s.prize , s.author, s.shortUrl, s.longUrl
                FROM Songs as s
          INNER JOIN Song_Category as sc
	              ON sc.songId=s.id
               WHERE sc.categoryId=$id";
    }
    else
    {

        $query = "SELECT s.id , s.name , s.album , s.prize , s.author, s.shortUrl, s.longUrl
                FROM Songs as s
          INNER JOIN Song_Category as sc
	              ON sc.songId=s.id
               WHERE sc.categoryId=$id
            ORDER BY s.$col $ascOrDesc
               ";

    }



    $data = mysqli_query($dbc,$query);
    $songs = array();
    while($row = $data->fetch_array() )
    {
        array_push($songs,array(
            'id' => $row['id'],
            'name' => $row['name'],
            'album' => $row['album'],
            'prize' => $row['prize'],
            'author' => $row['author'],
            'shortUrl' => $row['shortUrl'],
            'longUrl' => $row['longUrl'])
        );
    }
    return $songs;
}

function findUserByEmailAndPassword($email,$password)
{
    global $dbc;
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

function findUserSongs($userId)
{
    global $dbc;

    $query = "SELECT s.id , s.name , s.album , s.prize , s.author, s.shortUrl, s.longUrl
                FROM Songs as s
          INNER JOIN User_Song as sc
	              ON sc.song_id=s.id
               WHERE sc.user_id=$userId";

    $data = mysqli_query($dbc, $query);
    $table = array();
    while($row = mysqli_fetch_assoc($data))
    {
        array_push($table,$row);
    }
    return $table;

}

function getUserMoney($userId)
{
    global $dbc;

    $query = "SELECT u.srodki
               FROM users as u
               WHERE u.id=$userId";
    $data = mysqli_query($dbc, $query);
    if(mysqli_num_rows($data)==1)
    {
        $a = mysqli_fetch_row($data);
        return $a[0];
    }
    else
        return "blad getUserMoney Function";

}

function updateUserMoney($userId,$userMoney)
{
    global $dbc;

    $query = "UPDATE users
              SET srodki =$userMoney
              WHERE users.id=$userId";
    $data = mysqli_query($dbc,$query);

    return $data;
}

function addBuyedSongToUserAccount($userId,$songId)
{
    global $dbc;
    $query = "INSERT INTO  User_Song(user_id,song_id) VALUES ($userId,$songId)";

    $data = mysqli_query($dbc,$query);


}



mysqli_close($dbc);
?>
