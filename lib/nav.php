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
    <?php
    if(isset($_SESSION['userId'])){
        print '<a class="';
        if (PATH_PARTS['filename'] == "logout.php"){
            print'activePage';
        }
        print '" href="logout.php">Logout</a>';
        print '<a class="';
        if (PATH_PARTS['filename'] == "addListing.php"){
            print'activePage';
        }
        print '" href="addListing.php">Add Product Listing</a>';
    }
    else{
        print '<a class="';
        if (PATH_PARTS['filename'] == "login.php"){
            print'activePage';
        }
        print '" href="login.php">Login</a>';
    }
    ?>
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
    <a href="login.php"></a>
</nav>