<?php 
include 'lib/top.php';

if(isset($_POST['btnSubmit'])){
    session_unset();
    session_destroy();
}
?>
<form action="#" method="POST">
    <fieldset>
        <input type="submit" name="btnSubmit" value="LOGOUT">
    </fieldset>
</form>

<?php
include 'lib/footer.php';
?>