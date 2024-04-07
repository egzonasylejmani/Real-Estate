<?php

include_once("../components/header.php");
include_once('../codes/contact_form.php');

if( isset($_SESSION['user_id']) && isset($_SESSION['role']) ) {
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['role'];
} else {
    redirect('', 'index.php');
}

$contactForm = new ContactFormController();

$listings = $contactForm->getAllContacts($user_role);
?>

<div class="container mx-auto py-5 flex-estate flex-col">
    <?php include_once('../components/message.php'); ?>
    <div class="table">
        <table>
            <tr>
                <th>Email</th>
                <th>Email</th>
                <th>Message</th>
                <th>View</th>
            </tr>

            <?php foreach ($listings as $listing) : ?>
                <tr>
                    <td><?= htmlspecialchars($listing['full_name']) ?></td>
                    <td><?= htmlspecialchars($listing['email']) ?></td>
                    <td><?= htmlspecialchars($listing['message']) ?></td>
                    <td>
                        <a href="<?= about_url('view.php?id=' . $listing['id']) ?>">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>


<?php
include_once("../components/footer.php");


?>