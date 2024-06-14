
<header class="container">
    <span class="logo">logo</span>
    <nav>
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/about.php">About us</a></li>

            <?php
            if (isset($_COOKIE['login'])) {
                echo '<li><a href="/user.php">Personal account</a></li>';
            }else {
                echo '<li><a href="/registration.php">Registration</a></li>
                      <li><a href="/authorization.php">Authorization</a></li>';
            }
            ?>

            <li class="btn"><a href="/contacts.php">Contacts</a></li>
        </ul>
    </nav>
</header>
