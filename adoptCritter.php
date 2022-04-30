<?php
include 'lib/top.php';
// Sanitize funtcion from the text function
function getData($field) {
    if(!isset($_POST[$field])) {
        $data = "";
    }
    else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}

$critterID = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;
$sql = 'SELECT pmkWildlifeId, fldCommonName FROM tblWildlife Where pmkWildlifeId = ?';

$data = array($critterID);
$animalToAdopt = $thisDatabaseReader->select($sql, $data);

$critterCommonName = $animalToAdopt[0]['fldCommonName'];
$saveData = true;


if(!isset($_POST['btnSubmit'])){
    $donationAmmount = 50;
    $emailAdress = "";
    $firstName = "";
    $lastName = "";
    $agree = 1;
    $receiveCommunication = 1;
    $wId = $critterID;
    $enteredBy = 'online';
}
else{
    // Sanitize data
    $wId = $critterID;
    $enteredBy = 'online';
    $donationAmmount = (int) getData('rngDonationAmmount');
    $emailAdress = getData('txtEmail');
    $firstName = getData('txtFirstName');
    $lastName = getData('txtLastName');
    $agree = (int) getData('chkTerms');
    $receiveCommunication = (int) getData('chkEmail');
    

    // Validate data
    if($donationAmmount <= 25 or $donationAmmount >= 1000){
        print '<p>PLEASE CHOOSE A VALID DONATION AMMOUNT.</p>';
        $saveData = false;
    }
    if (!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
        print '<p>PLEASE CHOOSE A VALID EMAIL ADRESS.</p>';
        $saveData = false;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
        print '<p>PLEASE CHOOSE A VALID FIRST NAME.</p>';
        $saveData = false;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
        print '<p>PLEASE CHOOSE A VALID FIRST NAME.</p>';
        $saveData = false;
    }
    if ($agree != 1){
        print '<p>PLEASE AGREE TO OUR TERMS AND CONDITIONS</p>';
        $saveData = false;
    }
    if ($wId < 0){
        print '<p>PLEASE ENTER A VALID CID';
    }
}


// Save data check
if($saveData){

    $sql = 'INSERT INTO tblAdopterWildlife SET fldDonationAmmount = ?, fpkAdopterEmail = ?, fpkWildlifeId = ?, fldEnteredBy = ?';

    $data = array();
    $data[] = $donationAmmount;
    $data[] .= $emailAdress;
    $data[] .= $wId;
    $data[] .= $enteredBy;

    $sql2 = 'INSERT INTO tblAdopter SET pmkAdopterEmail = ?, fldFirstName = ?, fldLastName = ?, fldAgreedToTerms = ?, fldReceiveCommunication = ?';
    $sql2 .= ' ON DUPLICATE KEY UPDATE fldFirstName = ?, fldLastName = ?, fldAgreedToTerms = ?, fldReceiveCommunication = ?';
    
    $data2 = array();
    $data2[] = $emailAdress;
    $data2[] .= $firstName;
    $data2[] .= $lastName;
    $data2[] .= $agree;
    $data2[] .= $receiveCommunication; 
    
    $data2[] .= $firstName;
    $data2[] .= $lastName;
    $data2[] .= $agree;
    $data2[] .= $receiveCommunication;

    if(isset($_POST['btnSubmit'])){
        try{
            if($thisDatabaseWriter->insert($sql,$data)){
                print '<p>Submitted statement 1!!!</p>';
            }
            else {
                print '<p>statement 1 not Successfully Saved!!!</p>';
            }
            if($thisDatabaseWriter->insert($sql2,$data2)){
                print '<p>Submitted statement 2!!!</p>';
            }
            else {
                print '<p>statement 2 not Successfully Saved!!!</p>';
            } 
    } catch (PDOException $e) {
        print '<p>Couldn\'t insert the record, please contact someone :).</p>';
    }
    }

    if(DEBUG) {
        print $thisDatabaseReader->displayQuery($sql, $data);
        print $thisDatabaseReader->displayQuery($sql2, $data2);
    }
}
?>

<main>
    <?php
    if(DEBUG){
        if(isset($_POST['btnSubmit'])){
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
        }
    }
    print '<h2>Adopt a ' . $critterCommonName . '</h2>';
    ?>

    <form action="#" method="POST">
        <fieldset>
            <p>
                <label for="rngDonationAmmount">Donation Ammount</label>
                <input type="range" min="25" max="1000" step="25" value="<?php print $donationAmmount;?>" name="rngDonationAmmount" id="rngDonationAmmount">
                <p id="output"></p>
            </p>
        </fieldset>
        <fieldset>  
            <p>
                <label for="txtEmail">Email</label>
                <input type="text" name="txtEmail" id="txtEmail" value="<?php print $emailAdress;?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtFirstName">First Name</label>
                <input type="text" name="txtFirstName" id="txtFirstName" value="<?php print $firstName;?>">
                <label for="txtLastName">Last Name</label>
                <input type="text" name="txtLastName" id="txtLastName" value="<?php print $lastName;?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="chkTerms">Agree to Terms and Conditions</label>
                <input type="checkbox" id="chkTerms" name="chkTerms" value="<?php print $agree;?>" checked>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="chkEmail">Would You like to recieve email from us?</label>
                <input type="checkbox" id="chkEmail" name="chkEmail" value="<?php print $receiveCommunication;?>" checked>
            </p>
        </fieldset>
        <fieldset>
            <p>
                <input type="submit" name="btnSubmit" value="Submit">
            </p>
        </fieldset>
    </form>
    <script>
        var slider = document.getElementById("rngDonationAmmount");
        var output = document.getElementById("output");
        output.innerHTML = slider.value;

        slider.oninput = function() { 
            output.innerHTML = this.value;
        }
    </script>
</main>

<?php
include 'lib/footer.php';
?>