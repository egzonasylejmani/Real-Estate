<?php
include_once("../components/header.php");
include_once('../codes/authentication_code.php');
include_once('../controllers/RegisterController.php');

$user = new RegisterController();

if (isset($_GET['id'])) {
    $user_id = validateInput($db->conn, $_GET['id']);

    // Retrieve existing data from the database based on the estate ID
    $existingData = $user->getUserById($user_id);

    if ($existingData) {
        // Extract existing data
        $fname = $existingData['fname'];
        $lname = $existingData['lname'];
        $email = $existingData['email'];
        $password = $existingData['password'];
        $isadmin = $existingData['isadmin'];
        $is_active = $existingData['is_active'];
        $deleted_at = $existingData['deleted_at'];
        $deleted_by = $existingData['deleted_by'];
    } else {
        // Handle error or redirect to an error page
        echo "Error: User not found";
        exit;
    }
} else {
    // Handle error or redirect to an error page
    echo "Error: User ID not provided";
    exit;
}
?>



<div class="container flex flex-col">
    <div>
        <section>
            <div class="container-shift">
                <form method="POST" action="">
                    <input type="hidden" name="users_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    <div class="row">
                        <div class="col-50">
                            <fieldset>
                                <label for="full_name">User Name</label>
                                <input type="text" name="fname" id="fname" value="<?= $fname ?>" placeholder="fname">
                                <label for="address">User Last Name</label>
                                <input type="text" name="lname" value="<?= $lname ?>" id="lname" placeholder="lname">
                                <div class="">
                                    <fieldset>
                                        <label for="price">email</label>
                                        <input type="email" value="<?= $email ?>" name="email" id="email" placeholder="email">
                                    </fieldset>
                                    <fieldset>
                                        <label for="price">password</label>
                                        <input type="password" name="password" value="<?= $password ?>" id="password" placeholder="password">
                                    </fieldset>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-50">
                            <fieldset>
                                <select name="isadmin" id="isadmin">
                                    <option value="<?= false ?>" <?php echo ($isadmin == false) ? 'selected' : ''; ?>>No</option>
                                    <option value=<?= true   ?>  <?php echo ($isadmin == true) ? 'selected' : ''; ?>>Admin</option>
                                </select>
                                <label for="is_active">is_active</label>
                                <input type="number" name="is_active" value="<?= $is_active ?>" id="is_active" placeholder="is_active">
                                <label for="deleted_at">Updated_at</label>
                                <input type="date" name="deleted_at" value="<?= $deleted_at ?>" id="deleted_at" placeholder="deleted_at" readonly>
                                <label for="deleted_by">deleted_by</label>
                                <input type="text" name="deleted_by" value="<?= $deleted_by ?>" id="deleted_by" placeholder="deleted_by" readonly>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="submit_btn">
                                <button type="submit" name="editUser_btn" value="Continue to checkout" class="btn">Continue to
                                    Edit </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<?php
include_once("../components/footer.php");
?>