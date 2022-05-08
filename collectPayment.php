

<form action="handleStuff.php" method="POST">
    <fieldset>
        <p>
            <input type="submit" name="btnSubmit" value="Submit">
        </p>
    </fieldset>
    <input type="hidden" name="hidProductId" value="<?php print $pId;?>">
</form>