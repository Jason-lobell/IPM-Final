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


if(!isset($_POST['btnSubmit'])){
    $unameEmail = '';
    $password = '';
}
else{
    //Sanitize before checking if user exists
    $unameEmail = getData('txtUnameEmail');
    $password = getData('passPassword');

    $sql = "SELECT * FROM tblAccount WHERE fldUsername = ? OR fldEmail = ?";
    $data = array();
    $data[] .= $unameEmail;
    $data[] .= $unameEmail;

    $results = $thisDatabaseReader->select($sql, $data);

    $hashWord = $results[0]['fldPassword'];

    if(md5($password) == $hashWord){
        session_start();
        $_SESSION["userId"] = $results[0]["pmkAccountId"];
        $_SESSION["userUname"] = $results[0]["fldUsername"];
        $_SESSION["profPic"] = $results[0]["fldProfilePhoto"];
        $_SESSION["firstName"] = $results[0]["fldFirstName"];
        $_SESSION["lastName"] = $results[0]["fldLastName"];
        $_SESSION["userEmail"] = $results[0]["fldEmail"];
        print '<script>
        window.alert("Logged in! Welcome' . $_SESSION["userUname"] .'");
        setTimeout(window.location.replace("index.php"), 5000);
        </script>';
    }
}


?>

<main>
    <form action="#" method="POST">
        <fieldset>
            <label for="txtUnameEmail">Please Enter Your Username Or Email</label>
            <input type="text" name="txtUnameEmail" id="txtUnameEmail" value="<?php print $unameEmail;?>">
            <label for="passPassword">Password</label>
            <input type="password" name="passPassword" id="passPassword" value="<?php print $password;?>">
        </fieldset>
        <fieldset>
            <p>
                <input type="submit" name="btnSubmit" value="Submit">
            </p>
        </fieldset>
    </form>
    <a href="signup.php">New User? Signup Here!</a>
</main>

<?php
include 'lib/footer.php';
?>