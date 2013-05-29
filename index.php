<?php
  require_once 'functions.php';
  
  $page = "todo";
  
// If there is a page variable in the url..
  if( isset( $_GET['page'] ) ){
  // ..show that page instead
  $page = $_GET['page'];
  }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <?php
          switch ($page) {
           case "todo":
              echo"<title>Free email powered to-do / task list / organizational application compatible with smart phones, tablets and computers of all types. </title>";
             break;
           case "login":
              echo"<title>Login to your task list / todo / organizational tracking application.  Stay organized by emailing tasks to our website on the fly. </title>";
             break;
           case "register":
              echo"<title>Register for our free task, todo, organizational web application. Email tasks / todos from your mobile phone, tablet or computer.</title>";
             break;    
           default:
              echo"<title>Email driven to-do / task list / prganizational application compatible with smart phones, tablets and computers of all types. </title>";
           }
        ?>
      <meta name="description" content="This organizational application provides an easy way for you to track tasks and to-do's irregardless your operating system or device type. Simply compose an email with your task in the subject line and send it off to our website. Then log in here to see and manage them. It's an easy way to stay organized while on the run!">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
       <div class="container-fluid">
       
       <?php
        include( "pages/$page.php" );
       ?> 
        
         <!-- Modal -->
         <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             <h3 id="myModalLabel">Instructions</h3>
           </div>
           <div class="modal-body">
             <p class="muted"><a href="http://www.jmcdesignstudios.com/task_app/?page=register" title="Register for our free mobile-friendly email powered task, todo, organizational application.">Register</a> your email on this website.</p>
             <p class="muted">Any time you'd like to add a to-do, send an email (from your registered address) to <a href="mailto:postmaster@jmcdesignstudios.com" title="Send an email to our website with your task / todo in the subject line.">postmaster@jmcdesignstudios.com</a> with your to-do in the subject line, leave the body empty.</p>
             <p class="muted">Optionally, you can categorize your to-do using hashtags # similar to twitter.  For example, to assign a 'groceries' category to a todo you would type something like this in the subject line of your email: <strong>pick up eggs #groceries</strong>. Feel free to use multiple hashtag categories as well! </p>
             <p class="muted"><a href="http://www.jmcdesignstudios.com/task_app/" title="Log in to our free mobile-friendly email powered task, todo, organizational application.">Log in</a> to this website to see, manage and filter (i.e, by category) your to-do list (allow 5 minutes for your to-do appear on this site).</p>
             <p class="muted">That's it!</p>
           </div>
           <div class="modal-footer">
             <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
           </div>
         </div>
      </div>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 
        <script src="js/main.js"></script>    
        <script src="js/plugins.js"></script>
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/jquery-validate.min.js"></script>
        <script src="js/modernizr.custom.47805.js"></script>

             
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-38565481-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
         
    </body>
</html>
