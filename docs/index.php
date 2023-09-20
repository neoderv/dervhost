<?php 
    if ($_GET['data']) {
        setcookie('token', $_GET['data'], strtotime( '+30 days' )  ); 
    }
?>
<h1>New Content</h1>
<div class='thumblist'>
    <?php
        $stmt = $pdo->prepare("SELECT * FROM video ORDER BY uploaded DESC LIMIT 0, 10");

        $stmt->execute([
        ]);

        $videos = $stmt->fetchAll();

        foreach ($videos as $video) {
            $video = parseVideo($video);

            $safeId = $video['id'];
            $safeTitle = $video['title'];
            $safeUser = $video['username'];
            $safeDate = $video['uploaded'];

            echo "
                <div class='vmeta'>
                    <a href='/videos/$safeId'>
                        <img class='thumb' src='/data/thumb/$safeId.png'>
                        <div class='big'><b>$safeTitle</b></div>
                    </a>
                    <div><a href='/users/$safeUser'>$safeUser</a></div>
                    <div>$safeDate</div>
                </div>
            ";
        }
    ?>
</div>