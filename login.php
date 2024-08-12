<?php
require('header.php');
include('function.php');
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card mt-5 col-5"> 
            <span class="card-header text-center font-weight-bold" >User Login:
               
            </span>
            
            <div class="card-body d-flex justify-content-center">
                <form class="mx-1 mx-md-4" autocomplete="off" method="POST">
                    <input type="hidden" name="session" id="session" value="">
                    <?php
                    if (isset($_SESSION['logmessage'])) {
                        echo " <p style='font-weight:bold;text-align:center;color:red;'>" . $_SESSION['logmessage'] . "</p>";
                        unset($_SESSION['logmessage']); 
                    }
                    ?>

                <div class="d-flex flex-column  mb-4 mt-3">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Email<span class="text-danger">*</span></label>
                        <input type="email" id="logemail" class="form-control form-control" name="logemail"  autocomplete="off">
                        <span style="display: none;color:red;" id="logemailMessage"> Email  is required.</span>
                    </div>
                </div>
        
                <div class="d-flex flex-column mb-4">
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Password<span class="text-danger">*</span></label>
                        <input type="password" id="logpass" class="form-control form-control" name="logpass" autocomplete="off">
                        <span style="display: none;color:red;" id="logpassMessage"> Password  is required.</span>
                    </div>
                </div>
        
                <div class="d-flex mx-4 mb-3 mb-lg-4">
                    <input id="BtnLogin" name="LoginBTn"  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" value="LogIn">
                </div>
                <div class="text-center">
                    <span class="text-center text-muted mt-5 mb-0">Haven't an account? <a href="index.php" class="fw-bold text-body"><u>Create an Account</u></a></span>
                </div>
            </form>

            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
    </div>
    </div>

<?php  require('footer.php')?>