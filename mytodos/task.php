<?php
  class Task {
    private $id;
    private $task;

    public function __construct($id, $task) {
      $this->id = $id;
      $this->task = $task;
    }

    public function getId() {
      return $this->id;
    }

    public function getTask() {
      return $this->task;
    }

    public static function fetchAll($db) {
      $tasks = [];
      $sql = 'SELECT * FROM todos';
      $result = mysqli_query($db, $sql);
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      foreach ($rows as $row) {
        $task = new Task($row['id'], $row['task']);
        $tasks[] = $task;
      }
      return $tasks;
    }
  }
?>
