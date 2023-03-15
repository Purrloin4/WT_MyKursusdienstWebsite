<?php

require_once('php/Shop.php');

$shop = new Shop();

if (isset($_POST['submit'])) {
    $shop->processStep($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>reservation</title>
    <meta name="Cédric" content="HomepageKursusdienst">
    <link rel="stylesheet" href="css/StyleReservation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet">
</head>
<body>

<header class="header">

    <div class=logo>
        <h1>COUBOOKS</h1>
        <h2>A Webtech demo site</h2>
    </div>

    <nav>
        <li><a href="MyKursusdienstWebsite.php">Home</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="reservation.php">Reservation</a></li>
        <li><a href="About.html">About</a></li>
    </nav>

</header>

<main>

    <?php if ($shop->getStep() == 1) { ?>
        <section class="step1">
            <h2>STEP 1: WHO ARE YOU</h2>
            <form action="" method="post">
            <p>Please provide some info about you, so we can search for the books you need...</p>
                <div class="fase&email">
                    <label for="fase">Fase:</label>
                    <select name="fase" id="fase">
                        <option value="1">First Bachelor</option>
                        <option value="2">Second Bachelor</option>
                        <option value="3">Third Bachelor</option>
                    </select>

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Your email address">
                </div>
                <button type="submit">Continue to next step</button>
            </form>
        </section>

    <?php } elseif ($shop->getStep() == 2) { ?>
        <section class="step2">
            <h2>STEP 2: WHAT BOOKS DO YOU NEED?</h2>
            <form action="" method="post">
                <p>Select the books you wish to order ...</p>
                <div class="books">
                    <?php
                    foreach ($shop->getBooksPossible() as $book) {
                        $bookTitle = $book->getTitle();
                        $bookId = $book->getId();
                        echo "<div class='book'>
                                <input type='checkbox' id='$bookId' name='books[]' value='$bookId'>
                                <label for='$bookId'>$bookTitle</label>
                            </div>";
                    }
                     ?>

                </div>
                }
                <button type="submit">Continue to next step</button>
            </form>
        </section>

    <?php } elseif ($shop->getStep() == 3) { ?>
        <section class="step3">
            <form action="" method="post">
                <h2>YOU HAVE ORDERED...</h2>
                <p>Below you find an overview of the books you have reserved. Once you confirm your reservation you pick
                    them up at our KD and pay at the desk</p>
                <div class="books">
                    <ul>
                        <?php
                        foreach ($shop->getBooksSelected() as $book) {
                            $bookTitle = $book->getTitle();
                            echo "<li>$bookTitle</li>";
                        }
                         ?>

                    </ul>
                    <button type="submit">Continue to next step</button>
            </form>
        </section>
    <?php } ?>
</main>

<footer class="footer">
    <p> Copyright © 2022 WebTech. KUL All Rights Reserved. <a href="/PRIVACY POLICY/">Privacy Policy</a> | <a
                href="/TERMS OF USE/">Terms of Use </a></p>

</footer>
</body>
</html>