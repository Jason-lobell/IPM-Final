<?php
include 'top.php';

$sql = 'SELECT * FROM tblAdopterWildlife';
$data = '';

$records = $thisDatabaseReader->select($sql, $data);

if(isset($_POST['WildlifeDonationReport'])){
    $sql2 = 'SELECT fldDonationAmmount, fldFirstName, fldLastName, fldCommonName FROM ((tblAdopterWildlife
    INNER JOIN tblAdopter
    ON tblAdopterWildlife.fpkAdopterEmail = tblAdopter.pmkAdopterEmail)
    INNER JOIN tblWildlife
    ON tblAdopterWildlife.fpkWildlifeId = tblWildlife.pmkWildlifeid)  
    ORDER BY `tblWildlife`.`fldCommonName` ASC';
    $data2 = '';
    $reports = $thisDatabaseReader->select($sql2,$data2);

    foreach($reports as $report){
        print $report['fldCommonName'] . ' Adopted by: ' . $report['fldFirstName'] . ' ' . $report['fldLastName'] . ' For $' . $report['fldDonationAmmount'] . PHP_EOL;
    }
}
elseif(isset($_POST['AdopterDonationReport'])){
    $sql2 = 'SELECT fldDonationAmmount, fldFirstName, fldLastName, fldCommonName FROM ((tblAdopterWildlife
    INNER JOIN tblAdopter
    ON tblAdopterWildlife.fpkAdopterEmail = tblAdopter.pmkAdopterEmail)
    INNER JOIN tblWildlife
    ON tblAdopterWildlife.fpkWildlifeId = tblWildlife.pmkWildlifeid)  
    ORDER BY `tblAdopter`.`fldLastName` ASC';
    $data2 = '';
    $reports = $thisDatabaseReader->select($sql2,$data2);

    foreach($reports as $report){
        print $report['fldFirstName'] . ' ' . $report['fldLastName'] . ' Adopted a ' . $report['fldCommonName'] . ' For $' . $report['fldDonationAmmount'] . PHP_EOL;
    }
}

if(is_array($records)){
    print '<ul>';
    foreach($records as $record){
        print '<li>' . 'pmkDonationId: ' . $record['pmkDonationId'] . ' , fpkAdopterEmail: ' . $record['fpkAdopterEmail'] . ' , fpkWildlifeId: ' . $record['fpkWildlifeId'] . ' , fldDonationAmmount: ' . $record['fldDonationAmmount'] . ' , fldEnteredBy: ' . $record['fldEnteredBy'] . '<a href="adminInsert.php?pmk=' . $record['pmkDonationId'] .'">Update</a> <a href="adminDelete.php?pmk=' . $record['pmkDonationId'] .'">Delete</a></li>';
    }
    print '</ul>';
}
?>
    <form method="POST" action="#">
        <input type="submit" name="WildlifeDonationReport" value="Show WildlifeDonation Report">
        <input type="submit" name="AdopterDonationReport" value="Show AdopterDonation Report">
    </form>

  
  
<?php
include 'footer.php';
?>