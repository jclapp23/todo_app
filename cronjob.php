<?php
  
require_once 'functions.php';
require 'classes/email_reader.php';

$inbox = new email_reader();
$counter = 0;

while($full_email = $inbox->get($counter)){
  $todo = $full_email['header']->Subject;
  $time_added = $full_email['header']->date;
  $from = $full_email['header']->from;
  foreach ($from as $id => $object) 
  {
    $email = $object->mailbox . "@" . $object->host;
  }

  $uid = getUidByEmail($email);
  
  $todo = addslashes($todo);
  
  //call function to add emailed task to database
  addTasktoDB($todo,$uid,getHashTagCategories($todo));
  
  $inbox->flagForDelete($counter+1);

  $counter++;
}
  
$inbox->delete();     

//Insert task info into db  
function addTasktoDB($todo,$uid,$categories){

  $query = <<<SQL
                  INSERT INTO  `etodoit`.`todos` (`todo` ,`uid`)
                  VALUES ('$todo', '$uid');
SQL;

  mysql_query($query);
  
  $id = mysql_insert_id();

  //if there are hashtag categories in the to-do string, add them to category table
  
  foreach ($categories as $category){
	  $query2 = <<<SQL
                  INSERT INTO  `etodoit`.`categories` (`todo_id` ,`category`)
                  VALUES ('$id', '$category');
SQL;

  mysql_query($query2);
	  
 }
  


}


?>