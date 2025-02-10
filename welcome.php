<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
   <style>
    body { font-family: Arial, sans-serif; background-color: #f2f2f2; text-align: center; padding: 50px; }
        .btn { padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background-color: #e53935; }
        .error { color: red; }
   </style>
</head>
<body>

    <h1>user page</h1>
 
<h1>Hello Master, <?php echo $user['username']; ?></h1>

<h2><strong>INFORMATION:</strong></h2>
<h3><span>Username:</span> <?php echo ($user['username']); ?></h3>
<h3><span>Department:</span> <?php echo ($user['department']); ?></h3>
<h3><span>Course:</span> <?php echo ($user['course']); ?></h3>
<h3><span>Email:</span> <?php echo ($user['email']); ?></h3>
<h3><span>Password:</span> <?php echo ($user['password']); ?> </h3>

<a href="php/logout.php"><button class="btn">Logout</button></a>
 
</body>
</html>
