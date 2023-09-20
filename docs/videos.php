<?php 
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM video WHERE id = :id");

    $stmt->execute([
        "id" => $id
    ]);

    $video = $stmt->fetch();

    $video = parseVideo($video);

    $safeId = $video['id'];
    $safeTitle = $video['title'];
    $safeUser = $video['username'];
    $safeDate = $video['uploaded'];
    $safeDesc = $video['info'];

    echo "
        <video src='/data/videos/$safeId.mp4' controls></video>
        <h1>$safeTitle</h1>
        <p>Uploaded by <a href='/users/$safeUser'>$safeUser</a> on $safeDate</p>
        <pre class='area'>$safeDesc</pre>
    ";
?>