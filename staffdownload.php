<?php 
 
// Load the database configuration file 
require_once('connection.php');
session_start(); 



// Fetch records from database 

$sql="SELECT * FROM tbl_staff ";
$query=mysqli_query($conn,$sql);



 
if($query){ 
    $delimiter = ","; 
    $filename = "staff-data" . date('Y-m-d') . ".csv"; 

    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 

    // Set column headers 
    $fields = array('Staff Id', 'Username', 'First Name', 'Last Name', 'Phone Number','House','Street','District','Pin Code','Status'); 
    fputcsv($f, $fields, $delimiter); 

    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 

        $user=$row['Username'];

        $sql_login = "SELECT * FROM tbl_login WHERE Username='$user'";
        $login_exe=mysqli_query($conn,$sql_login);
        $login=mysqli_fetch_assoc($login_exe);

        $lineData = array($row['Staff_id'], $row['Username'], $row['S_FName'], $row['S_LName'], $row['S_PhNo'], $row['S_HNo'], $row['S_Street'], $row['S_Dist'], $row['S_Pin'], $login['L_Status']); 
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