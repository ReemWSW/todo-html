<?php
require 'db.php';

// Handle Create Task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO todos (task) VALUES (:task)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['task' => $task]);
    header('Location: index.php');
    exit;
}

// Fetch Tasks
$stmt = $conn->query("SELECT * FROM todos ORDER BY created_at DESC");
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-list</title>
    <link rel="stylesheet" href="css/todo.css">
</head>

<body>
    <div class="todo-container">
        <h1>To-do List</h1>
        <form action="index.php" method="post" class="todo-form">
            <input type="text" name="task" placeholder="Add a new task" required>
            <button type="submit">Add</button>
        </form>
        <ul class="todo-list">
            <?php foreach ($todos as $todo): ?>
            <li>
                <span>
                    <?= htmlspecialchars($todo['task']) ?>
                </span>
                <a href="edit.php?id=<?= $todo['id'] ?>" class="btn-edit">Edit</a>
                <a href="delete.php?id=<?= $todo['id'] ?>" class="btn-delete">Delete</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>