<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Andrew DeRusso">
        <meta name="description" content="add-later">
        <title>add-later</title>
        <link rel="stylesheet" 
            href="../css/custom.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="stylesheet" media="(max-width:800px)"
            href="../css/tablet.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)"
            href="../css/phone.css?version=<?php print time(); ?>"
            type="text/css">
        <?php 
        print '<!-- ***** INCLUDE LIBRARIES ****** -->';
        include '../lib/constants.php';

        print'<!-- ****** MAKE DATABASE CONNECTION ****** -->';
        require_once('../lib/database.php');

        $thisDatabaseReader = new DataBase('aderusso_reader', DATABASE_NAME);
        $thisDatabaseWriter = new DataBase('aderusso_writer', DATABASE_NAME);
        
        $netId = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");

        $sql = 'SELECT * FROM tblAdminNetId ORDER BY netId DESC';
        $data = '';
        $adminNetId = $thisDatabaseReader->select($sql, $data);
        ?>
    </head>
<?php
if(!array_search($netId,array_column($adminNetId,'netId'))){
	print '<body>';
    print '<!-- ***** START OF BODY ****** -->';
    print '<script>
            window.alert("NOT ALLOWED");
            setTimeout(window.location.replace("https://google.com/"), 5000);
            </script>';
}else{
    print '<body>';
    print '<!-- ***** START OF BODY ****** -->';
}

print PHP_EOL;

include 'nav.php';
print PHP_EOL;

include 'header.php';
print PHP_EOL;
?>