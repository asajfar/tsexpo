<?php
	
session_start();

	// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=ts-expo-baza-export.xls");
 
// Add data table
include 'table.php';

?>