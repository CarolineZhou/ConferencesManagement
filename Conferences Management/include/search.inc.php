<?php

if(isset($_POST["search_submit"])) {
    require "db.inc.php";

    $type = $_POST["type"];
    $search_value = $_POST["search"];

    // if search value is empty
    if(empty($type) || empty($search_value)) {
        header("Location: ../Index.php?error=emptyfield");
        exit();
    }elseif(!preg_match("/^[a-zA-Z0-9]+$/", $search_value)) {
        header("Location: ../Index.php?error=invalidsearch");
        exit();
    }else {
        header("Location: ../Search.php?status=success&type=".$type."&search=".$search_value);
        exit();
    }
}else {
    header("Location: ../Index.php");
    exit();
}
