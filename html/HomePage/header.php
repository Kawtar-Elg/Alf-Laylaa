<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>

    <!-- Custom CSS -->
    <link href="../../css/section1.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />

     <!-- Font Awesome -->
     <link
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
         rel="stylesheet" />

         <?php include '../LoginSysteme/SignIn.html'; ?>
         <?php include '../LoginSysteme/SignUp.html'; ?>
         
     <header>
         <!-- Navigation -->
         <nav class="navbar navbar-expand-lg fixed-top my-navbar">
             <div
                 class="container d-flex justify-content-between align-items-center">
                 <a class="navbar-brand" href="#">
                     <img src="../../assets/logo.png" alt="Logo" class="logo-img" />
                 </a>
                 <div
                     class="collapse navbar-collapse justify-content-center"
                     id="navbarNav">
                     <ul class="navbar-nav d-flex gap-4">
                         <li class="nav-item">
                             <a class="nav-link" href="#home">Home</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#about">About Us</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#rtl">Our Hotels</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#reviews">Reviews</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#contact">Contact Us</a>
                         </li>
                     </ul>
                 </div>
                 <a class="btn-login text-light" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                 <a class="btn-login text-light" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
             </div>
         </nav>
     </header>