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
    if (PATH_PARTS['filename'] == "marketplace"){
        print'activePage';
    }
    ?>" href="marketplace.php">Marketplace</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "admin"){
        print'activePage';
    }
    ?>" href="admin/admin.php">Admin</a>
</nav>