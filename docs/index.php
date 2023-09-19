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
            $safeId = htmlspecialchars($video['id']);
            $safeTitle = htmlspecialchars($video['title']);
            $safeUser = htmlspecialchars($video['username']);

            echo "
                <div class='vmeta'>
                    <a href='/videos/$safeId'>
                        <img class='thumb' src='/data/thumb/$safeId.png'>
                        <div><b>$safeTitle</b></div>
                        <div><a href='/users/$safeUser'>$safeUser</a></div>
                    </a>
                </div>
            ";
        }
    ?>
</div>