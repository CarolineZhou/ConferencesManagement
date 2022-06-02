<?php

if(isset($_POST["signup_submit"])) {
    // get connection for the db
    require "db.inc.php";
    session_start();

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
        header("Location: ../UpdateAccount.php?error=emptyfields&uid=".$uid."&fname=".$fname."&lname=".$lname);
        exit();
    }elseif(!preg_match("/^[a-zA-Z0-9]+$/", $uid)) {
        header("Location: ../UpdateAccount.php?error=invaliduid&fname=".$fname."&lname=".$lname);
        exit();
    }elseif($pwd !== $pwd_repeat) {
        header("Location: ../UpdateAccount.php?error=passworderror&uid=".$uid."&fname=".$fname."&lname=".$lname);
        exit();
    }else {
        $sql = "SELECT * FROM account WHERE account_uid=?;";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../UpdateAccount.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($statement, "s", $_SESSION["account_uid"]);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if($row = mysqli_fetch_assoc($result)) {
                $pwd_check = password_verify($pwd, $row["account_pw"]);
                if($pwd_check == false) {
                    header("Location: ../UpdateAccount.php?error=wrongpwd&uid=".$_SESSION["account_uid"]);
                    exit();
                }elseif ($pwd_check == true) {
                    $sql = "UPDATE account 
                        SET account_uid=?, account_fname=?, account_lname=?
                        WHERE account_uid=?";
                    $statement = mysqli_stmt_init($conn);
                    // ensure the above statement actually works inside the db
                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        header("Location: ../UpdateAccount.php?error=sqlerror2");
                        exit();
                    }else {
                        mysqli_stmt_bind_param($statement, "ssss", $uid, $fname, $lname, $_SESSION["account_uid"]);
                        $result = mysqli_stmt_execute($statement);
                        if($result === True) {
                            //also update the session info
                            echo "success";
                            $_SESSION["account_uid"] = $uid;
                            $_SESSION["account_fname"] = $fname;
                            $_SESSION["account_lname"] = $lname;
                            header("Location: ../UpdateAccount.php?edit=success");
                            exit();
                        }else {
                            header("Location: ../UpdateAccount.php?error=tryagain");
                            exit();
                        }
                    }
                }else {
                    header("Location: ../UpdateAccount.php?error=wrongpwd");
                    exit();
                }
            }else {
                header("Location: ../UpdateAccount.php?error=nouser");
                exit();
            }
        }
        mysqli_stmt_close($statement);
        mysqli_close($conn);
    }
}else{
    header("Location: ../UpdateAccount.php");
    exit();
}