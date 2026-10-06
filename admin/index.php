<?php
require '../php/db.php';

$exists = $conn->query('SELECT COUNT(*) AS c FROM admins')->fetch_assoc()['c'] > 0;
$msg = '';

if (!$exists && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';
    if ($user === '' || strlen($pass) < 10) {
        $msg = 'Username required and password must be at least 10 characters.';
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO admins (username, password_hash) VALUES (?, ?)');
        $stmt->bind_param('ss', $user, $hash);
        $stmt->execute();
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin setup</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Jost:wght@400;500&display=swap">
    <link rel="stylesheet" href="../css/pages.css">
</head>
<body class="center">
    <main class="card">
        <h1>Admin <span>Panel</span></h1>
        <?php if ($exists): ?>
            <p>Hello Admin, please login.</p>
            <a class="btn" href="login.php">Go to login</a>
        <?php else: ?>
            <p>Create the administrator account.</p>
            <?php if ($msg): ?><p class="error"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
            <form method="POST" class="form">
                <input type="text" name="username" placeholder="Username" required autocomplete="username">
                <input type="password" name="password" placeholder="Password (10+ characters)" required minlength="10" autocomplete="new-password">
                <button type="submit">Create admin</button>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>