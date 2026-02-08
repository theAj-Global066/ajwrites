<?php
// Database Setup Script
// Run this file ONCE to create all necessary tables

require_once 'config.php';

echo "<h2>AJWrites Portfolio - Database Setup</h2>";

// SQL to create all tables
$tables = [
    // Projects table
    "CREATE TABLE IF NOT EXISTS projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category VARCHAR(100),
        tags VARCHAR(255),
        image_url VARCHAR(500),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    
    // Services table
    "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        icon VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    
    // Testimonials table
    "CREATE TABLE IF NOT EXISTS testimonials (
        id INT AUTO_INCREMENT PRIMARY KEY,
        client_name VARCHAR(255) NOT NULL,
        client_title VARCHAR(255),
        message TEXT NOT NULL,
        rating INT DEFAULT 5,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    
    // Messages table
    "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        service VARCHAR(100),
        message TEXT NOT NULL,
        status ENUM('new', 'read', 'responded') DEFAULT 'new',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    // Admin users table
    "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

// Execute table creation
foreach ($tables as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>✓ Table created successfully</p>";
    } else {
        echo "<p style='color: red;'>✗ Error creating table: " . $conn->error . "</p>";
    }
}

// Insert default admin user (username: admin, password: admin123)
$admin_username = 'admin';
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);
$admin_email = 'admin@ajwrites.com';

$check_admin = $conn->query("SELECT * FROM admin_users WHERE username = '$admin_username'");

if ($check_admin->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO admin_users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $admin_username, $admin_password, $admin_email);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>✓ Default admin user created successfully</p>";
        echo "<p><strong>Username:</strong> admin</p>";
        echo "<p><strong>Password:</strong> admin123</p>";
        echo "<p style='color: orange;'>⚠️ Please change this password after first login!</p>";
    } else {
        echo "<p style='color: red;'>✗ Error creating admin user: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: blue;'>ℹ Admin user already exists</p>";
}

// Insert sample data
echo "<br><h3>Adding Sample Data...</h3>";

// Sample Projects
$sample_projects = [
    [
        'title' => 'Best-Selling Author Campaign',
        'description' => 'Crafted book descriptions and launch emails that drove 10,000+ pre-orders in two weeks.',
        'category' => 'Book Marketing',
        'tags' => 'Copywriting, Email Marketing',
        'image_url' => ''
    ],
    [
        'title' => 'SaaS Brand Storytelling',
        'description' => 'Developed compelling brand narrative that increased website conversions by 45%.',
        'category' => 'Brand Development',
        'tags' => 'Brand Voice, Web Copy',
        'image_url' => ''
    ],
    [
        'title' => 'Lifestyle Blog Growth',
        'description' => 'SEO content strategy that tripled organic traffic and doubled email subscribers in 6 months.',
        'category' => 'Content Strategy',
        'tags' => 'SEO Writing, Content Strategy',
        'image_url' => ''
    ]
];

foreach ($sample_projects as $project) {
    $stmt = $conn->prepare("INSERT INTO projects (title, description, category, tags, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $project['title'], $project['description'], $project['category'], $project['tags'], $project['image_url']);
    $stmt->execute();
}
echo "<p style='color: green;'>✓ Sample projects added</p>";

// Sample Services
$sample_services = [
    [
        'title' => 'Blog & Article Writing',
        'description' => 'SEO-optimized, engaging content that positions you as an industry authority and keeps readers coming back.',
        'icon' => '✍️'
    ],
    [
        'title' => 'Book Marketing Copy',
        'description' => 'Compelling descriptions, author bios, and promotional material that turn browsers into buyers.',
        'icon' => '📖'
    ],
    [
        'title' => 'Brand Storytelling',
        'description' => 'Authentic narratives that connect emotionally with your audience and build lasting brand loyalty.',
        'icon' => '🎯'
    ]
];

foreach ($sample_services as $service) {
    $stmt = $conn->prepare("INSERT INTO services (title, description, icon) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $service['title'], $service['description'], $service['icon']);
    $stmt->execute();
}
echo "<p style='color: green;'>✓ Sample services added</p>";

// Sample Testimonials
$sample_testimonials = [
    [
        'client_name' => 'Sarah Mitchell',
        'client_title' => 'Best-Selling Author',
        'message' => 'AJ transformed our book launch! The compelling copy drove pre-orders through the roof. Working with a true professional who understands reader psychology.',
        'rating' => 5
    ],
    [
        'client_name' => 'Marcus Chen',
        'client_title' => 'Marketing Director, TechFlow',
        'message' => 'Our conversion rate doubled after AJ rewrote our landing pages. The investment paid for itself in the first month. Highly recommend!',
        'rating' => 5
    ]
];

foreach ($sample_testimonials as $testimonial) {
    $stmt = $conn->prepare("INSERT INTO testimonials (client_name, client_title, message, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $testimonial['client_name'], $testimonial['client_title'], $testimonial['message'], $testimonial['rating']);
    $stmt->execute();
}
echo "<p style='color: green;'>✓ Sample testimonials added</p>";

echo "<br><h3 style='color: green;'>✓ Setup Complete!</h3>";
echo "<p>Your database is ready to use.</p>";
echo "<p><a href='index.html' style='color: blue;'>View Portfolio →</a></p>";
echo "<p><a href='admin-login.html' style='color: blue;'>Access Admin Panel →</a></p>";

$conn->close();
?>
