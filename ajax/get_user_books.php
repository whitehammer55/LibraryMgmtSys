<?php
require_once '../common/global_constants.php';

$user_id = $_REQUEST['user_id'];
$_SESSION['latest_user_reissued'] = $user_id;


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "wdl";


$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($mysqli->connect_errno){
   echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
   die;
}

// Select the data
$sql = "SELECT b.BookID, b.Title, b.DOI, b.DOR, b.reissue_count FROM Books b JOIN Users u ON b.UserID = u.UserID ";

$sql .= " WHERE b.UserID = '$user_id'";
// TODO: Change 101 to uid from user


$result = $mysqli->query($sql);
if(!$result){
    echo "select wrong";
}


for($i = 0; $i < $result->num_rows; $i++){
    $result->data_seek($i);
    $row = $result->fetch_assoc();

    $reissue_id = "reissue_" . $row['BookID'];
    $return_id = "return_" . $row['BookID'];
    ?>

    <tr>
        <td><?= $row['BookID'] ?></td>
        <td><?= $row['Title'] ?></td>
        <td><?= $row['DOI'] ?></td>
        <td><?= $row['DOR'] ?></td>
        <td><?= $row['reissue_count'] ?></td>
        <td>
            <input type="checkbox" name="<?= $reissue_id ?>" value="1"
            <?php if ($row['reissue_count'] == 3
                     || date("Y-m-d") > $row['DOR']) {
                // Disable checkbox if reissue_count >= 3
                // Or if today is past reissue date
            
                echo "disabled";
            }  
            ?>
            >
        </td>
        <td>
            <input type="checkbox" name="<?= $return_id ?>" value="1"
            <?php
            // Commenting this section, since if return date is crossed,
            // then employee will take fine and then press return
            // Hence, no need to disable the return button
            //
            //  if(date("Y-m-d") > $row['DOR']){
            //     echo "disabled";
            // }
            ?>
            >
        </td>
        <td>
            <?php 
            $date_return = new DateTime($row['DOR']);
            $date_today = new DateTime(date("Y-m-d"));

            $interval = $date_return->diff($date_today);
            // today - DOR

            if($interval->invert == 1){
                // negative difference
                echo "0.0";
            } else {
                // positive difference ie return date has been passed

                $fine = $interval->d * 2;
                // Rs 2 fine per day after return date
                echo $fine . ".0";
            }

            ?>
        </td>

    </tr>

    <?php
}// for loop
?>