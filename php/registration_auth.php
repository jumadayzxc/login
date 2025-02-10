<?php
include('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $course = $_POST['course']; // New course input
    $department = $_POST['department']; // New department input
    $role = $_POST['role'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
        header('Location: ../registration.php?error=' . $error);
        exit;
    }

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        $error = "Username or email already exists!";
        header('Location: ../registration.php?error=' . $error);
        exit;
    }

    // Insert new user along with course and department
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, course, department, role ) VALUES (:username, :email, :password, :course, :department, :role)");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'course' => $course,
        'department' => $department,
        'role' => $role,
    ]);

    $success = "New account added!";
    header('Location: ../index.php?success=' . $success);
    exit;
} else {
    header('Location: ../registration.php');
    exit;
}
?>