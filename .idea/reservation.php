<?php
require_once('shop.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>reservation</title>
  <meta name = "Cédric" content = "HomepageKursusdienst">
  <link rel="stylesheet" href="StyleReservation.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>

<header class = "header">

  <div class = logo>
    <h1>COUBOOKS</h1>
    <h2>A Webtech demo site</h2>
  </div>

  <nav>
    <li><a href="MyKursusdienstWebsite.php">Home</a></li>
    <li><a href="courses.html">Courses</a></li>
    <li><a href="reservation.html">Reservation</a></li>
    <li><a href="about.html">About</a></li>
  </nav>

</header>

<main>

  <section class = "step1">
  <h2>STEP 1: WHO ARE YOU</h2>
  <p>Please provide some info about you, so we can search for the books you need...</p>

  <div class = "fase&email">
      <label for="fase">Fase:</label>
      <select name="fase" id="fase">
        <option value="1">First Bachelor</option>
        <option value="2">Second Bachelor</option>
        <option value="3">Third Bachelor</option>
      </select>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Your email address">
  </div>
      <button type="button" class="default-btn next-step">Continue to next step</button>
  </section>
    <section class = "step2">
  <h2>STEP 2: WHAT BOOKS DO YOU NEED?</h2>
  <p>Select the books you wish to order ...</p>
    <div class = "books">
        <input type="checkbox" id="book1" name="book1" value="book1">
        <label for="book1"> Computer Networking: A Top Down Approach</label><br>
        <input type="checkbox" id="book2" name="book2" value="book2">
        <label for="book2"> Silberschatz's Operating System Concepts</label><br>
    </div>
        <button type="button" class="default-btn next-step">Continue to next step</button>
    </section>

<section class = "step3">
  <h2>YOU HAVE ORDERED...</h2>
  <p>Below you find an overview of the books you have reserved. Once you confirm your reservation you pick them up at our KD and pay at the desk</p>
  /* TODO: list of selected books in step2 */
    <button type="button" class="default-btn next-step">Continue to next step</button>
</section>

</main>

<footer class = "footer">
  <p> Copyright © 2022 WebTech. KUL All Rights Reserved. <a href="/PRIVACY POLICY/">Privacy Policy</a> | <a href="/TERMS OF USE/">Terms of Use </a></p>

</footer>
</body>
</html>