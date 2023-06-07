<?php
include_once 'header.php';
?>

<section>

    <h2> Log In </h2>
    <form action="login_inc.php" method="post">

        <input type="text" name="uid" placeholder="Username/Email"><br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <button type="submit" name="submit">Log In</button>


    </form>

</section>




<?php
include_once 'footer.php';
?>