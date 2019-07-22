<?php
//print_r($userdetails);exit;
$uname = isset($userdetails->uname)?$userdetails->uname:"";
$uemail = isset($userdetails->uemail)?$userdetails->uemail:"";
$umobile = isset($userdetails->umobile)?$userdetails->umobile:"";
$upassword = isset($userdetails->upassword)?$userdetails->upassword:"";
?>
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
                        <h2 class="page-headding">Edit User Details</h2>
                        <font id="edit_sucees" style="color:green;font-size:25px;"></font>
                    </div>
                    
               
                 <form class="form" id="userEditForm">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type ="hidden" value="<?=$userdetails->uid?>" name="user_id" id="user_id">
                                <label>Name</label>
                                <input type="text" class="form-control" name="uname"  value="<?=$uname?>" id="name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="text" class="form-control" name="uemail"  value="<?=$uemail?>" id="email"/>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-md-4">
                                <label>Mobile</label>
                                <input type="text" class="form-control" name="umobile"  value="<?=$umobile?>" id="phone"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Password</label>
                                <input type="password" class="form-control" name="upassword"  value="<?=$upassword?>" id="password"/>
                            </div>
                        </div>
                       
                        <button  class="btn btn-success">Edit details</button>
                        <button type="button" class="btn btn-danger" onclick="userDelete()">Delete Account</button>
                    </form>
                 

                  
                </div>
            </div>

    </body>
</html>

<script>
 $("#userEditForm").on('submit',(function(e){
    e.preventDefault();
    
    $.ajax({
       url:"<?=  base_url("index.php/user/userUpdateDetails")?>",
       type:"POST",
       data: new FormData(this),
       cache:false,
       contentType:false,
       processData:false,
       success:function(response){
           if(response == 1){
               alert('Details are saved sucessfully');
               window.location.reload();
           }else{
              alert('Details are not saved');
              window.location.reload(); 
           }
       }
    });
    
}));

function userDelete(){

 $.ajax({
       url:"<?=  base_url("index.php/user/userDelete")?>",
       type:"POST",
       data: {
           user_id:$("#user_id").val()
       },
       
       success:function(response){
           if(response == 1){
               alert('Details are deleted sucessfully');
               window.location.href = "<?=  base_url("index.php/user/index")?>";
           }else{
              alert('Deletion failed');
               window.location.reload(); 
           }
       }
    });
}
</script>


