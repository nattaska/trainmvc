<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json; charset=UTF-8");
    
    include('config.ini.php');

    $empcode = -1;
    $v_month = '-1';
    $sql = "";

    if (isset($_GET['empcd'])) {
        $empcode = $_GET['empcd'];
        $month = $_GET['month'];
    }
    
    if ($empcode == -1) {
        $sql = "SELECT empcd code, empnnm name, empphone phone, IFNULL(DATE_FORMAT(timin,'%H:%i'),'-') timin, IFNULL(DATE_FORMAT(timout,'%H:%i'),'-') timout ".
                " FROM employee JOIN payment on (empcd=payempcd and CURRENT_DATE BETWEEN paysdate AND payedate AND paydeptid != 4) ".
                " LEFT JOIN timesheet ON (empcd=timempcd and timdate=CURRENT_DATE) ".
                " ORDER BY empcd";
    } else {

        $sql = "SELECT empcd code, empnnm name, timdate tdate, IFNULL(DATE_FORMAT(timin,'%H:%i'),'-') timin, IFNULL(DATE_FORMAT(timout,'%H:%i'),'-') timout ".
                " FROM employee JOIN payment on (empcd=".$empcode." AND empcd=payempcd and CURRENT_DATE BETWEEN paysdate AND payedate AND paydeptid != 4) ".
                "  JOIN timesheet ON (empcd=timempcd and DATE_FORMAT(timdate,'%Y%m')='".$month."') ".
                " ORDER BY timdate";

    }

    // echo $empcode;
            
    $result = mysqli_query($conn, $sql);

    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    mysqli_close($conn);
    echo json_encode($arr);
?>