<?php
  require_once 'task.php';
  require_once 'todolist.php';
  require_once 'config.php';

  $todoList = new TodoList($db);

  // Handle form submission
  if (isset($_POST["addTodo"])) {
    $task = $_POST['todo'];
    $todoList->addTask($task);
  } elseif (isset($_POST["editTodo"])) {
    $taskId = $_POST['taskId'];
    $editedTask = $_POST['editedTask'];
    $todoList->editTask($taskId, $editedTask);
  } elseif (isset($_POST["deleteTodo"])) {
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
          <span><?php echo $task->getTask(); ?></span>
          <div>
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal-<?php echo $task->getId(); ?>">Edit</button>
            <form method="post" action="index.php" style="display: inline;">
              <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
              <button type="submit" name="deleteTodo" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </div>
        </li>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal-<?php echo $task->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?php echo $task->getId(); ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?php echo $task->getId(); ?>">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="post" action="index.php">
                <div class="modal-body">
                  <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
                  <div class="form-group">
                    <label for="editedTask-<?php echo $task->getId(); ?>">Task</label>
                    <input type="text" name="editedTask" class="form-control" id="editedTask-<?php echo $task->getId(); ?>" value="<?php echo $task->getTask(); ?>" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" name="editTodo" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </ul>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
