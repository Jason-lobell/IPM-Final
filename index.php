<?php
include 'lib/top.php';
$sql = 'SELECT pmkWildlifeid, fldType, fldCommonName, fldDescription, fldHabitat, fldReproduction, fldManagement, fldStatus, fldMainImage ';
$sql .= 'FROM tblWildlife ORDER BY fldCommonName;';

$data ='';
$animals = $thisDatabaseReader->select($sql, $data);

?>

<main>
    <h2>Vermonts Wildlife</h2>
    
    <figure>
    <?php 
    foreach($animals as $value){
        print '<img src="' . $value['fldMainImage'] . '"alt="' . $value['fldCommonName'] . '">';
        print '<a href="displayCritter.php?cid=' . $value['pmkWildlifeid'] . '"><figcaption>' . $value['fldCommonName'] . '</figcaption></a>';
    }
    ?>
    
    </figure>

</main>



<?php
include 'lib/footer.php';
?>