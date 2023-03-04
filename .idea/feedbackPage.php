<?php
require_once ('Database.php');
require_once('Feedback.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $text = $_POST['feedback'];
    $feedback = new Feedback($author, $text);
    $feedback->save();

    if ($feedback->getId()) {
        echo "<script>alert('Feedback submitted successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>feedback</title>
  <meta name = "Cédric" content = "feedback">
  <link rel="stylesheet" href="StyleFeedback.css">
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
  <h2>ADD FEEDBACK...</h2>
    <form action="feedbackPage.php" method="post">
    <label for="author">Author:</label>
    <input type="text" id="author" name="author" placeholder="Your name.." required>

    <label for="feedback">Feedback:</label>
    <textarea id="feedback" name="feedback" placeholder="Write something.." style="height:50px" required></textarea>

    <input type="submit" value="Submit">
    </form>
</main>

<footer class = "footer">
  <p> Copyright © 2022 WebTech. KUL All Rights Reserved. <a href="/PRIVACY POLICY/">Privacy Policy</a> | <a href="/TERMS OF USE/">Terms of Use </a></p>
</footer>

</body>
</html>