<?php

include_once("../components/header.php");
include_once('../codes/authentication_code.php');

if( isset($_SESSION['user_id']) && isset($_SESSION['role'] )&& $_SESSION['role'] == true)  {
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['role'];
} else {
    redirect('', 'index.php');
}

$user = new RegisterController();

$listings = $user->getAllUsers($user_role, $user_id);
?>

<div class="container mx-auto py-5 flex-estate flex-col">
    
    <?php include_once('../components/message.php'); ?>
    <div class="table">
    <div class="create">
        <a href="<?= estate_url('create.php') ?>">Create</a>
    </div>
        <table>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Is admin</th>
                <th>Is Active</th>
                <th>Deleted at</th>
                <th>Deleted by</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php foreach ($listings as $listing) : ?>
                <tr>
                    <td><?= htmlspecialchars($listing['fname']) ?></td>
                    <td><?= htmlspecialchars($listing['lname']) ?></td>
                    <td><?= htmlspecialchars($listing['email']) ?></td>
                    <td><?= htmlspecialchars($listing['isadmin']) ?></td>
                    <td><?= htmlspecialchars($listing['is_active']) ?></td>
                    <td><?= htmlspecialchars($listing['deleted_at']) ?></td>
                    <td><?= htmlspecialchars($listing['deleted_by']) ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $listing['id']; ?>">Edit</a>
                    </td>
                    <td>
                        <?php if($listing['is_active'] === 1){?>
                            <?php if ($user_id == $listing['id'] || $user_role == 1) : ?>
                                <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    <input type="hidden" name="listingIdToDeleteUser" value="<?= $listing['id'] ?>">
                                    <button type="submit" name="deleteUser">Delete</button>
                                </form>
                            <?php endif; ?>
                        <?php } elseif($listing['is_active'] == 0){?>
                            <?php if ($user_id == $listing['id'] || $user_role == 1) : ?>
                                <form method="post" onsubmit="return confirm('Are you sure you want to Activate this user?')">
                                    <input type="hidden" name="listingIdToActivateUser" value="<?= $listing['id'] ?>">
                                    <button type="submit" class="green" name="activateUser">Activate</button>
                                </form>                           
                            <?php endif; ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

<?php
include_once("../components/footer.php");


?>