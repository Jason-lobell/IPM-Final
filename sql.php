<?php
include 'top.php';
?>
<main>
    <p>Create Table SQL</p>


<pre>
CREATE TABLE tblWildlife (
    pmkWildlifeid INT AUTO_INCREMENT PRIMARY KEY,
    fldType varchar(12),
    fldCommonName varchar(20),
    fldDescription varchar(900),
    fldHabitat text,
    fldReproduction text,
    fldDiet text,
    fldManagement text,
    fldStatus text,
    fldMainImage text
);
</pre>

<p>Select all records sorted by common name</p>

<pre>
SELECT pmkWildlifeid, fldType, fldCommonName, fldDescription, fldHabitat, fldReproduction, fldManagement, fldStatus, fldMainImage FROM tblWildlife ORDER BY fldCommonName;
</pre>

</main>
<?php include 'footer.php'; ?>
</body>
</html>

