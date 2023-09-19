<?php 
    include("header.php");
?>

<div class='area nav'>
    <span>
        <a href='/'>DervHost</a>
    </span>
    <span>
        <?php if ($username) { ?>
            <a href='/upload'>Upload</a>
            <a href='/users/<?php echo $username ?>'><?php echo $username ?></a>
        <?php } else { ?>
            <a href='https://auth.dervland.net/login?next=host.dervland.net'>Log in</a>
        <?php } ?>
    </span>
</div>