<?php
$task_id = $_POST['taskid'] ?? null;
echo '<pre>';
var_dump($task_id);
echo '</pre>';
exit;

$query = $connection->prepare("SELECT task_file FROM tasks WHERE task_id = :id");
$query->bindValue(":id", $task_id);
$query->execute();

$task = $query->fetch(PDO::FETCH_ASSOC);

if ($task) {
    unlink($task['task_file']);
}

if (!$task_id) {
    header("Location: ?id=tasks");
    exit;
}

$query = $connection->prepare('DELETE FROM tasks WHERE task_id = :id');
$query->bindValue(':id', $task_id);
$query->execute();

header("Location: ?id=tasks");
