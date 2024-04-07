<?php
include_once('../codes/realestate_code.php');
$realEstate = new RealEstateController();

$listings = $realEstate->getAllListingsView();

?>
<div class="cards-container">
  <?php foreach ($listings as $listing): ?>
      <div class="box">
      <div class="top">
        <a href="<?= base_url('estate-page.php?id=' . $listing['id']) ?>">
          <img src="<?= $listing['picture1_url'] ?>" alt="" />
        </a>
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
  <?php endforeach; ?>
</div>