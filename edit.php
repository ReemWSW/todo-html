<?php
require 'db.php';

$id = $_GET['id'];
// Fetch the task
$stmt = $conn->prepare("SELECT * FROM todos WHERE id = :id");
$stmt->execute(['id' => $id]);
$todo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$todo) {
    echo "Task not found!";
    exit;
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "UPDATE todos SET task = :task WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['task' => $task, 'id' => $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="css/todo.css">
</head>
<body>
    <div class="todo-container">
        <h1>Edit Task</h1>
        <form action="" method="post" class="todo-form">
            <input type="text" name="task" value="<?= htmlspecialchars($todo['task']) ?>" required>
            <button type="submit">Update</button>
        </form>
        <a href="index.php">Back to List</a>
    </div>
</body>
</html>
