<?php
include ('database.php');
if(isset($_POST['jobs'])){
    if(isset($_POST['alter'])){
        $alter = $_POST['alter'];
    }else{
        $alter = '';
    }
    if($alter == 'delete'){
        $jobId = $_POST['jobId'];
        $result = $conn->query("DELETE from jobs where jobId = $jobId");

        if($result){
            // echo "<script>window.alert('Deleted')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }
    }else{
        $jobType = $_POST['jobType'];
        $admin = $_SESSION['email'];
        $curdate = date("Y-m-d H:i:s");
        //$createDate = date("Y-m-d H:i:s", strtotime('-9 hours', strtotime($curdate)));

        $result = $conn->query("INSERT into jobs (jobType, updatedBy, creationDate) values ('$jobType', '$admin', '$curdate')");

        if($result){
            // echo "<script>window.alert('Added')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }
    }
    
}