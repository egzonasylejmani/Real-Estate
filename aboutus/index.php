<?php

include_once("../components/header.php");
include_once('../codes/aboutus_code.php');

if( isset($_SESSION['user_id']) && isset($_SESSION['role']) ) {
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['role'];
} else {
    redirect('', 'index.php');
}

$aboutUs = new AboutusController();

$listings = $aboutUs->getAllListings($user_role);
?>

<div class="container mx-auto py-5 flex-estate flex-col">
    <?php include_once('../components/message.php'); ?>
    <div>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>History Title</th>
                <th>History Description</th>
                <th>Owner Title</th>
                <th>Owner Description</th>
                <th>Edit</th>
            </tr>

            <?php foreach ($listings as $listing) : ?>
                <tr>
                    <td><?= htmlspecialchars($listing['title']) ?></td>
                    <td><?= htmlspecialchars($listing['description']) ?></td>
                    <td><?= htmlspecialchars($listing['history_title']) ?></td>
                    <td><?= htmlspecialchars($listing['history_description']) ?></td>
                    <td><?= htmlspecialchars($listing['owners_title']) ?></td>
                    <td><?= htmlspecialchars($listing['owners_description']) ?></td>
                    <td>
                        <a href="<?= about_url('edit.php?id=' . $listing['id']) ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>


<?php
include_once("../components/footer.php");


?>