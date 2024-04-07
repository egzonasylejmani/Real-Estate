<?php

include_once("../components/header.php");
include_once('../codes/realestate_code.php');

if( isset($_SESSION['user_id']) && isset($_SESSION['role']) ) {
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['role'];
} else {
    redirect('', 'index.php');
}

$realEstate = new RealEstateController($db);

$listings = $realEstate->getAllListings($user_id, $user_role);
?>

<div class="container mx-auto py-5 flex-estate flex-col">
    
    <?php include_once('../components/message.php'); ?>
    <div class="table">
    <div class="create">
        <a href="<?= estate_url('create.php') ?>">Create</a>
    </div>
        <table>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Price</th>
                <th>type</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Sqr</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php foreach ($listings as $listing) : ?>
                <tr>
                    <td><?= htmlspecialchars($listing['title']) ?></td>
                    <td><?= htmlspecialchars($listing['location']) ?></td>
                    <td><?= htmlspecialchars($listing['price']) ?></td>
                    <td><?= htmlspecialchars($listing['type']) ?></td>
                    <td><?= htmlspecialchars($listing['bedrooms']) ?></td>
                    <td><?= htmlspecialchars($listing['bathrooms']) ?></td>
                    <td><?= htmlspecialchars($listing['sqr']) ?></td>
                    <td><?= htmlspecialchars($listing['description']) ?></td>
                    <td>
                        <a href="<?= estate_url('edit.php?id=' . $listing['id']) ?>">Edit</a>
                    </td>
                    <td>
                        <?php if ($user_id == $listing['user_id'] || $user_role == 1) : ?>
                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this listing?')">
                                <input type="hidden" name="listingIdToDelete" value="<?= $listing['id'] ?>">
                                <button type="submit" name="deleteListing">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>


<?php
include_once("../components/footer.php");


?>