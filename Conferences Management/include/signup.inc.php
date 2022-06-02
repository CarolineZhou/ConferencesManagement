<?php

if(isset($_POST["signup_submit"])) {
    // get connection for the db
    require "db.inc.php";

    $uid = $_POST["uid"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["pwd_repeat"];
    $type = "User";
    $date = "";

    // compute date info
    $date_info = getdate(date("U"));
    $date = $date_info["year"]."-".$date_info["mon"]."-".$date_info["mday"];

    // error handlers
    if(empty($uid) || empty($fname) || empty($lname) || empty($pwd) || empty($pwd_repeat)) {
        header("Location: ../Signup.php?error=emptyfields&uid=".$uid."&fname=".$fname."&lname=".$lname);
        exit();
    }elseif(!preg_match("/^[a-zA-Z0-9]+$/", $uid)) {
        header("Location: ../Signup.php?error=invaliduid&fname=".$fname."&lname=".$lname);
        exit();
    }elseif(strlen($pwd) < 6){
        header("Location: ../Signup.php?error=shortpwd&uid=".$uid."&fname=".$fname."&lname=".$lname);
        exit();
    }elseif($pwd !== $pwd_repeat) {
        header("Location: ../Signup.php?error=passworderror&uid=".$uid."&fname=".$fname."&lname=".$lname);
        exit();
    }else {
        $sql = "SELECT account_uid FROM account WHERE account_uid=?;";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../Signup.php?error=sqlerror1");
            exit();
        }else {
            mysqli_stmt_bind_param($statement, "s", $uid);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $result = mysqli_stmt_num_rows($statement);
            if($result > 0) {
                // user already exist in the db
                header("Location: ../Signup.php?error=usertaken&uid=".$uid."&fname=".$fname."&lname=".$lname);
                exit();
            }else {
                $sql = "INSERT INTO account (account_uid, account_pw, account_fname,
                        account_lname, account_type, account_date_created) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $statement = mysqli_stmt_init($conn);
                // ensure the above statement actually works inside the db
                if(!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../Signup.php?error=sqlerror2");
                    exit();
                }else {
                    //hash the password
                    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($statement, "ssssss", $uid, $hashed_pwd, $fname, $lname, $type, $date);
                    mysqli_stmt_execute($statement);
                    header("Location: ../Signup.php?signup=success");
                    exit();
                }
            }
        }
        mysqli_stmt_close($statement);
        mysqli_close($conn);
    }

}else{
    header("Location: ../Index.php");
    exit();
}