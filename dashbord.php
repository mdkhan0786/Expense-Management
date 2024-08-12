<?php 

include('header.php');
include('function.php');
include('InModel.php');
include('expenseModel.php');
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
<link rel="stylesheet" href="assest/css/main.css">

<div class="jumbotron bg-">
    <div class="container pt-3">
        <nav class="navbar navbar-light bg-primary p-3 justify-content-between">
        <a class="navbar-brand text-light"><i class="fa fa-tachometer" aria-hidden="true"></i> Expense Management</a>
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
                        
                       <a class="nav-link text-dark toggle-submenu" href="javascript:void(0);"> <i class="fa fa-tachometer" aria-hidden="true">  Dashboard </i> <span class="toggle-icon" style="float: right"></span></a>
<!--                           
                        <li class="nav-item">
                       <a class="nav-link text-dark toggle-submenu" href="#"> <i class="fa fa-inr" aria-hidden="true"> Income </i> <span class="toggle-icon" style="float: right">+</span></a>
                            <ul class="submenu">
                                <li> <a class="nav-link active text-dark" data-toggle="modal" data-target="#exampleModalCenter" href="#">Add Income</a></li>
                                <li> <a class="nav-link active text-dark" href="">Display Income</a></li>
                            </ul>
                        </li>
                         -->
                        <li class="nav-item">
                            <a class="nav-link text-dark toggle-submenu" href="#"> <i class="fa fa-address-card-o" aria-hidden="true"> Expense </i><span class="toggle-icon"  style="float: right">+</span></a>
                            <ul class="submenu">
                                <li> <a class="nav-link active text-dark" data-toggle="modal" data-target="#exampleModalExpense" href="javascript:void(0);">Add Expense</a></li>
                                <li> <a class="nav-link active text-dark" href="#">Show Expense</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark toggle-submenu" href="javascript:void(0);"> <i class="fa fa-file-word-o" aria-hidden="true">  Expense Report  </i> <span class="toggle-icon"  style="float: right">+</span></a>
                            <ul class="submenu">
                                <li> <a class="nav-link active text-dark" href="#">View Expense Report</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                       
                            <a class="nav-link text-dark toggle-submenu" href="javascript:void(0);"> <i class="fa fa-user"> User </i> <span class="toggle-icon"  style="float: right">+</span></a>
                            
                            <ul class="submenu">
                                <li><a class="nav-link text-dark" href="user.php">Show User</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="modal" data-target="#exampleModalPassword" href="javascript:void(0);"><i class="fa fa-password">  Change Password </i><span class="toggle-icon"  style="float: right">+</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--***************************** main content*****************************************-->

            <div class="col-md-8 col-lg-8 col-sm-8">
              <h1 class="pt-3 text-danger"> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</h1>
             <hr>
             <section class="pb-4">
             <div class="border rounded-5">
                <section class="w-100 p-4 d-flex justify-content-center">
                <script type="text/javascript">
                window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light1", // "light2", "dark1", "dark2"
                    animationEnabled: false, // change to true		
                    title:{
                        text: "Basic Column Chart"
                    },
                    data: [
                    {
                        // Change type to "bar", "area", "spline", "pie",etc.
                        type: "column",
                        dataPoints: [
                            { label: "apple",  y: 10  },
                            { label: "orange", y: 15  },
                            { label: "banana", y: 25  },
                            { label: "mango",  y: 30  },
                            { label: "grape",  y: 28  }
                        ]
                    }
                    ]
                });
                chart.render();

                }
                </script>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"> </script>

                </section>
            </section>
            </div>
        </div>
    </div>
</div>

<!-- <script>
     $(document).ready(function() {
        $('.toggle-submenu').click(function() {
            $(this).next('.submenu').slideToggle();
            $(this).find('.toggle-icon').text(function(_, text) {
                return text === '+' ? '-' : '+';
            });
            $('.toggle-submenu').not(this).find('.toggle-icon').text('+');
        });
    })
</script> -->

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
</script>
<?php include('footer.php') ?>