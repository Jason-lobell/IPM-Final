<?php
define('PATH_PARTS', array('filename' => 'about'));
?>
<!-- make nav for admin this is just copy paste -->
<nav>
<a class="<?php
    if (PATH_PARTS['filename'] == "index"){
        print'activePage';
    }
    ?>" href="../index.php">Home</a>

    <div class="dropdown">
    <button class="dropbtn">Admin
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="admin.php">Admin</a>
      <a href="adminInsert.php">Insert Record</a>
      <a href="adminDelete.php">Update/Delete Record</a>
      <a href="displayAccounts.php">Display Accounts </a>
      <a href="updateAccount.php">Update Account </a>
    </div>
    </div>
</nav>