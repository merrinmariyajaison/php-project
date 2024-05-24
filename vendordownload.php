<?php 
 
// Load the database configuration file 
require_once('connection.php');
session_start(); 



// Fetch records from database 

$sql="SELECT * FROM tbl_vendor ";
$query=mysqli_query($conn,$sql);



 
if($query){ 
    $delimiter = ","; 
    $filename = "vendor-data" . date('Y-m-d') . ".csv"; 

    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Vendor Id', 'Staff ID', 'Vendor Name', 'Email', 'Phone Number','BNo','City','District','Pin Code','Status'); 
    fputcsv($f, $fields, $delimiter); 

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 

        
        $lineData = array($row['Vendor_id'], $row['Staff_id'], $row['V_Name'],  $row['V_PhNo'], $row['V_Email'], $row['V_BNo'], $row['V_Street'], $row['V_Dist'], $row['V_pin'], $row['V_Status']); 
        fputcsv($f, $lineData, $delimiter); 
    } 

    // Move back to beginning of file 
    fseek($f, 0); 

    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>