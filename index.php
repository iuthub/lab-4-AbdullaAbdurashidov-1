<?php
function getPlaylist($name){
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Music Viewer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="viewer.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
    <div id="header">

        <h1>190M Music Playlist Viewer</h1>
        <h2>Search Through Your Playlists and Music</h2>
    </div>
    <div id="listarea">
        <a href="index.php">Go Back \t</a>
        <a href="/?bysize=1">By Size</a>
        <ul id="musiclist">
        <?php
        $playlist=$_REQUEST["list"];
        $musics=array();
        foreach(file("songs/$playlist") as $line){
            $musics[]=$line;
            $filepath=glob("songs\\$line");


            if(isset($filepath[0]))
                $size=filesize($filepath[0]);
            else
                $size=0;
            $byte="b";
            if($size>1000000) {
                $size = $size / 1000000;
                $byte="mb";
            }
            else if($size>1000) {
                $size = $size / 1000;
                $byte="kb";
            }
            $size=round($size,1);
        }
        for($i=0; $i<count($musics); $i++){
            echo "<li class=\"mp3item\"><a href=\"song\ $musics[$i]\" > $musics[$i]; </a> ($size $byte) </li>";
        }
        ?>
        </ul>
    </div>
    </body>
    </html>
    <?php
}
?>



<?php
function showList(){
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Music Viewer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="viewer.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
    <div id="header">
        <h1>190M Music Playlist Viewer</h1>
        <h2>Search Through Your Playlists and Music</h2>
    </div>
    <div id="listarea">
        <?php
        $musics=glob("songs\*.mp3");
        foreach($musics as $music){
            $musicName=basename($music);
            $size=filesize($music);
            $byte="b";
            if($size>1000000) {
                $size = $size / 1000000;
                $byte="mb";
            }
            else if($size>1000) {
                $size = $size / 1000;
                $byte="kb";
            }
            $size=round($size,1);
            echo "<li class=\"mp3item\"><a href=\"$music\" > $musicName; </a> ($size $byte)</li>";
        }
        ?>
        <ul id="musiclist">
            <?php
            $playlists=glob("songs\*.txt");
            foreach($playlists as $list){
                $listName=basename($list);
                echo "<li class=\"playlistitem\"><a href=\"/?list=$listName\"> $listName </a></li>";
            }
            ?>
        </ul>
    </div>
    </body>
    </html>
    <?php
}
if(isset($_REQUEST["list"])) {
    getPlaylist($_REQUEST["list"]);
}else {
    showList();
}
?>







