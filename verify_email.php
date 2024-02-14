<?php
session_start();
include("dbcon.php");

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $verify_query = "SELECT * FROM `tbl_user` WHERE verify_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_array($verify_query_run);
        $user_type = $row['usertype'];
        
        if($row['verify_status'] == 0) {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE `tbl_user` SET `verify_status`='1' WHERE verify_token='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);
            
            if($update_query_run) {
                $_SESSION["message"] = "Your Account has been verified successfully";
                if($user_type == "customer") {
                    header("Location: login.php");
                } elseif($user_type == "delivery_boy") {
                    header("Location: delivery_boy/wait_for_approval.php");
                } elseif($user_type == "seller") {
                    header("Location: seller/seller_register2.php");
                }
                exit(0);
            } else {
                $_SESSION["message"] = "Verification failed";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION["message"] = "Email Already verified. Please login";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION["message"] = "This token is expired";
        header("Location: login.php");
        exit(0);
    }
} else {
    $_SESSION["message"] = "Not allowed";
    header("Location: login.php");
    exit(0);
}
?>
