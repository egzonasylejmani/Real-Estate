<?php
include_once("../components/header.php");
include_once('../codes/realestate_code.php');

if (isset($_GET['id'])) {
    $estate_id = validateInput($db->conn, $_GET['id']);

    // Retrieve existing data from the database based on the estate ID
    $existingData = $realEstate->getEstateById($estate_id);

    if ($existingData) {
        // Extract existing data
        $title = $existingData['title'];
        $location = $existingData['location'];
        $price = $existingData['price'];
        $bedrooms = $existingData['bedrooms'];
        $bathrooms = $existingData['bathrooms'];
        $sqr = $existingData['sqr'];
        $picture1_url = $existingData['picture1_url'];
        $picture2_url = $existingData['picture2_url'];
        $picture3_url = $existingData['picture3_url'];
        $description = $existingData['description'];
        $type = $existingData['type'];
    } else {
        // Handle error or redirect to an error page
        echo "Error: Estate not found";
        exit;
    }
} else {
    // Handle error or redirect to an error page
    echo "Error: Estate ID not provided";
    exit;
}
?>



<div class="container flex flex-col">
    <div>
        <section>
            <div class="container-shift">
                <form method="POST" action="">
                    <input type="hidden" name="estate_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    <div class="row">
                        <div class="col-50">
                            <fieldset>
                                <label for="full_name">Real Estate  Name</label>
                                <input type="text" name="title" id="full_name" value="<?= $title ?>" placeholder="Title">
                                <label for="address">Location</label>
                                <input type="text" name="location" value="<?= $location ?>" id="address" placeholder="Prishtina, 12, Mati 1">
                                <label for="city">Description</label>
                                <textarea name="description" id="description"><?= $description ?></textarea>
                                <div class="">
                                    <fieldset>
                                        <label for="price">Bedrooms</label>
                                        <input type="number" value="<?= $bedrooms ?>" name="bedrooms" id="bedrooms" placeholder="bedrooms">
                                    </fieldset>
                                    <fieldset>
                                        <label for="price">bathrooms</label>
                                        <input type="number" value="<?= $bathrooms ?>" name="bathrooms" id="sqr" placeholder="sqr">
                                    </fieldset>
                                    <fieldset>
                                        <label for="price">Square Feet</label>
                                        <input type="number" name="sqr" value="<?= $sqr ?>" id="sqr" placeholder="sqr">
                                    </fieldset>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-50">
                            <fieldset>
                                <label for="picture1_url"> Picture 1</label>
                                <input type="text" name="picture1_url" value="<?= $picture1_url ?>" id="picture1_url" placeholder="Picture 1">
                                <label for="picture2_url">Picture 2</label>
                                <input type="text" name="picture2_url" value="<?= $picture2_url ?>" id="picture2_url" placeholder="Picture 2">
                                <label for="picture3_url">Picture 3</label>
                                <input type="text" name="picture3_url" value="<?= $picture2_url ?>" id="picture3_url" placeholder="Picture 3">
                            </fieldset>
                            <div class="row">
                                <div class="col-50">
                                    <fieldset>
                                        <label for="price">Price</label>
                                        <input type="text" name="price"  value="<?= $price ?>" id="price" placeholder="Price">
                                    </fieldset>
                                </div>
                                <div class="col-50">
                                    <fieldset>
                                        <label for="type">Type</label>
                                        <input type="text" name="type"  value="<?= $type ?>" id="type" placeholder="Type">
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="submit_btn">
                                <button type="submit" name="editEstate_btn" value="Continue to checkout" class="btn">Continue to
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