<?php

include_once("../components/header.php");
include_once('../config/app.php');

if( isset($_SESSION['user_id']) ) {
    $user_role = $_SESSION['role'];
} else {
    redirect('', 'index.php');
}

?>

<div class="wrapper">
  <ul class="flex-dashboard cards">
    <?php if ($user_role === 1) : ?>
        <li><h2> <a href="<?= user_url('index.php') ?>">Users</a></h2>
            <p>Welcome admin!We're delighted to have you here. This dashboard is your personalized space where you can manage your account, access important information, and stay connected.</p>
        </li>
    <?php endif; ?>
    <li><h2> <a href="<?= estate_url('index.php') ?>">RealEstate</a>
        </h2>
        <p>Hello Admin,Explore Real Estate:
Dive into the world of real estate and manage property listings, view analytics, and stay updated on the latest trends in the market.

Your gateway to efficient real estate management starts here.</p>
    </li>
    <?php if ($user_role === 1) : ?>
        <li><h2><a href="<?= about_url('index.php') ?>">About Us</a></h2>
            <p?>Welcome Admin,Learn more about our mission, values, and the team behind our platform.</p>    
        </li>
    <?php endif; ?>
    <?php if ($user_role === 1) : ?>
        <li><h2><a href="<?= url('contact/index.php') ?>">Contact Us</a></h2>
            <p>Dear Admin,Contact Us:Need assistance or have questions? The Contact Us section allows you to reach out to our dedicated support team. Feel free to send us your inquiries, feedback, or suggestions.
We're here to help!
            </p>    
        </li>
    <?php endif; ?>
</ul>
</div>



<?php
include_once("../components/footer.php");


?>