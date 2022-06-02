<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="container" style="display: flex; flex-direction: row;">
    <div style="margin: 10px; width: 35vw;">
        <h6 class="m-0 p-1 text-center bg-dark text-light">Pending Journals</h6>
        <div style="overflow-y: auto; height: 25vh;">
        <table id="pending" class="table table-striped" >
            <thead>
                <th class='p-1' scope="col" style="">Title</th>
                <th class='p-1' scope="col" style="">Date</th>
            </thead>
            <tbody >
            <?php
                require "PendingJournals.php";
            ?>
            </tbody>
        </table>
        </div>
        <br/>
        <h6 class="m-0 p-1 text-center bg-dark text-light"">Pending Conferences</h6>
        <div style="overflow-y: auto; height: 25vh;">
        <table class="table table-striped">
            <thead>
                <th class='p-1' scope="col">Title</th>
                <th class='p-1' scope="col">Date Created</th>
                <th class='p-1' scope="col">Date Scheduled</th>
            </thead>
            <tbody>
            <?php
                require "PendingConferences.php";
            ?>
            </tbody>
        </table>
        </div>
    </div>
    <div style="margin: 10px; width:30vw;">
        <h6 class="m-0 p-1 text-center bg-dark text-light">Journals</h6>
        <div style="overflow-y: auto; height: 57vh;">
        <table class="table table-striped">
            <thead>
                <th class='p-1' scope="col">Title</th>
                <th class='p-1' scope="col">Date</th>
            </thead>
            <tbody>
            <?php
                require "JournalsDisplay.php";
            ?>
            </tbody>
        </table>
        <?php
            if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] === "User") {
                echo '<p class="text-muted font-italic" style="font-size: 10px">* You reviewed the journal.</p>';
            }
        ?>
        </div>
    </div>
    <div style="margin: 10px; width:35vw;">
        <h6 class="m-0 p-1 text-center bg-dark text-light">Conferences</h6>
        <div style="overflow-y: auto; height: 57vh; ">
        <table class="table table-striped">
            <thead>
            <th class='p-1' scope="col">Title</th>
            <th class='p-1' scope="col">Date</th>
            </thead>
            <tbody class="r-text">
            <?php
                require "ConferencesDisplay.php";
                ?>
            </tbody>
        </table>
        <?php
        if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] === "User") {
            echo '
            <p class="text-muted font-italic m-0" style="font-size: 10px">J - Your journal was featured in the conference.</p>
            <p class="text-muted font-italic m-0" style="font-size: 10px">H - You are the host of the conference.</p>
            <p class="text-muted font-italic m-0" style="font-size: 10px">J&H - You are the host of the conference and your journal was featured in the conference.</p>
        ';
        }
        ?>

        </div>
    </div>
</div>