<?php
include ('database.php');
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if(isset($_POST['advanceId'])){
    $advanceId = $_POST['advanceId'];
}else{
    $advanceId = -1;
}
if(isset($_POST['expenseId'])){
    $expenseId = $_POST['expenseId'];
}else{
    $expenseId = -1;
}
if(isset($_POST['advanceId'])){
    $advanceId = $_POST['advanceId'];
}else{
    $advanceId = -1;
}
$passportNum = $_POST['passportNum'];
if($alter == 'delete'){
    if($expenseId > 0){
        $result = $conn->query("DELETE from candidateexpense where expenseId = $expenseId");
        if($result){
            echo "<script> window.location.href='../index.php?page=ce&pn=".base64_encode($passportNum)."'</script>";
        }else{
            echo mysqli_error($conn);
        }
    }else if($advanceId > 0){
        $result = $conn->query("DELETE from advance where advanceId = $advanceId");
        if($result){
            echo "<script> window.location.href='../index.php?page=ce&pn=".base64_encode($passportNum)."'</script>";
        }else{
            echo mysqli_error($conn);
        }
    }
    
}else{
    $visaNo = $_POST['visaNo'];
    $agentEmail = $_POST['agentEmail'];
    $fullAmount = $_POST['fullAmount'];
    $purpose = $_POST['purpose'];
    if(isset($_POST['comission_id'])){
        $comission_id_existing = $_POST['comission_id'];
    }else{
        $comission_id_existing = -1;
    }
    if(isset($_POST['advance'])){
        $advance = $_POST['advance'];
    }else{
        $advance = 0;
    }
    if(isset($_POST['paydate'])){
        $paydate = $_POST['paydate'];
    }else{
        $paydate = '';
    }
    $comment = $_POST['comment'];
    $paymentMethod = $_POST['paymentMethod'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    $create_date = date("Y-m-d H:i:s");
    if($purpose == 'Comission'){
        if($alter == 'update'){
            $result = $conn->query("UPDATE advance set advanceAmount = $advance, payDate = '$paydate', advancePayMode = '$paymentMethod', updatedBy = '$admin', updatedOn = '$date' where advanceId = $advanceId");
        }else{
            if($comission_id_existing > 0){                
                $result = $conn->query("INSERT INTO advance(advanceAmount, payDate, advancePayMode, comissionId, updatedBy, updatedOn) VALUES ($advance, '$paydate', '$paymentMethod', $comission_id_existing, '$admin', '$date')");
            }else{
                $result = $conn->query("INSERT INTO agentcomission(amount, passportNum, agentEmail, comment, creationDate, updatedBy, updatedOn) VALUES ($fullAmount, '$passportNum', '$agentEmail',  '$comment', '$create_date', '$admin', '$date')");
                $comissionId = mysqli_fetch_assoc($conn->query("SELECT max(comissionId) as comissionId from agentcomission"));
                $result = $conn->query("INSERT INTO advance(advanceAmount, payDate, advancePayMode, comissionId, updatedBy, updatedOn) VALUES ($advance, '$paydate', '$paydate', ".$comissionId['comissionId'].", '$admin', '$date')");
            } 
        }           
    }else{
        if($alter == 'update'){
            $result = $conn->query("UPDATE candidateexpense set amount = $fullAmount, payMode = '$paymentMethod', updatedBy = '$admin', updatedOn = '$date', comment = '$comment' where expenseId = $expenseId");
        }else{
            $result = $conn->query("INSERT INTO candidateexpense(amount, purpose, payMode, passportNum, sponsorVisa, agentEmail, creationDate, updatedBy, updatedOn, comment) VALUES ($fullAmount, '$purpose', '$paymentMethod', '$passportNum', '$visaNo', '$agentEmail', '$create_date', '$admin', '$date', '$comment')");
        }
    }

    if($result){
        echo "<script> window.location.href='../index.php?page=ce&pn=".base64_encode($passportNum)."'</script>";
    }else{
        echo mysqli_error($conn);
    }   
}

