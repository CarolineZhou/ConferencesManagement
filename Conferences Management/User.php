<?php
    require "Header.php";
    require "include/db.inc.php";
?>

<main>
    <div class="d-flex align-items-center flex-column p-3">
    <?php
        if(isset($_SESSION["account_uid"]) && isset($_SESSION["account_fname"]) && isset($_SESSION["account_lname"])) {
            echo "
            <div class='d-flex align-items-center flex-column p-3'>
                <h3>
                    ".$_SESSION["account_fname"]." ".$_SESSION["account_lname"]."
                </h3>";
                    require 'EditUserInfo.php';"             
            </div>
            ";
            require "User/UserPageDisplay.php";
        }else {
            echo "Please Login First.";
        }
        ?>
    </div>
</main>

<?php
    require "Footer.php";
?>
