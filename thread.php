<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Use an element to toggle between a like/dislike icon -->
    <style text="css">
        a:link {
            text-decoration: none;
        }

        a:visited {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        a:active {
            text-decoration: none;
        }
    </style>

    <title>iDiscuss - Coding Forums!</title>

</head>

<body>



    <?php include 'partials/navbar.php' ?>
    <?php include 'partials/dbconnect.php' ?>
    <?php
    if (isset($_GET['loginsuccess']) &&  $_GET['loginsuccess'] == true) {
        $name=$_GET['username'];
        
    }
    else{
        $name = "AnanymousUser";
    }
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$user_id = $_POST['title'];
        $comment  = $_POST['comment'];
        $id = $_GET['threadid'];

        $sql = "INSERT INTO `comments` (`comment_content`, `comment_user_email`, `thread_id`, `date`) VALUES ('$comment', '$name', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Comment posted!</strong> You can check below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>


    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE `thread_id` = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>



    <div class="container my-4">
        <div class="jumbotron bg-light" style=" padding:50px 50px 50px 50px ">
            <h2 class="display-4"> <?php echo $row['thread_title']; ?></h2>
            <p class="lead"><?php echo $row['thread_desc']; ?></p>
            <hr class="my-4">
            <p>Any material which constitutes defamation, harassment, or abuse is strictly prohibited. Material that is sexually or otherwise obscene, racist, or otherwise overly discriminatory is not permitted on these forums. This includes user pictures.
                Use common sense while posting. This is a web site for accountancy professionals. .

            </p>
            <p><b> Posted by:<?php echo $row['thread_user_email']; ?></b></p>

        </div>
    </div>

    <div class="container" style="min-height:500px">
        <h2 style="color:darkgray">Post your comment here!</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            
            <div class="form-group">
                <label for="comment">Give your comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-dark my-2">Post</button>
        </form>
        <h2 class="py-2"><span style="color:cadetblue">Discussions</span></h2>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id ";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult=false;
            
            echo '<div class="media my-4">
            <img style="float:left" class="mr-3" src="user.jpeg" width="54px" alt="...">
            <div class="media-body">
                <h5 class="mt-0 text-muted">' .$row['comment_user_email']. '<span class="text-muted" style="font-size:0.8rem">'.'['.$row['date'].']'.'</span>' . '</h5>' . $row['comment_content'] . '
            </div>
        </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid bg-light">
            <div class="container" style="padding:50px 50px 50px 50px">
                <h2 class="display-4">No Comments Found</h2>
                <p class="lead">Be the first one to post a comment.</p>
            </div>
        </div>';
        }



        ?>
    </div>
    <?php include 'partials/footer.php' ?>


   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>