<?php 

require_once("../Backend/config.php");

// SQL query to select all from your table
$result_subscribers = mysqli_query($conn,$sql_subscribers);

if (mysqli_num_rows($result_subscribers) > 0) {
    // Define the filename with a .csv extension
    $filename = "subscribers_list.csv";
    
    // Set headers to force download on browser
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Open a file in write mode ('w')
    $output = fopen('php://output', 'w');
    
    // Optional: Add UTF-8 BOM for Excel compatibility
    fputs($output, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    
    // Fetch associative array and get column names for CSV headers
    $row = mysqli_fetch_assoc($result_subscribers);
    $headers = array('Index', 'Email');
    fputcsv($output, $headers);
    
    // Put the first row data
    $cnt = 1;
    
    fputcsv($output, array($cnt, $row['email']));
    $cnt += 1;
    
    // Output the rest of the data
    while ($row = mysqli_fetch_assoc($result_subscribers)) {
        fputcsv($output, array($cnt, $row['email']));
        $cnt += 1;
    }
    
    fclose($output);
} else {
    echo "No records found.";
}

?>