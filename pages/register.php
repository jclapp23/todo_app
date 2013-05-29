<center>
<div class='page-header'>
<h4 id="register">Register!</h4>
  <a href='#myModal' data-toggle='modal' title="An explanation of how our free organizational to do / task list application.">How's this work?</a><br/>
</div>
<div id="registerbox">
  <form id="register" class="cmxform" method="post" action="pages/register-action.php" validate="validate">
    <label>email:</label><input id="email" class="required email"  title="You must send your to-do's from this email." name="email" type="email" required title="Enter a valid email address" /><br/>
    <label>password:</label><input name="password" type="password" pattern=".{5,}" title="Minimum 5 letters or numbers." required=""><br/>
	
    <br/>
    <input class="btn btn-primary" type="submit" value="Register!" />
    <a class="btn" href="index.php" title="Go back to the home screen for our task list web application.">Back</a>
    </form> 
</div>  

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

</center>
