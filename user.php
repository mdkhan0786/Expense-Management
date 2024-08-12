<?php 
include('header.php');
include('function.php');
include('InModel.php');
include('expenseModel.php');
include('connection.php');
include('editModel.php');

if (!isset($_SESSION['logged'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}
// Get the logged-in user's email
$loggedInUser = $_SESSION['logged'];
?>
<link rel="stylesheet" href="assest/css/main.css">
<style>
    .navbar{
        border-radius:14px;
    }
</style>
<!--*****************Model Section***********-->

<div class="jumbotron bg-">
    <div class="container pt-3">
        <nav class="navbar navbar-light bg-primary p-3 justify-content-between">
        <a class="navbar-brand text-light"><i class="fa fa-tachometer" aria-hidden="true"></i> InCome Dashboard</a>
        <form class="form-inline" method="post">
            <input type="submit" name="logout" class="btn btn-light border" value="Log Out">
            
        </form>
        </nav>
    </div>
    
    <div class="container ">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="sidebar bg-light">
                    <div class="div p-4">
                        <button type="button" class="btn btn-light p-1 border">
                        <span class="select">
                        <img src="assest/images/irfan.png" width="40%" style="text-align: left;">
                        <?php echo htmlspecialchars($loggedInUser); ?>
                        </span> 
                        </button>

                    </div>
                    <hr class="hr">

                    <ul class="nav flex-column mt-3">
                        <li class="nav-item ">
                        </li>
                        <a class="nav-link text-dark toggle-submenu" href="dashbord.php"> <i class="fa fa-tachometer" aria-hidden="true">  Dashboard </i> <span class="toggle-icon" style="float: right"></span></a>
<!--                        
                        <li class="nav-item">
                       <a class="nav-link text-dark toggle-submenu" href="#"> <i class="fa fa-inr" aria-hidden="true"> Income </i> <span class="toggle-icon" style="float: right">+</span></a>
                            <ul class="submenu">
                                <li> <a class="nav-link active text-dark" data-toggle="modal" data-target="#exampleModalCenter" href="#">Add Income</a></li>
                                <li> <a class="nav-link active text-dark" href="">Display Income</a></li>
                            </ul>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link text-dark toggle-submenu" href="javascript:void(0);"> <i class="fa fa-address-card-o" aria-hidden="true"> Expense </i><span class="toggle-icon"  style="float: right">+</span></a>
                            <ul class="submenu">
                                <li> <a class="nav-link active text-dark" data-toggle="modal" data-target="#exampleModalExpense" href="#">Add Expense</a></li>
                                <li> <a class="nav-link active text-dark" href="javascript:void(0);">Show Expense</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark toggle-submenu" href="javascript:void(0);"> <i class="fa fa-file-word-o" aria-hidden="true">  Expense Report  </i> <span class="toggle-icon"  style="float: right">+</span></a>
                            <ul class="submenu">
                                <li> <a class="nav-link active text-dark" href="javascript:void(0);">View Expense Report</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                       
                            <a class="nav-link text-dark toggle-submenu" href="#"> <i class="fa fa-user"> User </i> <span class="toggle-icon"  style="float: right">+</span></a>
                            
                            <ul class="submenu">
                                <li><a class="nav-link text-dark" href="javascript:void(0);">Show User</a></li>
                            </ul>
                        </li>

                        <li  data-toggle="modal" data-target="#exampleModalChangePassword">
                        <a class="nav-link text-dark" data-toggle="modal" data-target="#exampleModalPassword" href="javascript:void(0);"><i class="fa fa-password">  Change Password </i><span class="toggle-icon"  style="float: right">+</span></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8 col-lg-8 col-sm-8">
              <h1 class="pt-3 "> <i class="fa fa-user" aria-hidden="true"></i> User Data</h1>
             <hr>
             <section class="pb-4">
             <div class="border rounded-5">
                <section class="w-100 p-4 d-flex justify-content-center">

                <!--*****Usert Data *******-->
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <?php
                
                   
                    $data = mysqli_query($conn,"SELECT * FROM register");
                    if(mysqli_num_rows($data) > 0){
                        while($row=mysqli_fetch_assoc($data)){
                        ?>
                        <tbody>
                        <tr>
                        <th><?php echo $row['ID']; ?></th>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['Craated_date']; ?></td>
                        <td>
                            <a href="#" id="EditUserBtn" data-id="<?php echo $row['ID'] ?>" data-name="<?php echo $row['name']?>" data-email="<?php  echo $row['email'];  ?>" data-toggle="modal" data-target="#exampleModalEdit" class="btn btn-primary EditUserBtn"> <i class="fa fa-edit"></i> </a>
                            ||
                            <a href="#" id="DeleteUser" delete-id="<?php echo $row['ID'] ?>" data-toggle="modal" data-target="#exampleModalDelete" class="btn btn-danger DeleteUserBtm"><i class="fa fa-trash"></i></a>
                        </td>
                        </tr>
                        </tbody>
                    <?php
                        }
                    }
                    ?>
                    </table>
                </section>
            </section>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Hide all submenus initially
    $('.submenu').hide();
    $('.toggle-submenu').click(function() {
        // Close all submenus except the one being toggled
        $('.submenu').not($(this).next('.submenu')).slideUp();
        // Toggle the submenu for the clicked item
        $(this).next('.submenu').slideToggle();
        // Update the icon for the clicked item
        $(this).find('.toggle-icon').text(function(_, text) {
            return text === '+' ? '-' : '+';
        });
        // Reset the icons for all other items
        $('.toggle-submenu').not(this).find('.toggle-icon').text('+');
    });
});

    $(document).ready(function(){
        $('.EditUserBtn').click(function(){
            var $GetUserId = $(this).attr('data-id');
            var $GetUserName = $(this).attr('data-name');
            var $GetUserEmail = $(this).attr('data-email');

            $('#UserId').val($GetUserId);
            $('#userName').val($GetUserName);
            $('#UserEmail').val($GetUserEmail);
        })
    })

//Update user Ajax
    $(document).ready(function(){
    $('#UpdateBtn').click(function(){
        var $updateName = $('#userName').val();
        var $updateEmail = $('#UserEmail').val();
        var $updateId = $('#UserId').val();
    
        $.ajax({
            url: 'editModel.php',
            type: 'post',
            data: {
                Name: $updateName,
                Email: $updateEmail,
                UserId: $updateId,
            },
            success: function(response) {
                toastr.success('User Updated Successfully!', '', {
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


//Delete
$(document).ready(function(){
    $('.DeleteUserBtm').click(function(){
        var $GetUserDeleteId = $(this).attr('delete-id');
        $('#UserDeleteId').val($GetUserDeleteId);
    })
})
//Delete User Ajax
$(document).ready(function(){
    $('#DeleteBtn').click(function(){
        var $Id = $('.UserDeleteId').val();
        $.ajax({
            url: 'editModel.php',
            type: 'post',
            data: {
                UserIdDelete : $Id
            },
            success: function(response) {
                toastr.success('User Deleted SuccessFully!', '', {
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

//Change Password Ajax


</script>
<?php include('footer.php') ?>