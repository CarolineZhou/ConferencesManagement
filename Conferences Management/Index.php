<?php
    require "Header.php";
    require "include/db.inc.php";
?>

<div class="d-flex align-items-center flex-column p-3">
    <!-- Search Bar -->
    <form role="form" action="include/search.inc.php" method="post">
        <h1 class="h3 mb-3" style="text-align: center"> Search </h1>
        <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyfield") {
                echo '<p class="text-warning">Please enter something in order to search!</p>';
            }elseif($_GET["error"] == "invalidsearch") {
                echo '<p class="text-warning">Please only include letters or numbers in the search bar!</p>';
            }
        }elseif (isset($_GET["id"])){
            echo $_GET["id"];
        }
        ?>
        <div class="row m-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="journal" value="journal" checked="checked">
                <label class="form-check-label" for="journal">Journal</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="conference" value="conference">
                <label class="form-check-label" for="conference">Conference</label>
            </div>
        </div>
        <div class="form-group input-group col-md-15">
            <input class="form-control search-query" type="search" name="search" placeholder="Search.." >
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" name="search_submit">
                    <svg width="1.1em" height="1.1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                      <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                </button>
            </span>
        </div>
    </form>
    <br/>
    <!-- Main Articles -->
    <div class="list-group">
        <h6 class="mb-1 text-center">Recent Journals</h6>
            <?php
            $sql = "SELECT * 
                    FROM journal 
                    ORDER BY journal_publish DESC
                    LIMIT 5;";

            if (!mysqli_query($conn, $sql)) {
                echo "
                    <a class='list-group-item list-group-item-action disabled p-2' href='#'>
                        No journals in the system.
                    </a>
                ";
            }else {
                $result = mysqli_query($conn, $sql);
                $result_num = mysqli_num_rows($result);
                // check if any article matched the whole search value
                if($result_num > 0) {
                    // display result
                    while($row = mysqli_fetch_assoc($result)) {
                        $journal_DOI = $row["journal_DOI"];
                        $journal_title = $row["journal_title"];
                        echo "
                        <a class='list-group-item list-group-item-action p-2 ' href='DisplayJournal.php?journal_DOI=$journal_DOI'>
                            $journal_title
                        </a>
                ";
                    }
                }else{
                    echo "
                    <a class='list-group-item list-group-item-action disabled p-2' href='#'>
                        Cannot find any journals matches your search.
                    </a>
                ";
                }
            }
            ?>
    </div>
</div>

<?php
    require "Footer.php";
?>

