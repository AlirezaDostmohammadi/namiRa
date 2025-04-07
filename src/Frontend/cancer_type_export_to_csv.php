<?php 

require_once("../Backend/config.php");

// SQL query to select all from your table
$result_cancer = mysqli_query($conn,$sql_cancer);

if (mysqli_num_rows($result_cancer) > 0) {
    // Define the filename with a .csv extension
    $filename = "cancer_list.csv";
    
    // Set headers to force download on browser
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Open a file in write mode ('w')
    $output = fopen('php://output', 'w');
    
    // Optional: Add UTF-8 BOM for Excel compatibility
    fputs($output, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    
    // Fetch associative array and get column names for CSV headers
    $row = mysqli_fetch_assoc($result_cancer);
    $headers = array('Index', 'Cancer Type');
    fputcsv($output, $headers);
    
    // Put the first row data
    $cnt = 1;
    
    fputcsv($output, array($cnt, $row['cancer_type']));
    $cnt += 1;
    
    // Output the rest of the data
    while ($row = mysqli_fetch_assoc($result_cancer)) {
        fputcsv($output, array($cnt, $row['cancer_type']));
        $cnt += 1;
    }
    
    fclose($output);
} else {
    echo "No records found.";
}

?>