<?php
  require_once 'task.php';
  require_once 'todolist.php';
  require_once 'config.php';

  $todoList = new TodoList($db);

  // Handle form submission
  if(isset($_POST["addTodo"])) {
    $task = $_POST['todo'];
    $todoList->addTask($task);
  }elseif (isset($_POST["deleteTodo"])) {
    $taskId = $_POST['taskId'];
    $todoList->deleteTask($taskId);
  }
?>

<!DOCTYPE html>
<html>

<head>
  <title>Todo App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1 class="mt-5">Todo App</h1>

    <form method="post" action="index.php" class="mt-3">
      <div class="input-group mb-3">
        <input type="text" name="todo" class="form-control" placeholder="Add a new task" required>
        <div class="input-group-append">
          <button type="submit" name="addTodo" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>

    <ul class="list-group">
      <?php foreach ($todoList->getTasks() as $task) { ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?php echo $task->getTask(); ?>
          <form method="post" action="index.php">
            <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
            <button type="submit" name="deleteTodo" class="btn btn-danger btn-sm">Delete</button>
          </form>
        <?php } ?>
      </li>
    </ul>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>