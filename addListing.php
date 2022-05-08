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
    $name = '';
    $price = 0;
    $stock = 0;
    $description = '';
}
else{
    //Sanitize Data
    $name = getData('txtName');
    $price = getData('numPrice');
    $stock = getData('numStock');
    $description = getData('textAreaDesc');

    //Validate Data 
    //Data validation is def my least favorite part about every database interaction
    //Not even like its hard idk why it just annoys me to do (╯°□°）╯︵ ┻━┻
    if($price < 1){
        print '<p>Please enter a price that is equal to or above $1</p>';
        $saveData = false;
    }
    if($stock < 1){
        print '<p>Please enter a stock that is equal to or above 1</p>';
        $saveData = false;
    }
    // if(!preg_match('^(.|\s)*[a-zA-Z]+(.|\s)*$', $description)){
    //     print '<p>Enter a valid description</p>';
    //     $saveData = false;
    // }

    
    if($saveData){

        $sql = 'INSERT INTO tblItem SET fldItemName = ?, fldItemPrice = ?, fldStock = ?, fldItemDesc = ?, fpkSellerId = ?';
        $data = array();
        $data[] .= $name;
        $data[] .= $price;
        $data[] .= $stock;
        $data[] .= $description;
        $data[] .= $_SESSION['userId'];

        if(isset($_POST['btnSubmit'])){
            try{
                if($thisDatabaseWriter->insert($sql,$data)){
                    $insertId = $thisDatabaseWriter->lastInsertId();
                    include 'upload.php'; //Form method is # cause other data has to be added and upload is just for pictures. Therefore include :)
                }
                else {
                    print '<p>Listing not successfully added. Try again or contact us at 914-815-5624 for help.</p>';
                }
        } catch (PDOException $e) {
            print '<p>' . $e . '</p>'; 
            print '<p>Couldn\'t Finish Sign up. Please contact us at 914-815-5624 for help:(.</p>';
        }
        }
    
        if(DEBUG) {
            print "<p>" . $thisDatabaseReader->displayQuery($sql, $data) . "</p>    ";
        }
    }
}
?>

<main>
    <h2>Add Product Listing</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label for="txtName">Product Name</label>
                <input type="text" name="txtName"  value="<?php print $name;?>">
                <label for="numPrice">Price of Product</label>
                <input type="number" min="1" name="numPrice" step="any" value="<?php print $price?>">
                <label for="numStock">How many availble to sell</label>
                <input type="number" min="1" name="numStock" value="<?php print $stock ?>">
            </p>
        </fieldset>
        <fieldset>
            <label for="file">Upload Picture1</label>
            <input type="file" name="file[]">
            <label for="file">Upload Picture2</label>
            <input type="file" name="file[]">
            <label for="file">Upload Picture3</label>
            <input type="file" name="file[]">
            <label for="file">Upload Picture4</label>
            <input type="file" name="file[]">
            <label for="file">Upload Piture5</label>
            <input type="file" name="file[]">
        </fieldset>
        <fieldset>
            <p>
                <label for="textAreaDesc">Description</label>
                <textarea name="textAreaDesc" cols="50" rows="10"><?php print $description?></textarea>
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