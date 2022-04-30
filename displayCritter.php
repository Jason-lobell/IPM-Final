<?php
include 'lib/top.php';
$critterID = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;
$sql = 'SELECT fldCommonName, fldDescription, fldHabitat, fldReproduction, fldManagement, fldStatus, fldMainImage ';
$sql .= 'FROM tblWildlife where pmkWildlifeid = ?';

print '<!-- SQL STATMENT RUN HERE -->';

$data = array($critterID);
$animals = $thisDatabaseReader->select($sql, $data);
?>

<main>
    <?php
    if(is_array($animals)){
        foreach($animals as $animal){
            print '<h2>' . $animal['fldCommonName'] . '</h2>';
            print '<a href="adoptCritter.php?cid=' . $critterID . '"><em>Adopt a ' . $animal['fldCommonName'] . '</em></a>';
            print '<figure><img src="' . $animal['fldMainImage'] . '"alt="' . $animal['fldCommonName'] . '"></figure>';
            print '<p>' . $animal['fldDescription'] . "</p>";
            print '<p>' . $animal['fldHabitat'] . "</p>";
            print '<p>' . $animal['fldReproduction'] . "</p>";
            print '<p>' . $animal['fldManagement'] . "</p>";
            print '<p>' . $animal['fldStatus'] . "</p>";
        }
    }
    ?>
</main>

<?php
include 'lib/footer.php';
?>