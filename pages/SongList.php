<?php
if(isset($_GET['category']) && $_GET['page']=='SongList')
{
    $category_id =  $_GET['category'];
    if(isset($_GET['col']))
    {
        $column = $_GET['col'];
    }
    if(isset($_GET['sort']))
        $sort = $_GET['sort'];

    $songs = findSongsByCategoryId($category_id,$column,$sort);
}
?>
<div id="listSongs">
    <table>
        <thead>
        <tr>
            <td><?php if($sort=='') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=author&sort=ASC">AUTOR</a>'; elseif($sort == 'ASC') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=author&sort=DESC">AUTOR</a>'; else echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=author&sort=ASC">AUTOR</a>' ?></td>
            <td><?php if($sort=='') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=name&sort=ASC">NAME</a>'; elseif($sort == 'ASC') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=name&sort=DESC">NAME</a>'; else echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=name&sort=ASC">NAME</a>' ?></td>
            <td><?php if($sort=='') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=album&sort=ASC">ALBUM</a>'; elseif($sort == 'ASC') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=album&sort=DESC">ALBUM</a>'; else echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=album&sort=ASC">ALBUM</a>' ?></td>
            <td><?php if($sort=='') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=prize&sort=ASC">CENA</a>'; elseif($sort == 'ASC') echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=prize&sort=DESC">CENA</a>'; else echo '<a href="/index.php?page=SongList&category='.$category_id.'&col=prize&sort=ASC">CENA</a>' ?></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($songs as $song)
        {
            echo  '<tr>
                        <td>'.$song['author'].'</td>
                        <td>'.$song['name'].'</td>
                        <td>'.$song['album'].'</td>
                        <td>'.$song['prize'].' zł</td>
                        <td><button class="play" id="'.$song["id"].'" onclick="playSong(\''.$song["shortUrl"].'\')" >&#9658;</button><button id="'.$song["id"].'" onclick="stopSong()" >&#9724;</button></td>
                        <td><form method="post" action="#">
                                <input type="hidden" value="'.$song['id'].'"/>
                                <input type="submit" value="Kup" class="btn-kup"/>
                            </form>
                        </td>

                   </tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<script type="application/javascript">
    var audio;
    function playSong(url)
    {

        audio = new Audio(url);
        audio.play();
    }
    function stopSong()
    {

        audio.pause();
        audio.currentTime = 0;
    }
</script>
<style>
.play{
    color: red;
}

</style>