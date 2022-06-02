<?php
require "Header.php"
?>
<main>
    <div class="d-flex align-items-center flex-column p-3">
        <section>
            <h3 class="h3 mb-3" style="text-align: center">New Admin</h3>
            <form role="form" action="include/signup_admin.inc.php" method="post">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Username: </label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="uid" placeholder="Username"
                               value="<?php echo (isset($_GET["uid"]))? $_GET["uid"]:null;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">First Name: </label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="fname" placeholder="First Name"
                               value="<?php echo (isset($_GET["fname"]))? $_GET["fname"]:null;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Last Name: </label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="lname" placeholder="Last Name"
                               value="<?php echo (isset($_GET["lname"]))? $_GET["lname"]:null;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Password: </label>
                    <div class="col-sm-7">
                        <input class="form-control" type="password" name="pwd" placeholder="Password">                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Repeat Password: </label>
                    <div class="col-sm-7">
                        <input class="form-control" type="password" name="pwd_repeat" placeholder="Repeat Password" >
                    </div>
                </div>
                <button class="btn btn-large btn-success btn-block m-0" type="submit" name="signup_submit">Add New Admin</button>
            </form>
            <div class="d-flex align-items-center flex-column p-3">
                <?php
                if(isset($_GET["error"])) {
                    if($_GET["error"] == "emptyfields") {
                        echo '<p class="text-warning">Please fill in all the fields.</p>';
                    }elseif($_GET["error"] == "invaliduid") {
                        echo '<p class="text-warning">Invalid Username</p>';
                    }elseif($_GET["error"] == "passworderror") {
                        echo '<p class="text-warning">Make sure the repeated password matches the password</p>';
                    }elseif($_GET["error"] == "usertaken") {
                        echo '<p class="text-warning">Username taken, please choose another username</p>';
                    }
                }elseif(isset($_GET["signup"])) {
                    if($_GET["signup"] == "success") {
                        echo '<p class="text-success">Success</p>';
                    }
                }
                ?>
            </div>
        </section>
    </div>
</main>

<?php
require "Footer.php";
?>
