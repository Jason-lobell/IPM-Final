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
$saveData = true;

if(!isset($_POST['btnSubmit'])){
    $firstName = "";
    $lastName = "";
    $emailAdress = "";
    $username = "";
    $password1 = "";
    $password2 = "";
    $agreeToTerms = 1;
}
else{
    //Sanitize Data
    $firstName = getData('txtFirstName');
    $lastName = getData('txtLastName');
    $emailAdress = getData('txtEmail');
    $username = getData('txtUsername');
    $password1 = getData('passPassword');
    $password2 = getData('passPassword2');
    $agreeToTerms = (int) getData("chkTerms");

    //Validate Data
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
        print '<p>PLEASE CHOOSE A VALID FIRST NAME.</p>';
        $saveData = false;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
        print '<p>PLEASE CHOOSE A VALID FIRST NAME.</p>';
        $saveData = false;
    }
    if (!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
        print '<p>PLEASE CHOOSE A VALID EMAIL ADRESS.</p>';
        $saveData = false;
    }
    if($password1 == $password2){
        if (strlen($password1) <= '8') {
            print "<p>Your Password Must Contain At Least 8 Characters!</p>";
            $saveData = false;
        }
        elseif(!preg_match("#[0-9]+#",$password1)) {
            print "<p>Your Password Must Contain At Least 1 Number!</p>";
            $saveData = false;
        }
        elseif(!preg_match("#[A-Z]+#",$password1)) {
            print "<p>Your Password Must Contain At Least 1 Capital Letter!</p>";
            $saveData = false;
        }
        elseif(!preg_match("#[a-z]+#",$password1)) {
            print "<p>Your Password Must Contain At Least 1 Lowercase Letter!</p>";
            $saveData = false;
        }
    }
    else {
        print "<p>Check to make sure you entered a password and Confirmed it correctly</p>";
        print "<p>" . $password1 . " Password 1 " . $password2;
        $saveData = false;  
    }
    if(strlen($username) > 1){
        $sql = "SELECT fldUsername FROM tblAccount WHERE fldUsername = ?";
        $data = $username;
    
        // if(array_search($username, $thisDatabaseReader->select($sql, $data))){
        //     print "<p>Username is already taken</p>";
        //     $saveData = false;
        // }
    }
    else{
        print "<p>Please enter a username</p>";
        $saveData = false;
    }
    if ($agreeToTerms != 1){
        print '<p>PLEASE AGREE TO OUR TERMS AND CONDITIONS</p>';
        $saveData = false;
    }

    if($saveData){

        $sql = 'INSERT INTO tblAccount SET fldFirstName = ? , fldLastName = ? , fldEmail = ? , fldUsername = ? , fldPassword = MD5(?)';
        $data = array();
        $data[] .= $firstName;
        $data[] .= $lastName;
        $data[] .= $emailAdress;
        $data[] .= $username;
        $data[] .= $password1;

        if(isset($_POST['btnSubmit'])){
            try{
                if($thisDatabaseWriter->insert($sql,$data)){
                    print '<p>Successfully Signed up!!</p>';
                }
                else {
                    print '<p>Not Successfully Signed up. Try again or contact us at 914-815-5624 for help.</p>';
                }
        } catch (PDOException $e) {
            print '<p>Couldn\'t Finish Sign up. Please contact us at 914-815-5624 for help:(.</p>';
            print '<p>' . $e . '</p>';
        }
        }
    
        if(DEBUG) {
            print "<p>" . $thisDatabaseReader->displayQuery($sql, $data) . "</p>    ";
        }
    }
}

?>

<main>
    <h2>Sign up</h2>
    <form action="#" method="post">
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
                <label for="txtEmail">Email</label>
                <input type="text" name="txtEmail" id="txtEmail" value="<?php print $emailAdress;?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="txtUsername">Username</label>
                <input type="text" name="txtUsername" id="txtUsername" value="<?php print $username;?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="passPassword">Password</label>
                <input type="password" name="passPassword" id="passPassword" value="">
                <label for="passPassword2">Re-Enter Password</label>
                <input type="password" name="passPassword2" id="passPassword2" value="">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <label for="chkTerms">Agree to Terms and Conditions</label>
                <input type="checkbox" id="chkTerms" name="chkTerms" value="<?php print $agreeToTerms;?>">
            </p>
        </fieldset>
        <fieldset>
            <p>
                <input type="submit" name="btnSubmit" value="Submit">
            </p>
        </fieldset>
    </form>
</main>



<?php
include 'lib/footer.php';
?>