<?php

if(isset($_POST["login_submit"])) {
    require "db.inc.php";

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    if(empty($uid) || empty($pwd)) {
        header("Location: ../Login.php?error=emptyfields");
        exit();
    }else {
        $sql = "SELECT * FROM account WHERE account_uid=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../Login.php?error=sqlerror");
            exit();
        }else {
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $pwd_check = password_verify($pwd, $row["account_pw"]);
                if($pwd_check == false) {
                    header("Location: ../Login.php?error=wrongpwd&uid=".$uid);
                    exit();
                }elseif ($pwd_check == true) {
                    session_start();
                    $_SESSION["account_uid"] = $row["account_uid"];
                    $_SESSION["account_id"] = $row["account_id"]; //added by Doc
                    $_SESSION["account_fname"] = $row["account_fname"];
                    $_SESSION["account_lname"] = $row["account_lname"];
                    $_SESSION["account_type"] = $row["account_type"];

                    header("Location: ../Login.php?login=success");
                    exit();
                }else {
                    header("Location: ../Login.php?error=wrongpwd");
                    exit();
                }
            }else {
                header("Location: ../Login.php?error=nouser");
                exit();
            }
        }
    }

}else {
    header("Location: ../Login.php");
    exit();
}