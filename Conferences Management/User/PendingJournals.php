<?php
require "include/db.inc.php";
$uid = $_SESSION["account_uid"];
if(isset($uid) && isset($_SESSION["account_type"])) {
    if($_SESSION["account_type"] === "Admin") {
        // display all journals that's waiting for admin's approval
        // from the newest to the oldest
        // get id value from account
        $sql = "SELECT *
                FROM journal
                WHERE journal_status=0;";
        $result = mysqli_query($conn, $sql);
        $result_num = mysqli_num_rows($result);
        if ($result_num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $journal_DOI = $row["journal_DOI"];
                $journal_title = $row["journal_title"];
                $journal_date = substr($row["journal_publish"],0,10);
                echo "
                        <tr>
                            <td class='p-1'><a href='DisplayJournal.php?journal_DOI=$journal_DOI'>$journal_title</a></td>
                            <td class='p-1'>$journal_date</td>
                        </tr>
                    ";
            }
        }else {
            echo "
                <tr>
                    <td class='p-1'>No pending journals</td>
                    <td class='p-1'></td>
                </tr>
            ";
        }
    }elseif($_SESSION["account_type"] === "User") {
        // display all journals the user submitted
        // and currently waiting for approval from admin
        // from the newest to the oldest
        $sql = "SELECT account_id
                FROM account
                WHERE account_uid='$uid';";
        $result = mysqli_query($conn, $sql);
        $id = 0;

        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["account_id"];
            break;
        }

        if($id !== 0) {
            $sql = "SELECT j.journal_id as DOI, j.journal_title as title, j.journal_publish as date, j.status as status
                    FROM journal_authors as ja  
                    LEFT JOIN journal as j 
                    ON ja.journal_id = j.journal_DOI
                    WHERE ja.authors_id=$id AND j.journal_status IN (0,2);";
            $result = mysqli_query($conn, $sql);
            // check if any article matched the whole search value
            if($result && mysqli_num_rows($result) > 0) {
                // display result
                while($row = mysqli_fetch_assoc($result)) {
                    $DOI = $row["DOI"];
                    $title = $row["title"];
                    $date = substr($row["date"],0,10);
                    $status = $row["status"];
                    if($status == 2) {
                        echo "
                        <tr>
                            <td class='p-1'><a class='text-danger' href='DisplayJournal.php?journal_DOI=$DOI'>$title (Denied)</a></td>
                            <td class='p-1'>$date</td>
                        </tr>
                    ";
                    }else {
                        echo "
                        <tr>
                            <td class='p-1'><a href='DisplayJournal.php?journal_DOI=$DOI'>$title</a></td>
                            <td class='p-1'>$date</td>
                        </tr>
                    ";
                    }
                }
            }
            else {
                echo "
                            <tr>
                                <td class='p-1'>No Pending Journals</td>
                                <td class='p-1'></td>
                            </tr>
                        ";
            }
        }
    }
}
?>