<?php
require "include/db.inc.php";
$uid = $_SESSION["account_uid"];
if(isset($uid) && isset($_SESSION["account_type"])) {
    if($_SESSION["account_type"] === "Admin") {
        // display all journals that's waiting for admin's approval
        // from the newest to the oldest
        // get id value from account
        $sql = "SELECT *
                FROM conference
                WHERE conf_status=0;";
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
                    <td class='p-1'>No pending conferences</td>
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
        if($id !== 0) {
            $sql = "SELECT *
                    FROM conference
                    WHERE conf_host_id='$id' AND conf_status IN (0,2);";
            $result = mysqli_query($conn, $sql);
            $result_num = mysqli_num_rows($result);
            if ($result_num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $conf_id = $row["conf_id"];
                    $conf_name = $row["conf_name"];
                    $conf_date_created = substr($row["conf_date_created"],0,10);
                    $conf_date_scheduled = substr($row["conf_date_scheduled"],0,10);
                    $status = $row["conf_status"];
                    if($status == 2) {
                        echo "
                        <tr>
                            <td ><a class='text-danger' href='ConferenceDetails.php?confid=$conf_id'>$conf_name (Denied)</a></td>
                            <td>$conf_date_created</td>
                            <td>$conf_date_scheduled</td>
                        </tr>
                    ";
                    }else {
                        echo "
                        <tr>
                            <td ><a href='ConferenceDetails.php?confid=$conf_id'>$conf_name</a></td>
                            <td>$conf_date_created</td>
                            <td>$conf_date_scheduled</td>
                        </tr>
                    ";
                    }
                }
            }else {
                echo "<tr>
                        <td class='p-1'>No Pending Conferences</td>
                        <td class='p-1'></td>
                        <td class='p-1'></td>
                      </tr>";
            }

        }
    }
}
?>