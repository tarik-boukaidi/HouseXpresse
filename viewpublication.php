<?php
include('connect.php');
session_start();
$localisation = $_SESSION['localisation'];
if (isset($_GET['id'])) {
    $publicationId = $_GET['id'];

    // Fetch publication details by id
    $stmt = $pdo->prepare("SELECT * FROM publications WHERE id = :id");
    $stmt->execute(['id' => $publicationId]);
    $row = $stmt->fetch();

    if (!$row) {
        header("Location: seemyownpub.php");
        exit();
    }

    // Fetch user details
    $userStmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
    $userStmt->execute(['user_id' => $row['user_id']]);
    $user = $userStmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publication Details</title>
  <link rel="stylesheet" href="viewpublication.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/a9427fd68b.js" crossorigin="anonymous"></script>
  <link rel="icon" href="mini.png" type="image/x-png">
</head>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
    background: #f0f2f5;
    color: #333;
}

header {
    background-color: #854836;
    color: white;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

h1 {
    margin: 0;
    font-size: 28px;
}

.container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
}

.card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.06);
    transition: transform 0.2s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 400px;
}

.card:hover {
    transform: scale(1.02);
}

.carousel {
    position: relative;
    width: 100%;
    max-height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    background-color: #f9f9f9;
}

.carousel-image {
    width: auto;
    height: auto;
    max-width: 100%;
    max-height: 350px;
    object-fit: contain;
    position: relative;
    display: none;
    margin: 0 auto;
}

.carousel-image.active {
    display: block;
}

.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    font-weight: bold;
    padding: 10px;
    border: none;
    cursor: pointer;
    border-radius: 50%;
    z-index: 1;
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}

.prev:hover, .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

.card-content {
    padding: 15px;
    flex-grow: 1;
    position: relative;
}

.card-content h3 {
    margin-top: 0;
    font-size: 20px;
    color: #2c3e50;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    margin-bottom: 10px;
}

.badge.sell{
    background-color: #854836;
    color: white;
}
.badge.rent{
    background-color: white ;
    color:#854836 ;
}

.price {
    font-weight: bold;
    color: #27ae60;
    margin: 8px 0;    
    position:absolute;
    right:10%;
}

.description {
    font-size: 14px;
    line-height: 1.6;
    color: #555;
}

.meta {
    font-size: 14px;
    color: #777;
    display: flex;
    align-items:center;
}

.card-actions {
    display: flex;
    justify-content: space-between;
    padding: 15px;
    border-top: 1px solid #eee;
}
.localisation{
    display:flex;
    align-items:center;
    gap:0.8%;
}

.return{
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 10px;
    border-radius: 50%;
    cursor: pointer;
    justify-content: center;
    align-items: center;
    display: flex;
}
.return:hover{
    background-color: rgba(0, 0, 0, 0.8);
}
.return i{
    font-size: 20px;
}
.twachi{
    display: flex;
    flex-wrap: wrap;
    margin: 20px 0px;
    line-height: 80px;
    gap:6%;
    justify-content: center;
}
.twachi hr{
    width: 100%;
}
.twachi .dakchi i{
    font-size: 35px;
}
.dakchi{
    display: flex;
    align-items: center;
    gap: 4px;
}
.dakchi i{
    color: #854836;
}
.jnb{
  position: absolute;
  right: 10px;
  display:flex;
  justify-content: center;
  align-items: center;
  gap: 18px;
  margin-right:15px;
}
.jnb1{
  display:flex;
  justify-content: center;
  align-items: center;
  gap: 5px;
}

/* Dark Mode Styles */
body.dark-mode {
    background-color: #121212;
    color: #e0e0e0;
}

body.dark-mode header {
    background-color: #1e1e1e;
}
body.dark-mode header h1 {
    color: #854836;
}

body.dark-mode .card {
    background-color: #2d2d2d;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

body.dark-mode .card-content h3,
body.dark-mode .card-content h2,
body.dark-mode .card-content h4 {
    color: #e0e0e0;
}

body.dark-mode .description {
    color: #b0b0b0;
}

body.dark-mode .carousel {
    background-color: #1e1e1e;
}

body.dark-mode .prev,
body.dark-mode .next {
    background-color: rgba(255, 255, 255, 0.2);
}

body.dark-mode .prev:hover,
body.dark-mode .next:hover {
    background-color: rgba(255, 255, 255, 0.4);
}

body.dark-mode .return {
    background-color: rgba(255, 255, 255, 0.2);
}

body.dark-mode .return:hover {
    background-color: rgba(255, 255, 255, 0.4);
}

body.dark-mode .badge {
    color: white;
}

body.dark-mode .price {
    color: #27ae60;
}

body.dark-mode .meta {
    color: #b0b0b0;
}

body.dark-mode .card-actions {
    border-top: 1px solid #444;
}

body.dark-mode .dakchi i {
    color: #a05a4a;
}

body.dark-mode .fa-location-dot {
    color: #a05a4a;
}

body.dark-mode .localisation {
    border-bottom: 1px solid #444;
    padding-bottom: 10px;
}
</style>
<body>

<header>
  <h1>Publication Details</h1>
</header>

<div class="container">
  <div class="card">
    <div class="carousel" id="carousel_<?php echo $row['id']; ?>">
      <?php
      $imageArray = json_decode($row['image'], true);
      if ($imageArray && is_array($imageArray) && count($imageArray) > 0):
        foreach ($imageArray as $index => $imagePath): ?>
          <img src="<?php echo htmlspecialchars($imagePath); ?>" class="carousel-image<?php echo $index === 0 ? ' active' : ''; ?>">
          <a href="<?php echo $localisation;?>">
            <div class="return">
            <i class='bx bx-left-arrow-alt'></i>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php if (count($imageArray) > 1): ?>
        <button class="prev" onclick="plusSlides('carousel_<?php echo $row['id']; ?>', -1)">&#10094;</button>
        <button class="next" onclick="plusSlides('carousel_<?php echo $row['id']; ?>', 1)">&#10095;</button>
      <?php endif; ?>
    </div>

    <div class="card-content">
    <div class="localisation">
        <span class="badge <?php echo ($row['Type'] == 'Rent') ? 'rent' : 'sell'; ?>">
            <?php echo htmlspecialchars($row['Type']); ?>
        </span>
      <div class="jnb">
        <div class="meta">Published on: <?php echo htmlspecialchars($row['DateTime']); ?></div>
        <div class="jnb1">
        <i class="fa-solid fa-location-dot"></i>
        <p><?php echo $row['Ville'] ?></p>
        </div>
      </div>
      </div>

      <h2><?php echo htmlspecialchars($row['titre']); ?></h2>
      <div class="description">
        <h4>Description:</h4>
        <p><?php echo nl2br(htmlspecialchars($row['Description'])); ?></p>
        <div class="twachi">
                    <div class="dakchi">
                        <i class='bx bx-cube'></i>
                        <p><?php echo $row['Surface'].' m²'?></p>
                    </div>
                    <div class="dakchi">
                        <i class='bx bx-bed' ></i>
                        <p><?php echo $row['chambres'].' bedrooms'?></p>
                    </div>
                    <div class="dakchi">
                        <i class='bx bx-bath'></i>
                        <p><?php echo $row['salles'].' bathrooms'?></p>
                    </div>
                </div>
      </div>
      <div class="meta">
<button onclick="showModal()" style="padding: 10px 15px; background-color: #854836; color: white; border: none; border-radius: 5px; cursor: pointer;">
  <i class="fas fa-phone" style="margin-right: 6px;"></i> Contact the seller
</button>
        <div class="price"><p><?php echo htmlspecialchars($row['Prix']); ?> DH</p></div>
      </div>
    </div>
  </div>
</div>
<div id="contactModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
    background-color: rgba(0,0,0,0.6); z-index: 1000; justify-content: center; align-items: center;">
  <div style="background: white; padding: 30px; border-radius: 12px; max-width: 400px; text-align: center; position: relative;">
    <span style="position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 20px;" onclick="closeModal()">&times;</span>
    <h3 style="margin-top: 0; color:red;">Attention !</h3>
    <p style="margin-top: 20px; font-size: 14px; color: grey;">
      You should never send money in advance to the seller by bank transfer or through a money transfer agency when purchasing goods available on the site.
    </p>
    <p style="margin-top:15px;color:black">Call <?php echo htmlspecialchars($user['firstname'].' '.$user['lastname']); ?></p>
<p style="margin-top: 0px; margin-bottom: 0; font-size: 18px; font-weight: bold; color: #333;">
  <i class="fas fa-phone" style="margin-right: 8px; color: #854836;"></i>
  <?php echo htmlspecialchars($user['telephone']); ?>
</p>


  </div>
</div>

<script>
    function showModal() {
  document.getElementById('contactModal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('contactModal').style.display = 'none';
}

// Dark Mode Persistence
document.addEventListener('DOMContentLoaded', function() {
    // Check for dark mode preference
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }
    
    // Carousel functionality
    const currentIndexes = {};
    
    function plusSlides(carouselId, n) {
        const carousel = document.getElementById(carouselId);
        const images = carousel.querySelectorAll('.carousel-image');
        if (!currentIndexes[carouselId]) currentIndexes[carouselId] = 0;

        images[currentIndexes[carouselId]].classList.remove('active');
        currentIndexes[carouselId] = (currentIndexes[carouselId] + n + images.length) % images.length;
        images[currentIndexes[carouselId]].classList.add('active');
    }
    
    // Make plusSlides available globally if needed
    window.plusSlides = plusSlides;
});
</script>

</body>
</html>