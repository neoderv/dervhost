<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($username)) {
        $id = bin2hex(random_bytes(10));

        $outDir = "$tmpDir/" . $id;
    
        move_uploaded_file($_FILES['file']['tmp_name'], $outDir);
    
        $isValid = shell_exec("ffprobe -v error -show_entries stream=width,height -of default=noprint_wrappers=1 $outDir");
    
        $title = $_POST['title'];
        $desc = $_POST['description'];
    }

    if (isset($isValid) && strlen($title) < 64 && strlen($desc) < 1024) {
        shell_exec("ffmpeg -i $outDir ../data/videos/$id.mp4");
        shell_exec("ffmpeg -i ../data/videos/$id.mp4 -ss 00:00:01.000 -frames:v 1 ../data/thumb/$id.png");

        $stmt = $pdo->prepare("INSERT INTO video (id, title, info, username, uploaded) VALUES (:id,:title,:info,:username,:uploaded)");

        $stmt->execute([
            "id" => $id,
            "title" => $title,
            "info" => $desc,
            "username" => $username,
            "uploaded" => microtime(true)
        ]);
    }
?>

<form method='POST' enctype='multipart/form-data'>
    <span>
        Title
    </span>
    <input name='title' maxlength='64' placeholder='A very cool video'>
    <span>
        Description
    </span>
    <textarea name='description' maxlength='1024'></textarea>
    <span>
        Source File
    </span>
    <input name='file' id='file' type='file'>
    <span>
        Upload
    </span>
    <input type='submit' value='Submit'>
</form>

<h1>Preview</h1>
<video id='preview' controls>

<script src='/js/preview.js'></script>