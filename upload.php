<?php
include 'lib/top.php';
if(isset($_POST['submit'])){
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileNameParts = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameParts));

    $allowedExt = array();
    $allowedExt[] .= 'jpg';
    $allowedExt[] .= 'jpeg';
    $allowedExt[] .= 'png';

    if(in_array($fileExtension,$allowedExt)){
        if($fileError == 0){
            if($fileSize < 100000){
                $fileNewName = uniqid('', true);
                $fileNewName .= ".";
                $fileNewName .= $fileExtension;

                $fileDestination = 'uploads/' . $fileNewName;

                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "UPDATE tblAccount SET fldProfilePhoto = ? WHERE pmkAccountId = ?";
                $data = array();
                $data[] .= $fileDestination;
                $data[] .= $_SESSION['userId'];

                if($thisDatabaseWriter->update($sql, $data)){
                    print '<p>Image Uploaded Successfully</p>';
                }
                else{
                    print '<p>Image uploaded but not saved please contact an admin for help!';
                }
                
            }
            else{
                print '<p>File is too big, Upload a smaller image</p>';
            }
        }
        else{
            print '<p>There was an error uploading file! Try again.</p>';
        }
    }
    else{
        print '<p>You Cannot Upload a File of this type!!</p>';
        print '<p>Only .jpg, .jpeg, and .png files are allowed.</p>';
    }

}
?>