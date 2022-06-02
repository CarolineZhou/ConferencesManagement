<?php
// For Admins
// Display all approved conferences
// For Users
// Display all approved conferences by the current user
// from the newest to the oldest
$uid = $_SESSION["account_uid"];
if(isset($uid) && isset($_SESSION["account_type"])) {
    if($_SESSION["account_type"] === "Admin") {
        // display all journals that's waiting for admin's approval
        // from the newest to the oldest
        // get id value from account
        $sql = "SELECT *
                FROM conference
                WHERE conf_status=1
                ORDER BY conf_date_created DESC;";
        $result = mysqli_query($conn, $sql);
        $result_num = mysqli_num_rows($result);
        if ($result_num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $conf_id = $row["conf_id"];
                $conf_name = $row["conf_name"];
                $conf_date_created = substr($row["conf_date_created"],0,10);
                $conf_date_scheduled = substr($row["conf_date_scheduled"],0,10);
                echo "
                    <tr>
                        <td class='p-1'><a href='ConferenceDetails.php?confid=$conf_id'>$conf_name</a></td>
                        <td class='p-1'>$conf_date_created</td>
                        <td class='p-1'>$conf_date_scheduled</td>
                    </tr>                    
                ";
            }
        }else {
            echo "
                <tr>
                    <td class='p-1'>No conferences</td>
                    <td class='p-1'></td>
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

        if($id != 0) {
            $sql = "SELECT c.conf_id, c.conf_name as link_name, CONCAT(c.conf_name, ' -J') AS name, c.conf_date_scheduled AS date 
                        FROM conference AS c 
                        LEFT JOIN journal AS j 
                            ON c.conf_journal_DOI = j.journal_DOI 
                        LEFT JOIN journal_authors AS ja 
                            ON j.journal_DOI = ja.journal_id 
                        WHERE ja.authors_id = '$id' AND c.conf_host_id <> '$id' AND c.conf_status = 1
                    UNION 
                    SELECT conf_id, conf_name as link_name, CONCAT(conf_name, ' -H') AS name, conf_date_scheduled AS date 
                        FROM conference 
                        WHERE conf_host_id = '$id' AND conf_status = 1 
                            AND conf_id NOT IN 
                                (SELECT c.conf_id 
                                FROM conference AS c 
                                LEFT JOIN journal AS j 
                                    ON c.conf_journal_DOI = j.journal_DOI 
                                LEFT JOIN journal_authors AS ja 
                                    ON j.journal_DOI = ja.journal_id 
                                WHERE ja.authors_id = '$id' AND c.conf_status = 1) 
                    UNION 
                    SELECT c.conf_id, c.conf_name as link_name, CONCAT(c.conf_name, ' -H') AS name, c.conf_date_scheduled AS date 
                        FROM conference as c
                        WHERE c.conf_host_id = '$id' AND c.conf_status = 1 AND c.conf_journal_DOI IS NULL
                    UNION 
                    SELECT c.conf_id, c.conf_name as link_name, CONCAT(c.conf_name, ' -J&H') AS name, c.conf_date_scheduled AS date 
                        FROM conference AS c 
                        LEFT JOIN journal AS j 
                            ON c.conf_journal_DOI = j.journal_DOI 
                        LEFT JOIN journal_authors AS ja 
                            ON j.journal_DOI = ja.journal_id 
                        WHERE ja.authors_id = '$id' AND c.conf_host_id = '$id' AND c.conf_status = 1
                    ORDER BY date DESC;";
            $result = mysqli_query($conn, $sql);
            $result_num = mysqli_num_rows($result);
            if($result_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $conf_id = $row["conf_id"];
                    $link_name = $row["link_name"];
                    $conf_name = $row["name"];
                    $conf_date_scheduled = substr($row["date"],0,10);
                    echo "
                        <tr>
                            <td class='p-1'><a href='ConferenceDetails.php?confid=$conf_id'>$conf_name</a></td>
                            <td class='p-1'>$conf_date_scheduled</td>
                        </tr>                    
                    ";
                }
            }else {
                echo "
                    <tr>
                        <td class='p-1'>No conferences</td>
                        <td class='p-1'></td>
                    </tr>
                ";
            }

        }
    }
}