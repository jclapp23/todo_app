<?php
  date_default_timezone_set('America/New_York'); 
  
  echo "<center>";
  echo "<div class='page-header'>";
  echo "<h4>To-do List</h4>";
  echo "<a href='#myModal' data-toggle='modal' title='An explanation of our free mobile-friendly email powered task, todo, organizational application.'>How's this work?</a><br/>";
  
  if( $user_id = get_user_id() )
  {
    $user = get_user($_SESSION['user_id']);
    $user = $user->email_primary;
    echo "<small>Welcome back <em>$user</em> &nbsp;</small>"; 
    echo "<a class='btn' href='?page=logout'>Log Out</a>";
  };
  echo "</div>";

  show_user_status();
 
  if( $user_id = get_user_id() )
  {
 
  createFilter();
  
  $api_url = 'http://www.jmcdesignstudios.com/task_app/api/index.php/';


   if (isset($_GET['filter']))
    {
      if ($_GET['filter']=='none')
      { 
        // get all todo's unfiltered
        $result= json_decode(file_get_contents($api_url.'tasks/user/'.$user_id));
      }
      else
      {
        $filter = $_GET['filter'];  
       
	 // get all todo's filtered
        $result= json_decode(file_get_contents($api_url.'tasks/user/'.$user_id.'/filter/'.$filter));
      }
    }
    else
    {
      // get all todo's unfiltered
        $result= json_decode(file_get_contents($api_url.'tasks/user/'.$user_id));
    }


  //$result = getTodos(); 
  
  foreach ($result as $row){
      echo "<div class='well well-small'>";
      echo "<p class='text-success'> {$row->todo}</p>";
      $time = date("F j, Y, g:i a", strtotime($row->time_added)); 
      
	  echo "<p><small>$time <a class='btn btn-danger' href='pages/delete-todo.php?id={$row->id}'>Remove</a></small></p>";
      
	  $id = $row->id;
	  
	  //$categories = getCategories($id);
	  
	  $categories = json_decode(file_get_contents($api_url.'task/cat/'.$row->id));


	  if($categories){
		   echo "<div class='category_holder'>";
		  }
	  
	  foreach ($categories as $row){
				$category = $row->category;
		  		echo "<div class='category_box'>{$category}</div>";		
		  }
	  
	    
	  if($categories){
		   echo "<div class='clear'></div>";
		   echo "</div>";
		  }
	  
	  echo "</div>";

	}; //end foreach

};	//end if 


echo "</center>";
  
 
?>
