<?php
define('PATH_PARTS', array('filename' => 'about'));
?>
<!-- make nav for admin this is just copy paste -->
<nav>
<a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print'activePage';
    }
    ?>" href="../index.php">Index</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "about"){
        print'activePage';
    }
    ?>" href="../about.php">About</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "contact"){
        print'activePage';
    }
    ?>" href="../contact.php">Contact</a>
    <a class="<?php
    if (PATH_PARTS['filename'] == "login"){
        print'activePage';
    }
    ?>" href="../login.php">Login</a>
    <div class="dropdown">
    <button class="dropbtn">Admin
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="admin.php">Admin</a>
      <a href="adminInsert.php">Insert Record</a>
      <a href="displayRecords.php">Update/Delete Record</a>
    </div>
    </div>
</nav>