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
      return Task::fetchAll($this->db);
    }
  }
?>
