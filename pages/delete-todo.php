<?php
  require_once '../functions.php';
  
  deleteTodo($_GET['id']);
  
  redirect('http://www.jmcdesignstudios.com/task_app/');
 
?>