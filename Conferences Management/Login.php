<?php
require "Header.php";
?>
<?php
    if(isset($_SESSION["account_uid"])) {
        header("Location: Index.php");
    }
?>
<div class="d-flex align-items-center flex-column p-3">
    <div class="p-2">
        <form role="form" action="include/login.inc.php" method="post">
            <h1 class="h3 mb-3" style="text-align: center"> Login</h1>

            <input class="form-control m-1" type="text" name="uid" placeholder="Username"
                   value="<?php echo (isset($_GET["uid"]))? $_GET["uid"]:null;?>">
            <input class="form-control m-1" type="password" name="pwd" placeholder="Password" >
            <button class="btn btn-large btn-success btn-block m-1" type="submit" name="login_submit"><i class="fas fa-sign-in-alt"></i>Login</button>
            <a class="m-1" href="Signup.php">Sign Up?</a>
            <h6 style="text-align: center">
            <?php
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyfields") {
                    echo '<p class="text-warning">Please enter both fields!</p>';
                }elseif($_GET["error"] == "wrongpwd") {
                    echo '<p class="text-warning">Wrong password!</p>';
                }elseif($_GET["error"] == "nouser") {
                    echo '<p class="text-warning">Invalid username!</p>';
                }
            }
            ?>
            </h6>
        </form>
    </div>
</div>

<?php
require "Footer.php";
?>
</html>