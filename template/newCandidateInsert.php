<?php
include ('database.php');
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$gender = $_POST['gender'];
$mobNum = $_POST['mobNum'];
$passportNum= $_POST['passportNum'];
$issuD = $_POST['issuD'];
$country = $_POST['country'];
$validityYear = $_POST['validityYear'];
$departureDate = $_POST['departureDate'];
$arrivalDate = $_POST['arrivalDate'];
$policeVerification = $_POST['policeVerification'];
$photo = $_POST['passportPhoto'];
$validityYear = $_POST['validityYear'];
$manpowerOfficeName = $_POST['manpower'];
$jobType = $_POST['jobType'];

if(isset($_POST['agentEmail'])){
    $agentEmail = $_POST['agentEmail'];
}else{
    $agentEmail = '';
}

if(isset($_POST['office'])){
    $office = $_POST['office'];
}else{
    $office = '';
}

$comment = $_POST['comment'];
$dob = $_POST['dob'];
$admin = $_SESSION['email'];
$date = date("Y/m/d H:i:s");
// $date = date("Y-m-d H:i:s", strtotime('-9 hours', strtotime($curdate)));
$update = date("Y/m/d");

// Scanned police verification file directory set - upload code inside result true if statement
if (($_FILES['policeVerification']['name'] != "")){
    // Where the file is going to be stored
    
    $target_dir = "uploads/policeVerification/";    
    $file = $_FILES['policeVerification']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['policeVerification']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."policeVerification"."_".$passportNum.".".$ext;
}

// Scanned photo file directory set - upload code inside result true if statement
if (($_FILES['photoFile']['name'] != "")){
    // Where the file is going to be stored
    $target_dir_photo = "uploads/photo/";
    $file_photo = $_FILES['photoFile']['name'];
    $path_photo = pathinfo($file_photo);
    $photo_ext = $path_photo['extension'];
    $photo_temp_name = $_FILES['photoFile']['tmp_name'];
    $photo_path_filename_ext = $base_dir.$target_dir_photo."photo"."_".$passportNum.".".$photo_ext;
}


// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['passportScan']['name'] != "")){
    // Where the file is going to be stored
    $passport_target_dir = "uploads/passport/";
    $file = $_FILES['passportScan']['name'];
    $path = pathinfo($file);
    $passport_ext = $path['extension'];
    $passport_temp_name = $_FILES['passportScan']['tmp_name'];
    $passport_path_filename_ext = $base_dir.$passport_target_dir."passport"."_".$passportNum.".".$passport_ext;
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['departureSealFile']['name'] != "")){
    // Where the file is going to be stored
    $departureSeal_target_dir = "uploads/departureSeal/";
    $file = $_FILES['departureSealFile']['name'];
    $path = pathinfo($file);
    $departureSeal_ext = $path['extension'];
    $departureSeal_temp_name = $_FILES['departureSealFile']['tmp_name'];
    $departureSeal_path_filename_ext = $base_dir.$departureSeal_target_dir."departureSeal"."_".$passportNum.".".$departureSeal_ext;
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['arrivalSealFile']['name'] != "")){
    // Where the file is going to be stored
    $arrivalSeal_target_dir = "uploads/arrivalSeal/";
    $file = $_FILES['arrivalSealFile']['name'];
    $path = pathinfo($file);
    $arrivalSeal_ext = $path['extension'];
    $arrivalSeal_temp_name = $_FILES['arrivalSealFile']['tmp_name'];
    $arrivalSeal_path_filename_ext = $base_dir.$arrivalSeal_target_dir."arrivalSeal"."_".$passportNum.".".$arrivalSeal_ext;
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['traningCardFile']['name'] != "")){
    // Where the file is going to be stored
    $trainingCard_target_dir = "uploads/trainingCard/";
    $file = $_FILES['traningCardFile']['name'];
    $path = pathinfo($file);
    $trainingCard_ext = $path['extension'];
    $trainingCard_temp_name = $_FILES['traningCardFile']['tmp_name'];
    $trainingCard_path_filename_ext = $base_dir.$trainingCard_target_dir."trainingCard"."_".$passportNum.".".$trainingCard_ext;
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['oldVisaFile']['name'] != "")){
    // Where the file is going to be stored
    $oldVisa_target_dir = "uploads/oldVisa/";
    $file = $_FILES['oldVisaFile']['name'];
    $path = pathinfo($file);
    $oldVisa_ext = $path['extension'];
    $oldVisa_temp_name = $_FILES['oldVisaFile']['tmp_name'];
    $oldVisa_path_filename_ext = $base_dir.$oldVisa_target_dir."oldVisa"."_".$passportNum.".".$oldVisa_ext;
}

$existingPass = mysqli_fetch_assoc($conn->query("select count(passportNum) as passCount from passport where passportNum = '$passportNum'"));
if($existingPass['passCount'] > 0){
    echo "<script>window.alert('Passport Already Exists')</script>";
    echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
}else{
    if (($_FILES['policeVerification']['name'] != "")){
        $policeFile = $target_dir."policeVerification"."_".$passportNum.".".$ext;
    }else{
        $policeFile = '';
    }

    if (($_FILES['photoFile']['name'] != "")){
        $photoFile = $target_dir_photo."photo"."_".$passportNum.".".$photo_ext; 
    }else{
        $photoFile = '';
    }

    if (($_FILES['passportScan']['name'] != "")){
        $passportFile = $passport_target_dir."passport"."_".$passportNum.".".$passport_ext; 
    }else{
        $passportFile = '';
    }   

    if (($_FILES['departureSealFile']['name'] != "")){
        $departureSeal = 'yes';
        $departureSealFile = $departureSeal_target_dir."departureSeal"."_".$passportNum.".".$departureSeal_ext; 
    }else{
        $departureSeal = 'no';
        $departureSealFile = '';
    }  
    if (($_FILES['arrivalSealFile']['name'] != "")){
        $arrivalSeal = 'yes'; 
        $arrivalSealFile = $arrivalSeal_target_dir."arrivalSeal"."_".$passportNum.".".$arrivalSeal_ext; 
    }else{
        $arrivalSeal = 'no';
        $arrivalSealFile = '';
    }  
    if (($_FILES['oldVisaFile']['name'] != "")){
        $oldVisa = 'yes'; 
        $oldVisaFile = $oldVisa_target_dir."oldVisa"."_".$passportNum.".".$oldVisa_ext; 
    }else{
        $oldVisa = 'no';
        $oldVisaFile = '';
    }  
    if (($_FILES['traningCardFile']['name'] != "")){
        $traningCard = 'yes'; 
        $traningCardFile = $trainingCard_target_dir."trainingCard"."_".$passportNum.".".$trainingCard_ext; 
    }else{
        $traningCard = 'no';
        $traningCardFile = '';
    } 

    
    $result = $conn->query("INSERT INTO passport(passportNum, fName, lName, mobNum, dob, gender, issueDate, validity, departureDate, arrivalDate, jobId, policeClearance, policeClearanceFile, passportPhoto, passportPhotoFile, passportScannedCopy, oldVisa, oldVisaFile, departureSeal, departureSealFile, arrivalSeal, arrivalSealFile, agentEmail, office, manpowerOfficeName, country, trainingCard, trainingCardFile, comment, updatedBy, updatedOn, creationDate) VALUES('$passportNum','$fName','$lName','$mobNum','$dob','$gender','$issuD',$validityYear,'$departureDate','$arrivalDate', $jobType,  '$policeVerification', '$policeFile', '$photo', '$photoFile', '$passportFile', '$oldVisa','$oldVisaFile','$departureSeal','$departureSealFile','$arrivalSeal','$arrivalSealFile', '$agentEmail', '$office', '$manpowerOfficeName','$country', '$traningCard', '$traningCardFile', '$comment','$admin','$date', '$date')");
    if($result){    
        if (($_FILES['policeVerification']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        if (($_FILES['photoFile']['name'] != "")){
            move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
        }
        if (($_FILES['passportScan']['name'] != "")){
            move_uploaded_file($passport_temp_name,$passport_path_filename_ext);
        }
        if (($_FILES['departureSealFile']['name'] != "")){
            move_uploaded_file($departureSeal_temp_name,$departureSeal_path_filename_ext);
        }
        if (($_FILES['arrivalSealFile']['name'] != "")){
            move_uploaded_file($arrivalSeal_temp_name,$arrivalSeal_path_filename_ext);
        }
        if (($_FILES['oldVisaFile']['name'] != "")){
            move_uploaded_file($oldVisa_temp_name,$oldVisa_path_filename_ext);
        }
        if (($_FILES['traningCardFile']['name'] != "")){
            move_uploaded_file($trainingCard_temp_name,$trainingCard_path_filename_ext);
        }
        echo "<script>window.alert('Inserted')</script>";
        // echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        $err = mysqli_error($conn);
        print_r($err);
        echo "<script>window.alert('".$err."')</script>";
        // echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
    }
}


    // $a1 = mysqli_query($conn,"INSERT INTO candidate (fName, lName, fathName, mob, dob, pob, profId, addrs, count, state, city) VALUES ('$fName','$lName','$fathName','$mbNo','$dob','$pob',$profId,'$add','$count','$state','$city')");
    // $qry = "select max(candidateId) as lastCandidate from candidate";
    // $result = mysqli_query($conn, $qry);
    // $tmp = mysqli_fetch_assoc($result);
    // $lastId = $tmp['lastCandidate'];
    // $a2 = mysqli_query($conn,"INSERT INTO passport (passNo, issuPlace, issuDate, expDate, type, candidateId) VALUES ('$passNo','$issuPlace','$issuDate','$expDate','$type',$lastId)");
    // if ($a1 and $a2) {
    //     mysqli_query($conn,"COMMIT");
    //     echo "<script>window.alert('Saved')</script>";
    //     echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    // } else {
    //     mysqli_query($conn,"ROLLBACK");
    //     echo "<script>window.alert('Error')</script>";
    //     echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
    // }
//    try {
//        // First of all, let's begin a transaction
//        $qry->beginTransaction();
//
//        // A set of queries; if one fails, an exception should be thrown
//        $qry->query("INSERT INTO candidate (fName, lName, fathName, mob, dob, pob, profId, addrs, count, state, city) VALUES ('$fName','$lName','$fathName','$mbNo','$dob','$pob',$profId,'$add','$count','$state','$city')");
//        $last_id = $qry->insert_id;
//        $qry->query("INSERT INTO passport (passNo, issuPlace, issuDate, expDate, type, candidateId) VALUES ('$passNo','$issuPlace','$issuDate','$expDate','$type',$last_id)");
//        // If we arrive here, it means that no exception was thrown
//        // i.e. no query has failed, and we can commit the transaction
//        $qry->commit();
//        echo "<script>window.alert('Saved')</script>";
//        echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
//    } catch (\Throwable $e) {
//        // An exception has been thrown
//        // We must rollback the transaction
//        $qry->rollback();
//
//        echo "<script>window.alert(".$e->getMessage().")</script>";
//        echo "<script> window.location.href='../index.php'</script>";
//    }
//    $rslt = mysqli_query($conn,$qry);
//    if($rslt){
//        $qry = "select candidateId from candidate where mob = $mbNo";
//        $result = mysqli_query($conn,$qry);
//        $candidate = mysqli_fetch_assoc($result);
//        $candidateId = $candidate['candidateId'];
//        $qry = "INSERT INTO passport VALUES ('$passNo','$issuPlace','$issuDate','$expDate','$type',$candidateId)";
//        $result = mysqli_query($conn,$qry);
//        echo "<script>window.alert('Saved')</script>";
//        echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
//    }else{
//        echo "<script>window.alert('Error')</script>";
//        echo "<script> window.location.href='../index.php'</script>";
//    }
// }



