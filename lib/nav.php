<?php
define('PATH_PARTS', array('filename' => 'about'));
?>
<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print'activePage';
    }
    ?>" href="index.php">Index</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "about"){
        print'activePage';
    }
    ?>" href="about.php">About</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "contact"){
        print'activePage';
    }
    ?>" href="contact.php">Contact</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "admin"){
        print'activePage';
    }
    ?>" href="admin/admin.php">Admin</a>
</nav>