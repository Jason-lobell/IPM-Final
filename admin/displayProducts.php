<?php
include 'top.php';

$uId = (isset($_GET['uId'])) ? (int) htmlspecialchars($_GET['uId']) : 0;

$sql = 'SELECT tblItem.*, tblAccount.fldUsername FROM `tblItem` LEFT JOIN tblAccount ON tblAccount.pmkAccountId=tblItem.fpkSellerId WHERE fpkSellerId = ?';
$data = array();
$data[] .= $uId;

$records = $thisDatabaseReader->select($sql, $data);
print '<p>All of ' . $records[0]['fldUsername'] . "'s Listed Items</p>";

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

