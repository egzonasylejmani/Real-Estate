<?php
include_once("../components/header.php");
include_once('../codes/realestate_code.php');


?>

<div class="container flex flex-col">
    <div>
        <section>
            <div class="container-shift">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-50">
                            <fieldset>
                                <label for="full_name">Real Estate  Name</label>
                                <input type="text" name="title" id="full_name" placeholder="Title">
                                <label for="address">Location</label>
                                <input type="text" name="location" id="address" placeholder="Prishtina, 12, Mati 1">
                                <label for="city">Description</label>
                                <textarea name="description" id="description"></textarea>
                                <div class="">
                                    <fieldset>
                                        <label for="price">Bedrooms</label>
                                        <input type="number" name="bedrooms" id="bedrooms" placeholder="bedrooms">
                                    </fieldset>
                                    <fieldset>
                                        <label for="price">bathrooms</label>
                                        <input type="number" name="bathrooms" id="bathrooms" placeholder="bathrooms">
                                    </fieldset>
                                    <fieldset>
                                        <label for="price">sqr</label>
                                        <input type="number" name="sqr" id="sqr" placeholder="sqr">
                                    </fieldset>

                                </div>
                            </fieldset>
                        </div>
                        <div class="col-50">
                            <fieldset>
                                <label for="picture1_url"> Picture 1</label>
                                <input type="text" name="picture1_url" id="picture1_url" placeholder="Picture 1">
                                <label for="picture2_url">Picture 2</label>
                                <input type="text" name="picture2_url" id="picture2_url" placeholder="Picture 2">
                                <label for="picture3_url">Picture 3</label>
                                <input type="text" name="picture3_url" id="picture3_url" placeholder="Picture 3">
                            </fieldset>
                            <div class="row">
                                <div class="col-50">
                                    <fieldset>
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" placeholder="Price">
                                    </fieldset>
                                    <fieldset>
                                        <label for="cvv">Type</label>
                                        <input type="text" name="type" id="type" placeholder="Type">
                                    </fieldset>
                                </div>
                                <div class="col-50">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="submit_btn">
                                <button type="submit" name="createEstate_btn" value="Continue to checkout" class="btn">Continue to
                                    create </button>
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