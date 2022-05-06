<?php
include 'top.php';

$sql = 'SELECT * FROM tblAccount';
$data = '';

$records = $thisDatabaseReader->select($sql, $data);

print '<h2>List of Accounts</h2>';

foreach($records as $record){
    print '<p>Account Id: ' . $record['pmkAccountId'] . ' Username: ' . $record['fldUsername'] . ' First and Last Name: ' . $record['fldFirstName'] . ' ' . $record['fldLastName'] . '<a href="displayProducts.php?uId=' . $record['pmkAccountId'] . '">View Users Products</a>' . '</p>';
}
?>



<?php
include 'footer.php';
?>