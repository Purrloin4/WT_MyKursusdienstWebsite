<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courses</title>
  <link rel="stylesheet" href="css/StyleCourses.css">
</head>

<body>

<header class = "header">

  <div class = logo>
    <h1>MyCouBooks</h1>
    <h2>A Webtech demo site</h2>
  </div>

  <nav>
    <li><a href="MyKursusdienstWebsite.php ">Home</a></li>
    <li><a href="courses.php">Courses</a></li>
    <li><a href="reservation.php">Reservation</a></li>
    <li><a href="About.html">About</a></li>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  </nav>
</header>

<main class = "main">

  <p>Below you can find an overview of all available courses.</p>

    <?php

    require_once('php/models/Course.php');
    require_once('php/models/Book.php');

    foreach (course::getAllCourses() as $course) {
        echo '<h3>' . $course->getname() . '</h3>';
        echo '<ul>';
        $books = book::getBooksByCourseId($course->getId());
        foreach ($books as $book) {
            echo '<li>' . $book->getTitle() . '</li>';
        }
        echo '</ul>';
    }
    ?>

</main>


<footer class = "footer">
  <p> Copyright © 2022 WebTech. KUL All Rights Reserved. <a href="/PRIVACY POLICY/">Privacy Policy</a> | <a href="/TERMS OF USE/">Terms of Use </a></p>

</footer>

</body>
</html>