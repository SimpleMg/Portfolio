<?php
  $db = new mysqli('localhost', 'root', '', 'portfolio');
  if ($db->connect_errno) {
      echo "Failed to connect to MySQL: " . $db->connect_error;
      exit();
  }

  $query = "SELECT description, img_profile FROM cv";
  $result = $db->query($query);

  if ($result) {
    $row = $result->fetch_assoc();
    $description = $row['description'];
    $img_profile = $row['img_profile'];
  }
  $query2 = "SELECT titre, img FROM competences";
  $result2 = $db->query($query2);
  

?>
<style>
  h1,
  h2,
  h3 {
    color: #32cd32;
  }

  .marker {
    position: relative;
    display: inline;
  }

  .marker-center::before {
    content: '';
    position: absolute;
    background-color: #32cd32;
    height: 2px;
    width: 100%;
    bottom: 0;
    left: 0;
  }

  img {
    border-radius: 50%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  p {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #50e050;
  }

  .skill-icon {
    font-size: 10rem;
    margin-bottom: 10px;
    color: #32cd32;
  }
  .download-btn {
  background-color: #32cd32;
  color: white;
  border: 2px solid #32cd32;
  border-radius: 5px;
  font-size: 1.2rem;
  padding: 12px 24px;
  transition: all 0.3s ease;
  text-decoration: none;
}

.download-btn:hover {
  background-color: #50e050;
  color: black;
  border-color: #50e050;
  text-decoration: none;
}

.download-btn i {
  margin-right: 8px;
}

</style>
<div class="section pt-4 px-3 px-lg-4" id="about">
  <div class="container-narrow mx-auto">
    <div class="row">
      <div class="col-md-6">
        <div class="px-3">
          <br>
          <br>
            <p><?= $description; ?></p>
        </div>
      </div>
      <div class="col-md-5 offset-md-1" data-aos="fade-left" data-aos-delay="100">
        <div class="px-3">
          <img class="avatar img-fluid mt-2" src="<?= $img_profile; ?>" width="400" height="400" alt="Sam Levy" />
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section px-3 px-lg-4 pt-5">
  <div class="container-narrow">
    <div class="text-center mb-5">
      <h2 class="marker marker-center">Mes compétences</h2>
    </div>
    <div class="row">
      <?php
        if ($result2) {
          $rows = $result2->fetch_all(MYSQLI_ASSOC);
          foreach ($rows as $row2) {
            $titre = $row2['titre'];
            $img = $row2['img'];
            ?>
              <div class="col-md-4">
                <div class="skill-block text-center">
                  <i class="<?= $row2["img"] ?>"></i>
                  <h3> <?= $titre ?></h3>
                </div>
              </div>
            <?php
          }
        }
      ?>
    </div>
  </div>
</div>
<div class="container mt-5">
    <div class="row">
      <div class="col text-center">
        <a href="assets/docs/cv.pdf" class="btn download-btn">
          <i class="fas fa-download"></i> Télécharger mon CV en PDF
        </a>
      </div>
    </div>
  </div>
