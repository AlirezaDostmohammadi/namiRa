<?php

// get the API key and cancer name from the request
$api_key = $_GET['api_key'];
$cancer_name = $_GET['cancer'];
$mirna_name = $_GET['mirna'];


// check API key
if (!in_array($api_key, $api_keys)) {
    http_response_code(401);
    exit();
}

// rate limiting per IP address
$ip_address = $_SERVER['REMOTE_ADDR'];
$requests_key = 'requests_' . $ip_address;
$request_count = (int) apcu_fetch($requests_key);
if ($request_count >= $max_requests_per_ip) {
    http_response_code(429);
    exit();
} else {
    apcu_add($requests_key, 1, 60);
}

// construct SQL query
$stmt = $conn->prepare($sql);
$stmt->bindParam(':cancer_name', $cancer_name);

// execute query and return results as JSON
try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
} catch(PDOException $e) {
    http_response_code(500);
    exit();
}
?>
