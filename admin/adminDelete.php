<?php
include 'top.php';
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

$donationId = (isset($_GET['pmk'])) ? (int) htmlspecialchars($_GET['pmk']) : 0;

$data = array($donationId);
$sql = 'SELECT pmkAdopterEmail, fpkWildlifeId, fldDonationAmmount, fldEnteredBy, fldFirstName, fldLastName, fldAgreedToTerms, fldReceiveCommunication FROM tblAdopterWildlife ';
$sql .= 'INNER JOIN tblAdopter ';
$sql .= 'ON tblAdopterWildlife.fpkAdopterEmail = tblAdopter.pmkAdopterEmail ';
$sql .= 'WHERE tblAdopterWildlife.pmkDonationId = ?';
$results = $thisDatabaseReader->select($sql, $data);

$saveData = true;


if(!isset($_POST['btnSubmit'])){
    $donationAmmount = $results[0]['fldDonationAmmount'];
    $emailAdress = $results[0]['pmkAdopterEmail'];
    $firstName = $results[0]['fldFirstName'];
    $lastName = $results[0]['fldLastName'];
    $agree = $results[0]['fldAgreedToTerms'];
    $receiveCommunication = $results[0]['fldReceiveCommunication'];
    $wId = $results[0]['fpkWildlifeId'];
    $enteredBy = $netId;
}
else{
    // Sanitize data
    $wId = (int) getData('txtCID');
    $enteredBy = $netId;
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

    $sql = 'DELETE FROM tblAdopterWildlife WHERE pmkDonationId = ?';

    $data = array($donationId);

    if(isset($_POST['btnSubmit'])){
        try{
            if($thisDatabaseWriter->delete($sql,$data)){
                print '<p>Submitted statement 1!!!</p>';
            }
            else {
                print '<p>statement 1 not Successfully Saved!!!</p>';
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
    print '<h2>Insert record</h2>';
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
                <label for="txtCID">Creature Id</label>
                <input type="text" name="txtCID" id="txtCID" value="<?php print $wId;?>">
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
                <input type="submit" name="btnSubmit" value="DELETE">
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
include 'footer.php';
?>