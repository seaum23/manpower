<?php
include ('database.php');
if(isset($_POST['mode'])){
    $mode = $_POST['mode'];
    if($mode == 'testMedical'){
        $passportMedical = $_POST['passportMedical'];
        if (($_FILES['testMedical']['name'] != "")){
            // Where the file is going to be stored
            $target_dir = "uploads/medical/";
            $file = $_FILES['testMedical']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['testMedical']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."testMedical"."_".$passportMedical.".".$ext;
        }
        $testPath = $target_dir."testMedical"."_".$passportMedical.".".$ext;
        print_r("UPDATE passport set testMedical = 'yes', testMedicalFile = '$testPath' where passportNum = '$passportMedical'");
        $result = $conn->query("UPDATE passport set testMedical = 'yes', testMedicalFile = '$testPath' where passportNum = '$passportMedical'");
        if($result){
            if (($_FILES['testMedical']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            // echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }        
    }else if($mode == 'finalMedical'){
        $passportMedicalFinal = $_POST['passportMedicalFinal'];
        if (($_FILES['finalMedical']['name'] != "")){
            // Where the file is going to be stored
            $target_dir = "uploads/medical/";
            $file = $_FILES['finalMedical']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['finalMedical']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."finalMedical"."_".$passportMedicalFinal.".".$ext;
        }
        $testPath = $target_dir."finalMedical"."_".$passportMedicalFinal.".".$ext;
        $result = $conn->query("UPDATE passport set finalMedical = 'yes', finalMedicalFile = '$testPath' where passportNum = '$passportMedicalFinal'");
        if($result){
            if (($_FILES['finalMedical']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        } 
    }
}