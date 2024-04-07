<?php

include_once("../components/header.php");
include_once('../codes/aboutus_code.php');
$result = new AboutUsController();
$aboutUs = $result->getAboutById(1);
?>
 
 
 <div class="container-aboutus">
    <section>
      <h2><?= $aboutUs['title']?></h2>
      <p><?= $aboutUs['description']?></p>
    </section>

    <section class="photo-grid">
      <img src="https://cdn.pixabay.com/photo/2014/07/31/00/30/vw-beetle-405876__340.jpg" alt="Photo 1">
      <img src="https://cdn.pixabay.com/photo/2016/11/18/17/46/house-1836070__340.jpg" alt="Photo 2">
      <img src="https://www.capvillas.com/properties/villa-villefranche-sur-mer/14_rent-villa-hr1234-villefranche-property-jpg.jpg" alt="Photo 3">
      <img src="https://images.italicarentals.com/photos/3830/xlarge-asra4:3/villa-affitto-poveromo-7-.jpg" alt="Photo 4">
      <img src="https://www.magicalvacationhomes.com/wp-content/uploads/2023/03/McNally-501-Muirfield-Loop-night-3-min-e1680869618950.jpg" alt="Photo 5">
      <img src="https://www.palmettodunes.com/assets/masthead/11armada-masthead.jpg"alt="Photo 6">
    </section>

    <section class="history-owners">
        <div class="history">
        <h2><?= $aboutUs['history_title']?></h2>
        <p><?= $aboutUs['history_description']?></p>
        </div>

        <div class="owners">
        <h2><?= $aboutUs['owners_title']?></h2>
        <p><?= $aboutUs['owners_description']?></p>
        </div>
    </section>
  </div>

</body>
</html>

<?php

include_once("../components/footer.php");
?>