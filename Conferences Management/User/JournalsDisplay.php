<?php
// For Admins
    // Display all approved journals
// For Users
    // Display all approved journals by the current user
    // from the newest to the oldest
$uid = $_SESSION["account_uid"];
if(isset($uid) && isset($_SESSION["account_type"])) {
    if($_SESSION["account_type"] === "Admin") {
        // display all journals that's waiting for admin's approval
        // from the newest to the oldest
        // get id value from account
        $sql = "SELECT * 
                FROM journal
                WHERE journal_status=1 
                ORDER BY journal_publish DESC;";

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
                    <td class='p-1'>No journals</td>
                    <td class='p-1'></td>
                </tr>
            ";
        }
    }elseif($_SESSION["account_type"] === "User") {
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
            $sql = "SELECT j1.journal_DOI, j1.journal_title AS link_title, j1.journal_title AS title, j1.journal_publish AS publish_date 
                    FROM `journal` AS j1 
                    LEFT JOIN journal_authors AS ja 
                    ON j1.journal_DOI=ja.journal_id 
                    WHERE ja.authors_id='$id'  AND j1.journal_status=1
                    UNION 
                    SELECT j2.journal_DOI, j2.journal_title AS link_title, concat(j2.journal_title, ' *') AS title, j2.journal_publish AS publish_date 
                    FROM `journal` AS j2 
                    LEFT JOIN journal_reviews AS jr 
                    ON j2.journal_DOI=jr.journal_DOI 
                    WHERE jr.journal_Sreview='$id' AND j2.journal_status=1
                    ORDER BY publish_date DESC;";
            $result = mysqli_query($conn, $sql);
            $result_num = mysqli_num_rows($result);
            // check if any article matched the whole search value
            if($result_num > 0) {
                // display result
                while($row = mysqli_fetch_assoc($result)) {
                    // search journal title by journal_id
                    // and only if the status if pending
                    // then output the info
                    $journal_DOI = $row["journal_DOI"];
                    $journal_link_title = $row["link_title"];
                    $journal_title = $row["title"];
                    $publish_date = substr($row["publish_date"],0,10);
                    echo "
                        <tr>
                            <td class='p-1'><a href='DisplayJournal.php?journal_DOI=$journal_DOI'>$journal_title</a></td>
                            <td class='p-1'>$publish_date</td>
                        </tr>
                    ";
                }
            }else {
                echo "
                    <tr>
                        <td class='p-1'>No journals</td>
                        <td class='p-1'></td>
                    </tr>
                ";
            }
        }else {
            echo "
                <tr>
                    <td class='p-1'>No journals</td>
                    <td class='p-1'></td>
                </tr>
            ";
        }
    }
}