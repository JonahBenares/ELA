<?php
	$con=mysqli_connect("localhost","root","","db_emg");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL:".mysqli_connect_error();
	}

	require_once('assets/js/phpexcel/Classes/PHPExcel/IOFactory.php');
	$objPHPExcel = new PHPExcel();
	PHPExcel_Style_NumberFormat::toFormattedString(39984,PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
    $inputFileName =realpath('uploads/mpi.xls');
	 try {
	        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	        //echo $inputFileType;
	        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	        $objPHPExcel = $objReader->load($inputFileName);
	    } 
	    catch(Exception $e) {
	        die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	    }
	    $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); 
	    $upload = date('Y-m-d H:i:s');
	    for($x=4;$x<=$highestRow;$x++){
	    	$interval= date('Y-m-d H:i', PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('A'.$x)->getValue()));
	    	$price_node = $objPHPExcel->getActiveSheet()->getCell('B'.$x)->getValue();
	    	$mw = $objPHPExcel->getActiveSheet()->getCell('C'.$x)->getValue();
	    	$lmp = $objPHPExcel->getActiveSheet()->getCell('D'.$x)->getValue();
	    	$loss_factor = $objPHPExcel->getActiveSheet()->getCell('E'.$x)->getValue();
	    	
	    	$selecttime = $con->query("SELECT interval_time FROM rtd_info WHERE interval_time = '$interval'");
	    	$rows = $selecttime->num_rows;
	    	if($rows<5){
	    		$insert=$con->query("INSERT INTO rtd_info(interval_time,price_node,megawatts,lmp,loss_factor,upload_time) VALUES ('$interval','$price_node','$mw','$lmp','$loss_factor','$upload')");
	    	}
		}
	//echo $highestRow;
?>