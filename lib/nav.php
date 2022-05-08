<?php
define('PATH_PARTS', array('filename' => 'about'));
?>
<nav>
    <a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print'activePage';
    }

    ?>" href="index.php">Home</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "marketplace"){
        print'activePage';
    }
    ?>" href="marketplace.php">Marketplace</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "login"){
        print'activePage';
    }
    ?>" href="login.php">Login</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "account"){
        print'activePage';
    }
    ?>" href="account.php">Account</a>

    <a class="<?php
        if (PATH_PARTS['filename'] == "addListing"){
            print'activePage';
        }
        ?>" href="addListing.php">Add Listing</a>


    <a class="<?php
    if (PATH_PARTS['filename'] == "admin"){
        print'activePage';
    }
    ?>" href="admin/admin.php">Admin</a>
</nav>