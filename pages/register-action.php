<?php

  require_once '../functions.php';
  
  // Attempt to create a new user
  
  Register(addslashes($_POST['email']),$_POST['password']);
  
  redirect('http://www.jmcdesignstudios.com/task_app/');

?>