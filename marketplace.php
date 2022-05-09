<?php
include 'lib/top.php';

$sql = 'SELECT * FROM tblItem';
$data = '';

$items = $thisDatabaseReader->select($sql, $data);

foreach($items as $item){
    $pic = $item['fldItemPicture1'];
        print '<figure>
            <img src="' . $pic .'" alt="' . $pic . '">
            <figcaption>' . $item['fldItemName'] . '</figcaption>
            <form action="productListing.php?pId=' . $item['pmkItemId'] . '" method="POST"><input type="submit" name="btnSubmit" value="' . $item['fldItemPrice'] .'"></form>
            </figure>';
}
include 'lib/footer.php';
?>