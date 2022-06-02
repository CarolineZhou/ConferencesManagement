<?php

if(isset($_POST["update_pwd_submit"])) {
    require "db.inc.php";
    session_start();

    $uid = $_SESSION["account_uid"];
    $current_pwd = $_POST["current_pwd"];
    $new_pwd = $_POST["new_pwd"];
    $new_pwd_repeat = $_POST["new_pwd_repeat"];

    if(empty($current_pwd) || empty($new_pwd) || empty($new_pwd_repeat)) {
        header("Location: ../UpdatePassword.php?error=emptyfields");
        exit();
    }elseif($new_pwd !== $new_pwd_repeat) {
        header("Location: ../Signup.php?error=passworderror");
        exit();
    }else {
        $sql = "SELECT * FROM account WHERE account_uid=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../UpdatePassword.php?error=sqlerror");
            exit();
        }else {
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $pwd_check = password_verify($current_pwd, $row["account_pw"]);
                if($pwd_check == false) {
                    header("Location: ../UpdatePassword.php?error=wrongpwd");
                    exit();
                }elseif ($pwd_check == true) {
                    // update password in db
                    $sql = "UPDATE account 
                            SET account_pw=?
                            WHERE account_uid=?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../UpdatePassword.php?error=sqlerror");
                        exit();
                    }else {
                        $hashed_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "ss", $hashed_pwd, $uid);
                        $result = mysqli_stmt_execute($stmt);
                        if($result === True) {
                            header("Location: ../UpdatePassword.php?edit=success");
                            exit();
                        }else {
                            header("Location: ../UpdatePassword.php?edit=unsuccess");
                            exit();
                        }
                    }

                }else {
                    header("Location: ../UpdatePassword.php?error=wrongpwd");
                    exit();
                }
            }else {
                header("Location: ../UpdatePassword.php?error=nouser");
                exit();
            }
        }
    }

}else {
    header("Location: ../UpdatePassword.php");
    exit();
}