<?php

include_once("../components/header.php");
include_once('../codes/realestate_code.php');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$realEstate = new RealEstateController();

$listing = $realEstate->getEstateDetails($id);
?>
<div class="estate-container">
      <div class="box">
      <div class="top">
      <div id="slider-container">
        <div id="slider">
            <div class="slide"><img src="<?= $listing['picture1_url'] ?>" alt="Flower 1"></div>
            <div class="slide"><img src="<?= $listing['picture2_url'] ?>" alt="Flower 2"></div>
            <div class="slide"><img src="<?= $listing['picture3_url'] ?>" alt="Flower 3"></div>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>
        <span><i class="fas fa-heart"></i><i class="fas fa-exchange-alt"></i></span>
      </div>
      <div class="bottom">
        <h3><?= $listing['title']?></h3>
        <p>
        <?= $listing['description']?>
        </p>
        <div class="advants">
          <div>
            <span>Bedrooms</span>
            <div><i class="fas fa-th-large"></i><span><?= $listing['bedrooms']?></span></div>
          </div>
          <div>
            <span>Bathrooms</span>
            <div><i class="fas fa-shower"></i><span><?= $listing['bathrooms']?></span></div>
          </div>
          <div>
            <span>Area</span>
            <div>
              <i class="fas fa-vector-square"></i><span><?= $listing['sqr']?><span>Sq Ft</span></span>
            </div>
          </div>
        </div>
        <div class="price">
          <span>For Sale</span>
          <span>$<?= $listing['price']?></span>
        </div>
      </div>
    </div>
</div>

<?php
include_once("../components/footer.php");
?>

<script>
    let slideIndex = 0;

    function showSlide(index) {
        const slider = document.getElementById("slider");
        const slides = document.getElementsByClassName("slide");

        if (index >= slides.length) {
            slideIndex = 0;
        } else if (index < 0) {
            slideIndex = slides.length - 1;
        } else {
            slideIndex = index;
        }

        const translateValue = -slideIndex * 100 + "%";
        slider.style.transform = "translateX(" + translateValue + ")";
    }

    function prevSlide() {
        showSlide(slideIndex - 1);
    }

    function nextSlide() {
        showSlide(slideIndex + 1);
    }
</script>