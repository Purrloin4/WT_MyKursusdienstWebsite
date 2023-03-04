<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyKursusdienst</title>
    <meta name = "Cédric" content = "HomepageKursusdienst">
    <link rel="stylesheet" href="StyleHomePage.css">
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

<main class = "main" >

    <section class = "info">
        <h2><?php
            require_once('Greeter.php');
            $greeter = new Greeter();
            echo $greeter->getGreeting() . ', welcome to the CouBooks website!';
            ?></h2>
        <h3>Are you ready to study ?</h3>
        <p>When in need for the conect course books or printed slides, you should have a look to our
            course book website for EA. Here you can find an overview of all course material that is
            needed for every course within the EA program. Select your fase and see what is needed...
            <br/> <br/>
            This <strong>Course Book Service</strong> site is specially designed as a demonstration for the web
            technology course. In the end, this page can be found on the development web server
            <a href = "https://studev.groept.be" target="_blank"> studev.groept.be</a> Within this demonstration we will step-by-step create this site.</p>
    </section>

    <aside>
        <hr  class = "line"> </hr>
        <h3>Opening Hours :</h3>
        <ul>
            <li> Mon: 9am-11am</li>
            <li> Tue: 1pm-4pm</li>
            <li> Fri: 1pm-4pm</li>
        </ul>

        <h3>Feedback</h3>
        <?php
        require_once ('Database.php');
        require_once('Feedback.php');
        $feedback = Feedback::getAllFeedback();
        foreach ($feedback as $item) {
            echo '<p>' . $item->getText() . ' (' . $item->getAuthor() . ')' . '</p>';
        }
        ?>
        <a href= "feedbackPage.php"> Add feedback... </a>
    </aside>

</main>

<footer class = "footer">
    <p> Copyright © 2022 WebTech. KUL All Rights Reserved. <a href="/PRIVACY POLICY/">Privacy Policy</a> | <a href="/TERMS OF USE/">Terms of Use </a></p>

</footer>
</body>
</html>

