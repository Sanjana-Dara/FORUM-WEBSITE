<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        $name = $_GET['username'];
    }
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $desc  = $_POST['desc'];
        $id = $_GET['catid'];

        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_user_email`, `thread_cat_id`, `time`) VALUES ('$title', '$desc', '$name', '$id', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Question posted!</strong> You can check for discussions below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id` = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>



    <div class="container my-4">
        <div class="jumbotron bg-light" style=" padding:50px 50px 50px 50px ">
            <h2 class="display-4">Welcome to <?php echo $row['category_name']; ?> forums</h2>
            <p class="lead"><?php echo $row['category_description']; ?></p>
            <hr class="my-4">
            <p>Any material which constitutes defamation, harassment, or abuse is strictly prohibited. Material that is sexually or otherwise obscene, racist, or otherwise overly discriminatory is not permitted on these forums. This includes user pictures.
                Use common sense while posting. This is a web site for accountancy professionals. .

            </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>

        </div>
    </div>





    <div class="container" style="min-height:500px">
        <h2 style="color:darkgray">Post your Question here!</h2>

        <?php if (isset($_GET['loginsuccess']) &&  $_GET['loginsuccess'] == true) {
            echo '
          <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="form-group">
                <label for="title">Problem Title</label>
                 <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter problem title">
                <small id="titleHelp" class="form-text text-muted">Make sure yout title is short and crisp.</small>
            </div>
            <div class="form-group">
                <label for="desc">Elaborate your problem</label>
                <textarea class="form-control" name="desc" id="desc" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-dark my-2">Post</button>
         </form>';
        } else {
            echo '<div class="container my-4 text-muted"><--Please login to be able to post questions--></div>';
        }


        ?>

        <h2 class="py-2"><span style="color:darkgoldenrod">Browse Questions</span></h2>

        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id ";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            if (isset($_GET['loginsuccess']) &&  $_GET['loginsuccess'] == true) {

                echo '<div class="media my-4">
            <img style="float:left" class="mr-3" src="user.jpeg" width="54px" alt="...">
            <div class="media-body">
            <h5 class="mt-0 text-muted" style="font-size:1rem">' . $row['thread_user_email'] . '<span class="text-muted" style="font-size:0.8rem">' . '[' . $row['time'] . ']' . '</span>' . '</h5>'
                    . '<h5 class="mt-0"><a class="text-dark" href="thread.php?loginsuccess=true&username=' . $name . '&threadid=' . $row['thread_id'] . '">' . $row['thread_title'] . '</a></h5>' . $row['thread_desc'] . '
            </div>
        </div>';
            } else {
                echo '<div class="media my-4">
                <img style="float:left" class="mr-3" src="user.jpeg" width="54px" alt="...">
                <div class="media-body">
                <h5 class="mt-0 text-muted" style="font-size:1rem">' . $row['thread_user_email'] . '<span class="text-muted" style="font-size:0.8rem">' . '[' . $row['time'] . ']' . '</span>' . '</h5>'
                    . '<h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $row['thread_id'] . '">' . $row['thread_title'] . '</a></h5>' . $row['thread_desc'] . '
                </div>
            </div>';
            }
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid bg-light">
            <div class="container" style="padding:50px 50px 50px 50px">
                <h2 class="display-4">No Questions Found</h2>
                <p class="lead">Be the first to post a question.</p>
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