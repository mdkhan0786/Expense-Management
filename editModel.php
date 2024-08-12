
<?php
include('header.php');

$server ="localhost";
$user = "root";
$password = "";
$db = "phpdb";
$conn = new mysqli($server,$user,$password,$db);
if($conn->connect_error){
    die("Connection failed" . $conn->connect_error);
}
//Update User
if(isset($_POST['Name']) || isset($_POST['Email'])) {

    print_r($_POST);
    echo "helo";
    $userName =$_POST['Name'];
    $userEmail = $_POST['Email'];
    $userId = $_POST['UserId'];
    $UpdateQuery = "UPDATE register SET name='$userName', email='$userEmail' WHERE ID='$userId'";
    $update = mysqli_query($conn, $UpdateQuery);
    }

     //Delete User
  if(isset($_POST['UserIdDelete'])){
    $DeleteId=$_POST['UserIdDelete'];
    $Delete_Query=mysqli_query($conn,"DELETE FROM register WHERE ID = '$DeleteId'");
}

//Password Changing 
if(isset($_POST['changePassword'])){
    
    $loggId = $_SESSION['loggID'];
    $reset_value = $_POST['changePassword'];

    $Password_change ="UPDATE register SET password = '$reset_value' WHERE ID = '$loggId' ";
    $Password = mysqli_query($conn,$Password_change);
}
  
?>

<div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update User</h5>
             <button type="button" class="close" style="margin-left:300px" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
            </button> 
        </div>
        <form method="post">
            <div class="modal-body">
            
                    <input type="hidden" name="UserId" id="UserId" value="">
                    <div class="row">
                        <div class="col">
                            <label>User Name</label>
                        <input type="text" name="userName" id="userName"  class="form-control">
                        </div>
                        <div class="col">
                            <label> User Email </label>
                        <input type="text" name="userEmail" id="UserEmail" class="form-control">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="UpdateBtn" id="UpdateBtn" class="btn btn-primary">Update</button>
            </div>
        </form>

        </div>
    </div>
</div>

<!--*****************deleted Model from here************-->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header ">
            <h5 class="modal-title text-center" id="exampleModalLongTitle"> Do you Want to Delete User ?</h5>
<!-- 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> -->

        </div>
        
        <div class="modal-body">
            <form method="post">
            <input type="hidden" class="UserDeleteId" name="UserDelete" id="UserDeleteId" name="UserDeleteId" value="">
                <div class="row text-center ">
                   <h4> <i class="fa fa-trash border text-danger" style="border-radius: 300px;"> : Delete </i></h4>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
            <button type="button" id="DeleteBtn" class="btn btn-danger">Yes</button>
        </div>
        </div>
    </div>
</div>
<!--*****************change Password model***************-->
<div class="modal fade" id="exampleModalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Reset Your Password</h5>
        </div>
        <form method="post">
            <input type="hidden" class="LoggedUserId" id="LoggedUserId" name="LoggedUserId" value=""> 
            <div class="modal-body">
                    <input type="hidden" name="UserId" id="UserId" value="">
                    <div class="row">
                <div class="col">
                    <label>Enter New Password</label>
                    <input type="text" name="passwordChange" id="passwordChange" class="form-control passwordChange">
                    <div id="passwordFeedback" style="color: red; display: none;">Password must be at least 8 characters,at least one uppercase letter, lowercase, number, and one special character.</div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="ResetBtn" id="ResetBtn" class="btn btn-primary ResetBtn">Reset Password</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#passwordChange').on('input', function() {
        var password = $(this).val();
        var strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;
        if (strongPasswordPattern.test(password)) {
            $('#passwordFeedback').hide();
            $(this).css('border-color', 'green');
        } else {
            $('#passwordFeedback').show();
            $(this).css('border-color', 'red');
        }
    });
});

$(document).ready(function(){
    $('#ResetBtn').click(function(){
        var $password_change_value = $('.passwordChange').val();
        alert($password_change_value);

        $.ajax({
            url: 'editModel.php',
            type: 'post',
            data: {
                changePassword : $password_change_value
            },
            success: function(response) {
                toastr.success('Password Change Successfully!', '', {
                    positionClass: 'toast-top-center'
                });
                // Redirect to another page after 2 seconds
                setTimeout(function() {
                    window.location.href = 'user.php';
                }, 2000); // 2000 milliseconds = 2 seconds
            },
            error: function(xhr, status, error) {
                toastr.error('Error occurred while updating the record.', '', {
                    positionClass: 'toast-top-center'
                });
            }
        });
    });
});

</script>

<?php include('footer.php'); ?>


