<html>
    <head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
    </head>
    <body>
        <div>
        <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-headding">User Login</h2>
        </div>
        
        <div class="show_res"></div>
        <div class="login_here"></div>
        <form class="form" id="loginForm" method="post" action="<?=  base_url("index.php/user/userLogin")?>">
                 
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="uemail" id="u_email"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="upassword" id="u_password"/>
                    </div>
                    
            <button type="submit" class="btn btn-success">Login</button>
                </form>
    </div>
</div>
   
    </body>
</html>

<script>

</script>