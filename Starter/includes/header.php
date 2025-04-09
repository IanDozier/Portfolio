<!DOCTYPE html>
<?php session_start(); ?>
<!-- Ian Dozier -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <script src="styles/script.js" defer></script>
    <title>Ian Dozier's Portfolio</title>
</head>
<body>
    <header>
        <nav>
        <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
            <ul id = "nav">
                <?php if (empty($_SESSION['name'])) {?>
                <li><a href="info.php" <?php if ($currentPage == 'info.php') {echo 'id="here"'; } ?>>Register</a></li>
                <li><a href="login.php" <?php if ($currentPage == 'login.php') {echo 'id="here"'; } ?>>Login</a></li>
                <li>About Me</li>
                <li>Academics</li>
                <li>Experiences</li>
                <li><a href="contact_me.php" <?php if ($currentPage == 'contact_me.php') {echo 'id="here"'; } ?>>Contact Me</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['name'])) {?>
                <li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>About Me</a></li>
                <li><a href="academics.php" <?php if ($currentPage == 'academics.php') {echo 'id="here"'; } ?>>Academics</a></li>
                <li><a href="experiences.php" <?php if ($currentPage == 'experiences.php') {echo 'id="here"'; } ?>>Experiences</a></li>
                <li><a href="contact_me.php" <?php if ($currentPage == 'contact_me.php') {echo 'id="here"'; } ?>>Contact Me</a></li>
                <li><a href="logout.php" <?php if ($currentPage == 'logout.php') {echo 'id="here"'; } ?>>Logout</a></li>
                <?php } ?>
                
                

            </ul>
        </nav>
    </header>
    <div class="background">
    <!-- Just for the background -->
    </div>
    <main>
    <div class="profile-section">
        <button onclick="openLink('https://www.linkedin.com/in/ian-dozier-582b89260/')">
            <img src="styles/Profile photo.jpeg" alt="profile photo" class="profile-pic">
        </button>
    </div>