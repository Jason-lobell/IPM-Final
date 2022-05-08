<?php
include 'lib/top.php';

$pId = (isset($_GET['pId'])) ? (int) htmlspecialchars($_GET['pId']) : 0;

$sql = 'SELECT * FROM tblItem WHERE pmkItemId = ?';
$data = array();
$data[] .= $pId;

$records = $thisDatabaseReader->select($sql, $data);


for($i = 0; $i < 5 ; $i++){
    $pic = $records[0]['fldItemPicture' . $i];
    print '<figure>
        <img src="' . $pic .'" alt="' . $pic . '">
        <figcaption>Picture Number' . $i .'</figcaption>
        </figure>';
}
print '<p>Item Name: ' . $records[0]['fldItemName'] . ' Item Price: ' . $records[0]['fldItemPrice'] . ' Item Description: ' . $records[0]['fldItemDesc'] . ' Item Count left: ' . $records[0]['fldStock'];
?>

<form action="collectPayment.php" method="GET">
    <fieldset>
        <p>
            <input type="submit" name="btnSubmit" value="Submit">
        </p>
    </fieldset>
    <input type="hidden" name="hidProductId" value="<?php print $pId;?>">
    <input type="hiden" name="hidPrice" value="<?php print $records[0]['fldItemPrice'];?>">
    <input type="hidden" name="hidItemName" value="<?php print $records[0]['fldItemName'];?>">
</form>

