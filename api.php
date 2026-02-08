<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = isset($_GET['action']) ? $_GET['action'] : '';

// Handle preflight requests
if ($method === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Authentication check for protected routes
function checkAuth() {
    session_start();
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit();
    }
}

// Get all projects
function getProjects($conn) {
    $sql = "SELECT * FROM projects ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $projects = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }
    
    echo json_encode(['success' => true, 'data' => $projects]);
}

// Get single project
function getProject($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => true, 'data' => $result->fetch_assoc()]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Project not found']);
    }
}

// Create project
function createProject($conn) {
    checkAuth();
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("INSERT INTO projects (title, description, category, tags, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $data['title'], $data['description'], $data['category'], $data['tags'], $data['image_url']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Project created successfully', 'id' => $conn->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create project']);
    }
}

// Update project
function updateProject($conn, $id) {
    checkAuth();
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, category=?, tags=?, image_url=? WHERE id=?");
    $stmt->bind_param("sssssi", $data['title'], $data['description'], $data['category'], $data['tags'], $data['image_url'], $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Project updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update project']);
    }
}

// Delete project
function deleteProject($conn, $id) {
    checkAuth();
    
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Project deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete project']);
    }
}

// Get all services
function getServices($conn) {
    $sql = "SELECT * FROM services ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $services = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    }
    
    echo json_encode(['success' => true, 'data' => $services]);
}

// Create service
function createService($conn) {
    checkAuth();
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("INSERT INTO services (title, description, icon) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $data['title'], $data['description'], $data['icon']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Service created successfully', 'id' => $conn->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create service']);
    }
}

// Update service
function updateService($conn, $id) {
    checkAuth();
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("UPDATE services SET title=?, description=?, icon=? WHERE id=?");
    $stmt->bind_param("sssi", $data['title'], $data['description'], $data['icon'], $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Service updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update service']);
    }
}

// Delete service
function deleteService($conn, $id) {
    checkAuth();
    
    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Service deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete service']);
    }
}

// Get all testimonials
function getTestimonials($conn) {
    $sql = "SELECT * FROM testimonials ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $testimonials = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $testimonials[] = $row;
        }
    }
    
    echo json_encode(['success' => true, 'data' => $testimonials]);
}

// Create testimonial
function createTestimonial($conn) {
    checkAuth();
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("INSERT INTO testimonials (client_name, client_title, message, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $data['client_name'], $data['client_title'], $data['message'], $data['rating']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Testimonial created successfully', 'id' => $conn->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create testimonial']);
    }
}

// Update testimonial
function updateTestimonial($conn, $id) {
    checkAuth();
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("UPDATE testimonials SET client_name=?, client_title=?, message=?, rating=? WHERE id=?");
    $stmt->bind_param("sssii", $data['client_name'], $data['client_title'], $data['message'], $data['rating'], $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Testimonial updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update testimonial']);
    }
}

// Delete testimonial
function deleteTestimonial($conn, $id) {
    checkAuth();
    
    $stmt = $conn->prepare("DELETE FROM testimonials WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Testimonial deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete testimonial']);
    }
}

// Submit contact message
function submitMessage($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("INSERT INTO messages (name, email, service, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data['name'], $data['email'], $data['service'], $data['message']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send message']);
    }
}

// Get all messages
function getMessages($conn) {
    checkAuth();
    
    $sql = "SELECT * FROM messages ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $messages = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }
    
    echo json_encode(['success' => true, 'data' => $messages]);
}

// Update message status
function updateMessageStatus($conn, $id) {
    checkAuth();
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("UPDATE messages SET status=? WHERE id=?");
    $stmt->bind_param("si", $data['status'], $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Message status updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
}

// Route handling
switch($request) {
    // Projects
    case 'projects':
        if ($method === 'GET') {
            if (isset($_GET['id'])) {
                getProject($conn, $_GET['id']);
            } else {
                getProjects($conn);
            }
        } elseif ($method === 'POST') {
            createProject($conn);
        } elseif ($method === 'PUT' && isset($_GET['id'])) {
            updateProject($conn, $_GET['id']);
        } elseif ($method === 'DELETE' && isset($_GET['id'])) {
            deleteProject($conn, $_GET['id']);
        }
        break;
    
    // Services
    case 'services':
        if ($method === 'GET') {
            getServices($conn);
        } elseif ($method === 'POST') {
            createService($conn);
        } elseif ($method === 'PUT' && isset($_GET['id'])) {
            updateService($conn, $_GET['id']);
        } elseif ($method === 'DELETE' && isset($_GET['id'])) {
            deleteService($conn, $_GET['id']);
        }
        break;
    
    // Testimonials
    case 'testimonials':
        if ($method === 'GET') {
            getTestimonials($conn);
        } elseif ($method === 'POST') {
            createTestimonial($conn);
        } elseif ($method === 'PUT' && isset($_GET['id'])) {
            updateTestimonial($conn, $_GET['id']);
        } elseif ($method === 'DELETE' && isset($_GET['id'])) {
            deleteTestimonial($conn, $_GET['id']);
        }
        break;
    
    // Messages
    case 'messages':
        if ($method === 'GET') {
            getMessages($conn);
        } elseif ($method === 'POST') {
            submitMessage($conn);
        } elseif ($method === 'PUT' && isset($_GET['id'])) {
            updateMessageStatus($conn, $_GET['id']);
        }
        break;
    
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

$conn->close();
?>
