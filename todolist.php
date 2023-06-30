<?php
  class TodoList {
    private $db;

    public function __construct($db) {
      $this->db = $db;
    }

    public function addTask($task) {
      $sql = "INSERT INTO todos (task) VALUES ('$task')";
      mysqli_query($this->db, $sql);
    }

    public function getTasks() {
      $tasks = [];

      $sql = 'SELECT * FROM todos';
      $result = mysqli_query($this->db, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $task = new Task($row['id'], $row['task']);
        $tasks[] = $task;
      }
      return $tasks;
    }

    public function deleteTask($taskId) {
      $sql = "DELETE FROM todos WHERE id = '$taskId'";
      mysqli_query($this->db, $sql);
    }

  
    public function editTask($taskId, $editedTask) {
      $sql = "UPDATE todos SET task = '$editedTask' WHERE id = '$taskId'";
      mysqli_query($this->db, $sql);
    }
  
  }
?>
