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
    $emailAdress = "";
}
else{
    // Sanitize
    $emailAdress = getData('txtEmail');

    //Validate 
    if (!filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
        print '<p>PLEASE CHOOSE A VALID EMAIL ADRESS.</p>';
        $saveData = false;
    }

    //Save data check
    if($saveData){
        $sql = "UPDATE tblAccount SET fldEmail = ? WHERE pmkAccountId = ?";
        $data = array();
        $data[] .= $emailAdress;
        $data[] .= $_SESSION['userId'];

        if(isset($_POST['emailSubmit'])){
            try{
                if($thisDatabaseWriter->update($sql,$data)){
                    print '<p>Successfully Changed Email Adress!!</p>';
                }
                else {
                    print '<p>Couldn\'t change record. Try again or contact us at 914-815-5624 for help.</p>';
                }
        } catch (PDOException $e) {
            print '<p>Couldn\'t change record. Please contact us at 914-815-5624 for help:(.</p>';
        }
        }
    
        if(DEBUG) {
            print "<p>" . $thisDatabaseReader->displayQuery($sql, $data) . "</p>    ";
        }
    }

}


?>
<main>
    <h1>Account Overview</h1>
    <h2>Welcome <?php print $_SESSION['userUname'];?></h2>
    <figure>
        <img src="<?php
        print $_SESSION['profPic'];
        ?>" alt="ProfilePicture">
        <figcaption>Current Profile Picture</figcaption>
    </figure>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for="file">Upload Profile Picture</label>
                <input type="file" name="file">
                <input type="submit" name="btnSubmit" value="Submit">
            </p>
        </fieldset>
    </form>
    <form action="#" method="POST">
        <fieldset>
            <p>Email on File: <?php print $_SESSION['userEmail'];?></p>
            <p>
                <label for="txtEmail">Change Email</label>
                <input type="text" name="txtEmail" id="txtEmail" value="<?php print $emailAdress;?>">
                <input type="submit" name="emailSubmit" value="Submit">
            </p>
        </fieldset>
    </form>
</main>

<?php
include 'lib/footer.php';
?>