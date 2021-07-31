<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>iDiscuss - Coding Forums!</title>

</head>

<body>
    <?php include 'partials/navbar.php' ?>
    <?php 
     
    if( isset($_GET['signupsuccess']) &&  $_GET['signupsuccess'] == true){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Account Created!</strong> You can login now.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    

    if(isset($_GET['error'])){
        $showError=$_GET['error'];
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>'.$showError.'</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    $success = $_GET['loginsuccess'];
    if(isset($_GET['loginsuccess']) &&  $_GET['loginsuccess'] == true){
        $name=$_GET['username'];
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><span style="color:indianred">Welcome '.$name.', </span>Explore iDiscuss..!</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

    }

   
    if(isset($_GET['loginerror'])){
        $showError2 = $_GET['loginerror'];
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>'.$showError2.'</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

    }
    
    ?>

    <!--- Slider -->

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="c4.jpeg" height="650px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block color-loght">
                    <h5>Welcome to <span style="color:red">iDiscuss</span></h5>
                    <p><span style="color:AntiqueWhite">Post your questions here.</span></p>
                </div>

            </div>
            <div class="carousel-item">
                <img src="c5.jpeg" height="650px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block color-dark">
                    <h5><span style="color:OrangeRed">Let's learn together</span></h5>
                    <p><span style="color:DimGray">Discuss and Develop!</span> </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="c6.jpeg" height="650px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5><span style="color:IndianRed"> &nbsp &nbsp &nbspEnjoy</span><span style="color:indianred"> the Process</span></h5>
                    <p><span style="color:LightCyan		"> &nbsp &nbsp &nbspShare your knowledge.</span></p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" type="button" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" type="button" role="button" href="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <?php include 'partials/dbconnect.php' ?>



    <div class="container my-4">
        <h2 class="text-center my-3"><span style="color:red"> iDiscuss categories </span> </h2>
        
        
        <div class="row">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            $name=$_GET['username'];
           
            while ($row = mysqli_fetch_assoc($result)) {
                $cat = $row['category_name'];
                if (isset($_GET['loginsuccess']) &&  $_GET['loginsuccess'] == true) {
                    echo ' <div class="col-md-4 my-4">
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/1600x900/?' . $cat . ',laptop" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadlist.php?catid=' . $row['category_id'] . '">' . $cat . '</a></h5>
                            <p class="card-text">' . substr($row['category_description'], 0, 90) . '......</p>
                            <a href="threadlist.php?loginsuccess=true&username='.$name.'&catid=' . $row['category_id'] . '" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
                } else {
                    echo ' <div class="col-md-4 my-4">
                <div class="card" style="width: 18rem;">
                    <img src="https://source.unsplash.com/1600x900/?' . $cat . ',laptop" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?catid=' . $row['category_id'] . '">' . $cat . '</a></h5>
                        <p class="card-text">' . substr($row['category_description'], 0, 90) . '......</p>
                        <a href="threadlist.php?catid=' . $row['category_id'] . '" class="btn btn-primary">View Threads</a>
                    </div>
                </div>
            </div>';
                }

                

            }


            ?>

        </div>
    </div>
    <?php include 'partials/footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>