<?php
session_start();  

//Connect to the database
mysql_connect("mysql.jmcdesignstudios.com","xxxx","xxxx") or die ( mysql_error() );
mysql_select_db('etodoit');
date_default_timezone_set('America/New_York'); 

//********SECURITY************************//
//session lasts for one week
ini_set('session.cookie_lifetime', 7*24*60);  

function redirect($url)
{ 
  header("location: $url");
  exit('You should be directed, if not, <a href="'.$url.'">Click Here</a>');
}

// if there isn't an active session associated with the session identifier that the user is presenting...

if (!isset($_SESSION['initiated']))
{
  // ..regenerate it just to be sure.. 
  //session_regenerate_id();

  // ..and tell the session that it has now been initiated 
  $_SESSION['initiated'] = true;
}
  
/*
 * Prints a set of links which vary if the user is logged in or not
 */
function show_user_status()
{
  // See if the user is logged in
  if( $user_id = get_user_id() )
  {
    //
  }
  else
  {
    include "pages/login.php";
    echo "<a href='?page=register' title='Resgister for our free mobile-friendly task, todo, organizational application.'>Don't have an account?</a>";
  }
}  
  
 /*
 * Fetches a single user from the database
 * @param int The id of the user being fetched
 * @return Object The user matching the specified id, or a new user
 */
function get_user($id = 0)
{
  $result = mysql_query("SELECT * FROM users WHERE uid=$id LIMIT 1");
  
  // See if the post was found
  if( mysql_num_rows($result) )
  {
    $user = mysql_fetch_object($result);
    mysql_free_result($result);
    return $user;
  }
}
 
  
/*
 * Get the currently logged in user's id
 * @return int The logged in user's id, or 0
 */
function get_user_id()
{
  return array_key_exists('user_id', $_SESSION ) ? $_SESSION['user_id'] : 0;
}
  
/*
 * Redirects the browser to another url after PHP finishes running
 * @param string The url with which to redirect the browser
 */

function is_valid_email( $str )
{
  return (bool)filter_var($str, FILTER_VALIDATE_EMAIL);
};

/*
 * Attemps to log a user in
 * @param string The email address used to log in
 * @param string The password used to log in
 * @return int The logged in user's id, or 0
 */

function log_in_user($email, $password)
{
  
  // Validate the email
    if( !is_valid_email( $email ) )
    {
      return false;
    }
  
  // Prevent injection attack
  $password = mysql_real_escape_string($password);
  
  
  // Make sure the token in your session matches the on in the form, if it's not valid, escape the function by returning false
  if( !is_valid_token() )
    return false;
  
  // Find a user with the specified email and password
  $result = mysql_query("SELECT `uid` FROM `users` WHERE `email_primary`=LOWER('$email') AND password='$password' LIMIT 1");
  
  // See if a user was found
  if( mysql_num_rows( $result ) )
  {
    $user = mysql_fetch_object( $result );
    
    // Log the user in by storing their id in the session
    $_SESSION['user_id'] = $user->uid;
    
   // session_regenerate_id();
    
    return $user->uid;
  }
  
  return false;
}

/*
 * Attemps to log a user out
 * @return boolean Whether the user was logged in
 */
function log_out_user()
{
  if( array_key_exists('user_id', $_SESSION ) )
  {
    unset( $_SESSION['user_id'] );
    
    //session_regenerate_id();
    
    return true;
  }
  
  return false;
}
  



// Create a random number, save it in the session, and return it for outside use
function get_token( )
{
  // Create a random number and save it in $token
  $token = md5(uniqid(rand(), true));

  // Save the token so it may be used on other pages
  $_SESSION['token'] = $token;
  
  return $token;
}

function is_valid_token()
{
  // If the token is not set in the session OR the token doesnt match between the form and the session, return false, otherwise return true
  if( !isset($_SESSION['token']) || $_POST['token'] != $_SESSION['token'] )
  {
    return false;
  }
  return true;
}
  
  //register a new user
  
  function Register($email,$password)
    {
    
      $email = strtolower($email);  
        
      $query = <<<SQL
        INSERT INTO `users` 
        (`email_primary`,`password`)
        VALUES
        ('$email','$password')            
SQL;
      
      //run query to add a new user
  
    if(mysql_query($query))
  
      {
        //insert was sucessfull
        //log user in automatically
        //figure out what the new id is
        
        $id = mysql_insert_id();
        
        //save that id in the session for later
        
        $_SESSION['user_id'] = $id;
        
        return $id;
      }

        return 0;
    }
  
  
  function getTodos(){
 
    $uid = $_SESSION['user_id'];
  
    if (isset($_GET['filter']))
    {
      if ($_GET['filter']=='none')
      { 
       $query = "SELECT * FROM `todos` WHERE `uid` = '$uid' ORDER BY `time_added` DESC;";
      }
      else
      {
        $filter = $_GET['filter'];  
       
      	$query = "SELECT todos.todo, todos.time_added, todos.id, categories.category FROM todos INNER JOIN categories ON todos.id=categories.todo_id WHERE categories.category = '$filter' AND todos.uid = $uid";
      }
    }
    else
    {
      $query = "SELECT * FROM `todos` WHERE `uid` = '$uid' ORDER BY `time_added` DESC;";
    }
    
    return mysql_query($query);
    
  }
  
  function getCategories($todo_id){
  
    $query = "SELECT * FROM `categories` WHERE `todo_id` = '$todo_id'";
    
    return mysql_query($query);
    
  }
  
  
  
  function getUidByEmail($email){
  
    $query = "SELECT * FROM `users` WHERE `email_primary` = '$email' LIMIT 1";
    
    $result = mysql_query($query);
    
    $row = mysql_fetch_object($result);
    
    return $row->uid; 
  }
  
  function deleteTodo($id)
    {
      $query = "DELETE FROM `todos` WHERE `id`=$id";
    
      mysql_query($query) or die(mysql_error());
      
      return true;
    };
  	
	function getHashTagCategories($string){
	
	$categories = array();
	
	preg_match_all('/#([\p{L}\p{Mn}]+)/u',$string,$matches);

	foreach(($matches[1]) as $category){
		$categories[] = $category;
		}
	
	return $categories;
	
	};
	
  function createFilter()
  {  
      $uid = $_SESSION['user_id'];
      $query = "SELECT DISTINCT categories.category FROM categories INNER JOIN todos ON todos.id=categories.todo_id WHERE todos.uid = $uid";
      $result = mysql_query($query);
      echo "<div>";
	  echo "<select id='filter' name='category'>";
      echo "<option name='none' value='none'>filter by # category</option>";
      while($row = mysql_fetch_object($result))
      {
        if (($_GET['filter']==$row->category))
        {
        	$selected=" selected='selected' ";
        }
        else
        {
        $selected = "";
        }
        echo "<option".$selected." name='".$row->category."' value='".$row->category."' >".$row->category."</option>"; 
      };
      echo '</select>';
      echo '</div>';  
  };
  
?>