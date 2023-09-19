<?php
    if ($_POST) {
        $uploadfile = $upload . basename($_FILES['file']['name']);

        $id = bin2hex(random_bytes(10));

        $outDir = "$tmpDir/" . $id;
    
        move_uploaded_file($_FILES['file']['tmp_name'], $outDir);
    
        $isValid = shell_exec("ffprobe -v error -show_entries stream=width,height -of default=noprint_wrappers=1 $outDir");
    }

    if ($isValid) {
        shell_exec("ffmpeg -i $outDir ../data/videos/$id.mp4");
        shell_exec("ffmpeg -i ../data/videos/$id.mp4 -ss 00:00:01.000 -vframes 1 ../data/thumb/$id.png");
    }
?>

<form method='POST' enctype='multipart/form-data'>
    <span>
        Title
    </span>
    <input name='title' placeholder='A very cool video'>
    <span>
        Description
    </span>
    <textarea name='description'></textarea>
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