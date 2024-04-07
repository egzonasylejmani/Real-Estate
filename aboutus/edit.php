<?php
include_once("../components/header.php");
include_once('../codes/aboutus_code.php');

if (isset($_GET['id'])) {
    $about_id = validateInput($db->conn, $_GET['id']);

    // Retrieve existing data from the database based on the estate ID
    $existingData = $aboutUs->getAboutById($about_id);

    if ($existingData) {
        // Extract existing data
        $title = $existingData['title'];
        $description = $existingData['description'];
        $history_title = $existingData['history_title'];
        $history_description = $existingData['history_description'];
        $owners_title = $existingData['owners_title'];
        $owners_description = $existingData['owners_description'];
    } else {
        // Handle error or redirect to an error page
        echo "Error: About not found";
        exit;
    }
} else {
    // Handle error or redirect to an error page
    echo "Error: About ID not provided";
    exit;
}
?>



<div class="container flex flex-col">
    <div class="min-w-1200">
        <section>
            <div class="container-shift">
                <form method="POST" action="">
                    <input type="hidden" name="about_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    <div class="row">
                        <div class="col-50">
                            <fieldset>
                                <label for="full_name">Title</label>
                                <input type="text" name="title" id="full_name" value="<?= $title ?>">
                                <label for="address">History Title</label>
                                <input type="text" name="history_title" value="<?= $history_title ?>" id="history_title">
                                <label for="city">Owners Title</label>
                                <input type="text" name="owners_title" value="<?= $owners_title ?>" id="owners_title">
                            </fieldset>
                        </div>
                        <div class="col-50">
                            <fieldset>
                                <label for="description"> description</label>
                                <textarea class="textarea" name="description" id="description"><?= $description ?></textarea>
                                <label for="history_description">history_description</label>
                                <textarea class="textarea" name="history_description" id="history_description"><?= $history_description ?></textarea>
                                <label for="owners_description">owners_description</label>
                                <textarea class="textarea" name="owners_description" id="owners_description"><?= $owners_description ?></textarea>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="submit_btn">
                                <button type="submit" name="editAbout_btn" value="Continue to checkout" class="btn">Continue to
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