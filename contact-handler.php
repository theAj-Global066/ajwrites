<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $data = json_decode(file_get_contents('php://input'), true);
    
    // If data is not JSON, try to get from POST
    if (!$data) {
        $data = $_POST;
    }
    
    // Validate required fields
    if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Please fill in all required fields.'
        ]);
        exit;
    }
    
    // Sanitize inputs
    $name = htmlspecialchars(trim($data['name']));
    $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
    $service = isset($data['service']) ? htmlspecialchars(trim($data['service'])) : 'General Inquiry';
    $message = htmlspecialchars(trim($data['message']));
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please provide a valid email address.'
        ]);
        exit;
    }
    
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, service, message, status) VALUES (?, ?, ?, ?, 'new')");
    $stmt->bind_param("ssss", $name, $email, $service, $message);
    
    if ($stmt->execute()) {
        // Optional: Send email notification to admin
        // $to = "admin@ajwrites.com";
        // $subject = "New Contact Form Submission from " . $name;
        // $body = "Name: $name\nEmail: $email\nService: $service\n\nMessage:\n$message";
        // $headers = "From: noreply@ajwrites.com";
        // mail($to, $subject, $body, $headers);
        
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for reaching out! I\'ll respond within 24 hours to discuss how we can bring your vision to life.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred. Please try again or contact us directly via email.'
        ]);
    }
    
    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}

$conn->close();
?>
