<?php
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:*");
    header("Content-Type: application/json; charset=UTF-8");
    
    include('config.ini.php');
	//date_default_timezone_set( "Asia/Bangkok" );

    // Retrieve the posted data
    $json    =  file_get_contents('php://input');
    // echo $json;
    $obj     =  json_decode($json);
    $key     =  strip_tags($obj->key);
	
	//$date = date('Y-m-d', time());	
	//$datetime = date('Y-m-d H:i:s', time());

    // $data['key'] = $key;
    // $data['code'] = $obj->code;
    // $key='update';
    // $code=60001;

    // echo json_encode($data);

    // Determine which mode is being requested
    switch($key)
    {

        // Add a new record to the technologies table
        case "create":

            // Sanitise URL supplied values
            $code 		     = filter_var($obj->code, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

            // Attempt to run PDO prepared statement
            try {
                $sql 	= "INSERT INTO timesheet(timempcd, timdate, timin) VALUES(".$code.", CURRENT_DATE, CURRENT_TIMESTAMP)";
                //$sql 	= "INSERT INTO timesheet(timempcd, timdate, timin) VALUES(".$code.", '".$date."', '".$datetime."')";

                $conn->query($sql);
                // $stmt 	= $conn->prepare($sql);
                // $stmt->bindParam(':code', $code, PDO::PARAM_INT);
                // $stmt->execute();

                echo json_encode(array('message' => 'Congratulations the record ' . $code . ' was added to the database'));
            }
            // Catch any errors in running the prepared statement
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }

        break;

        // Update an existing record in the technologies table
        case "update":

            // Sanitise URL supplied values
            $code 		     = filter_var($obj->code, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

            // Attempt to run PDO prepared statement
            try {
                $sql 	= "UPDATE timesheet SET timout = CURRENT_TIMESTAMP WHERE timempcd = ".$code." AND timdate = CURRENT_DATE";
                //$sql 	= "UPDATE timesheet SET timout = '".$datetime."' WHERE timempcd = ".$code." AND timdate = '".$date."'";

                $conn->query($sql);
                // $stmt 	=	$pdo->prepare($sql);
                // $stmt->bindParam(':code', $code, PDO::PARAM_INT);
                // $stmt->execute();

                echo json_encode('Congratulations the record ' . $code . ' was updated');
            }
            // Catch any errors in running the prepared statement
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }

        break;
    }
?>