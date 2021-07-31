<?php
 if (!(isset($_GET['loginsuccess']) &&  $_GET['loginsuccess'] == true) ){

    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<a class="navbar-brand" href="#">iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="/Myphp/FORUMS/index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Myphp/FORUMS/partials/about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories List
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item disabled" href="#">Python</a>
        <a class="dropdown-item disabled" href="#">Java Script</a>
        <a class="dropdown-item disabled" href="#">Django</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Myphp/FORUMS/partials/contact.php">Contact</a>
    </li>
    
  </ul>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
  </form>

    <div class="mx-2">
    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal1">Login
</button>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2">
  SignUp
</button>
    </div>

    
  </div>
</nav>';
}

 include 'partials/loginmodal.php'; 
 include 'partials/signupmodal.php';
 
 if (isset($_GET['loginsuccess']) &&  $_GET['loginsuccess'] == true) {
  
  $name=$_GET['username'];
   echo '<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<a class="navbar-brand" href="#">iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item ">
      <a class="nav-link" href="/Myphp/FORUMS/index.php?loginsuccess=true&username='.$name.'">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Myphp/FORUMS/partials/about.php?loginsuccess=true&username='.$name.'">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item disabled" href="#">Python</a>
      <a class="dropdown-item disabled" href="#">Java Script</a>
      <a class="dropdown-item disabled" href="#">Django</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Myphp/FORUMS/partials/contact.php?loginsuccess=true&username='.$name.'">Contact</a>
    </li>
    
  </ul>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
    
       
   
  </form>
  <ul class="navbar-nav ">
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        '.$name.'
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="partials/logout.php">Logout</a>
       
    </li>
    </ul>
  

  

    

    
  </div>
</nav>';

 }

 
 ?>