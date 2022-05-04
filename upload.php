<?php
include 'lib/top.php';
if(isset($_POST['btnSubmit'])){
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
                    $_SESSION['profPic'] = $fileDestination;
                    print '<script>
                    window.alert("Image Uploaded Successfully");
                    setTimeout(window.location.replace("account.php"), 5000);
                    </script>';
                }
                else{
                    print '<script>
                    window.alert("Image uploaded but not saved please contact an admin for help!");
                    setTimeout(window.location.replace("account.php"), 5000);
                    </script>';
                }
                
            }
            else{
                print '<script>
                window.alert("File is too big, Upload a smaller image");
                setTimeout(window.location.replace("account.php"), 5000);
                </script>';
            }
        }
        else{
            print '<script>
            window.alert("There was an error uploading photo please try again");
            setTimeout(window.location.replace("account.php"), 5000);
            </script>';
        }
    }
    else{
        print '<script>
        window.alert("You Cannot Upload a File of this type!! Only .jpg, .jpeg, and .png files are allowed");
        setTimeout(window.location.replace("account.php"), 5000);
        </script>';
    }

}
include 'lib/footer.php';
?>