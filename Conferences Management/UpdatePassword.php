<?php
require "Header.php"
?>
<main>
    <div>
        <section>
            <h2>New Password</h2>
            <?php
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyfields") {
                    echo '<p>Please fill in all the fields.</p>';
                }elseif($_GET["error"] == "passworderror") {
                    echo '<p>Make sure the repeated password matches the password</p>';
                }elseif($_GET["error"] == "wrongpwd") {
                    echo '<p>Wrong Password!!</p>';
                }
            }elseif(isset($_GET["edit"])) {
                if($_GET["edit"] == "success") {
                    echo '<p>Success</p>';
                }
            }
            ?>
            <form action="include/update_password.inc.php" method="post">
                <p>Enter current password please</p>
                <input type="password" name="current_pwd" placeholder="Password">
                <p>Enter new password please</p>
                <input type="password" name="new_pwd" placeholder="Password">
                <input type="password" name="new_pwd_repeat" placeholder="Repeat Password" >
                <button type="submit" name="update_pwd_submit">Change</button>
            </form>
        </section>
    </div>
</main>

<?php
require "Footer.php";
?>
