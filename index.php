<?php
include_once('header.php');
include('function.php');
?>
  <div class="container mt-5">
  <div class="row justify-content-center">
      <div class="card mt-5 col-5">
          <div class="card-header text-center">
            Registration?
          </div>
          <div class="card-body d-flex justify-content-center">
            <form class="mx-1 mx-md-4" autocomplete="off" method="post">
              <?php
              if (isset($_SESSION['message'])) {
                echo "<p>" . $_SESSION['message'] . "</p>";
                unset($_SESSION['message']); // Clear the message after displaying it
              }
              ?>
              <div class="d-flex flex-column mb-4 mt-4">
                  <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Your Name <span class="text-danger">*</span></label>
                      <input type="text" id="FirstName" class="form-control form-control" name="FirstName">
                      <span style="display: none;color:red" id="msgfirst"> First name is required.</span>
                     
                  </div>
              </div>
    
              <div class="d-flex flex-column  mb-4">
                
                  <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Email<span class="text-danger">*</span></label>
                      <input type="email" id="email" class="form-control form-control" name="email"  autocomplete="off" >
                      <span style="display: none;color:red;" id="emailrequired"> Email  is required.</span>
                      <span id="message" style="color:red;"> </span>
                     
                  </div>
              </div>
    
              <div class="d-flex flex-column mb-4">
                  <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Password<span class="text-danger">*</span></label>
                      <input type="password" id="pass" class="form-control form-control" name="pass" autocomplete="off" >
                      <span style="display: none;color:red;" id="password"> Password is required.</span>
                     
                  </div>
              </div>
    
              <div class="d-flex mx-4 mb-3 mb-lg-4">
                
                  <input id="FormData" name="Register"  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" value="Register">
              
                </div>
    
              <div class="text-center">

                  <span class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></span>
             
                </div>
          </form>
          </div>
          <div class="card-footer text-muted text-center">
             Register Footer 
          </div>
      </div>
  </div>
</div>
<?php include_once('footer.php'); ?>




