<!-- Ian Dozier -->
    <?php require('includes/header.php');?>
    <?php $name = $_SESSION['name']; ?>
    <section id="About Me" class="content-section">
        <div class="text-box">
        <?php echo "<h2> Welcome to my portfolio</h2>";?>
        <hr>
        <p align = "justify">
            Hi<?php if (isset($_SESSION['name'])) echo " $name"; ?>, my name is Ian Dozier and I created this portfolio to share my academic milestones and overall experiences as an undergraduate at the University of North Carolina at Wilmington.
            There isn't a lot to be said about me. I like to program, play video games, binge-watch movies.
            However, I deeply love to learn and I also really enjoy exercising. I'm originally from High Point, North Carolina which is the furniture
            capitol of the world. I came to love programming my first year at UNCW and how it felt like an awesome game that you just can't
            quit trying to beat. From endless error messages to changing one line of code and your computer freezes but, you keep typing and trying.
            Hoping to beat the game and learn something along the way. <b>Also did you click on my face at the top yet? Give it a try.</b>
        </p>
        </div>
    </section>
    <?php include('includes/footer.php'); ?>
    