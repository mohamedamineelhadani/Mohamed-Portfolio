<?php
require '../php/db.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$result = $conn->query('SELECT * FROM contacts ORDER BY created_at DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received messages</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Jost:wght@400;500&display=swap">
    <link rel="stylesheet" href="../css/pages.css">
</head>
<body>
    <main class="admin">
        <header class="admin-head">
            <h1>Received <span>messages</span> (<?= (int)$result->num_rows ?>)</h1>
            <a class="btn" href="logout.php">Log out</a>
        </header>
        <?php if ($result->num_rows > 0): ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr><th>#</th><th>Full name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th><th>Date sent</th></tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= (int)$row['id'] ?></td>
                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                            <td><a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= htmlspecialchars($row['subject']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="empty">No messages yet.</p>
        <?php endif; ?>
    </main>
</body>
</html>
<?php $conn->close(); ?>