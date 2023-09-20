<?php
    $upload = $_SERVER['DOCUMENT_ROOT'].'/data';
    $tmpDir = $_SERVER['DOCUMENT_ROOT'].'/../tmp';

    function parseVideo($video) {
        foreach ($video as $key => $value) {
            $video[$key] = htmlspecialchars($value);
        }

        $video['uploaded'] = date("Y M d H:i:s", $video['uploaded'] * 1);
        
        return $video;
    }
?>