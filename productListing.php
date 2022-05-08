<?php
include 'top.php';

$uId = (isset($_GET['pId'])) ? (int) htmlspecialchars($_GET['pId']) : 0;

$sql = 'SELECT * FROM tblItem WHERE pmkItemId = ?';
$data = array();
$data[] .= $pId;

$records = $thisDatabaseReader->select($sql, $data);


foreach($records as $record){
    for($i = 0; $i < 5 ; $i++){
        $pic = '../';
        $pic .= $record['fldItemPicture' . $i];
        print '<figure>
            <img src="' . $pic .'" alt="' . $pic . '">
            <figcaption>Picture Number' . $i .'</figcaption>
            </figure>';
    }
    print '<p>Item Name: ' . $record['fldItemName'] . ' Item Price: ' . $record['fldItemPrice'] . ' Item Description: ' . $record['fldItemDesc'] . ' Item Count left: ' . $record['fldStock'];
}

?>

