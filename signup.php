<?php
include_once 'header.php';
?>

<section>

    <h2> Sign Up </h2>
    <form action="signup_inc.php" method="post">

        <input type="text" name="name" placeholder="Fullname"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="text" name="uid" placeholder="Username"><br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <input type="password" name="pwdrepeat" placeholder="Repeat Password"><br>
        <button type="submit" name="submit">Sign Up </button>


    </form>

</section>




<?php
include_once 'footer.php';
?>