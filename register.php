
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
      
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-headding">User Registration</h2>
                        <font id="reg_sucees" style="color:green;font-size:25px;"></font>
                    </div>

                    <form class="form" id="userForm">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="uname" id="name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="text" class="form-control" name="uemail" id="email"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Image</label>
                                <input type="file" class="form-control" name="user_image" id="image"/>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-md-4">
                                <label>Mobile</label>
                                <input type="text" class="form-control" name="umobile" id="phone"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Password</label>
                                <input type="password" class="form-control" name="upassword" id="password"/>
                            </div>
                        </div>
                       
                        <button  class="btn btn-success">Register</button>
                        <a href="<?=  base_url('index.php/user/login_page')?>" class="btn btn-success" onclick="userLogin()">Login</a>
                    </form>
                </div>
            </div>

    </body>
</html>

<script>
  
$("#userForm").on('submit',(function(e){
    e.preventDefault();
  
    $.ajax({
       url:"<?=  base_url("index.php/user/userRegistration")?>",
       type:"POST",
       data: new FormData(this),
       cache:false,
       contentType:false,
       processData:false,
       success:function(response){
           if(response == 1){
               alert('Details are saved sucessfully');
               window.location.href = "<?=  base_url("index.php/user/login_page")?>";
           }else{
              alert('Registration failed');
               window.location.reload(); 
           }
       }
    });
    
}));
</script>


