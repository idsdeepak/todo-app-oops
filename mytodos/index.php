<!DOCTYPE html>
<html>
  <head>
    <title>Todo App</title>
  </head>
  <body>
    <?php
      require_once 'task.php';
      require_once 'todolist.php';
      require_once 'config.php';

      $todoList = new TodoList($db); // Create a new instance of TodoList
      if (isset($_POST["addTodo"])) {
        $task = $_POST['todo'];
        $todoList->addTask($task);
      }
    ?>

    <h1>Todo App</h1>
    <form method="post" action="index.php">
      <input type="text" name="todo" placeholder="Add a new task" required>
      <button type="submit" name="addTodo" value="true">Add</button>
    </form>

    <ul>
      <?php
        foreach ($todoList->getTasks() as $task) { // Display the tasks from the TodoList
          echo "<li>{$task->getTask()}</li>";
        }
      ?>
    </ul>
  </body>
</html>
