<?php 
  require_once '../functions.php';
  if(log_in_user(addslashes($_POST['email']),$_POST['password'])){
     redirect('http://www.jmcdesignstudios.com/task_app/index.php');
  };
?>