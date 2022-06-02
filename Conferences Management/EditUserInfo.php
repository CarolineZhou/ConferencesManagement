<a href="UpdateAccount.php">
    Edit Account
</a>

<?php
    if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] === "Admin") {
        echo "         
            <a href='AddNewAdmin.php'>
                Add New Admin
            </a>
        ";
    }
?>