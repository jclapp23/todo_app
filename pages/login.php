<div id="login-wrapper" class="main">  
  <div id="login_div">   
    <form action="pages/login-action.php" method="post">
      <div>
        <label>Email</label>
        <input type="email" name="email" autofocus="autofocus" required />
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" required />
      </div>
            <input type="hidden" name="token" value="<?php echo get_token(); ?>" />
      <div>
        <input class="btn btn-primary" type="submit" value="Log In" />
      </div>
    
    </form>
    
    </div> <!-- Login -->
    
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