<?php
include('connect.php');
session_start();

// Rediriger vers cette page après suppression
if (!isset($_SESSION['localisation'])) {
  $_SESSION['localisation'] = 'seemyownpub.php';
}
$localisation = $_SESSION['localisation'];

// Supprimer une publication
if (isset($_POST['btn-delete'])) {
    $publicationId = $_POST['publication_id'];

    // Récupérer les images associées
    $stmt = $pdo->prepare("SELECT image FROM publications WHERE id = :id");
    $stmt->execute(['id' => $publicationId]);
    $row = $stmt->fetch();

    if ($row && !empty($row['image'])) {
        $imageArray = json_decode($row['image'], true);
        if ($imageArray && is_array($imageArray)) {
            foreach ($imageArray as $imagePath) {
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
    }

    // Supprimer la publication
    $stmt = $pdo->prepare("DELETE FROM publications WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $publicationId, 'user_id' => $_SESSION['id']]);

    $_SESSION['success_message'] = "La publication a été supprimée avec succès.";
    header("Location: seemyownpub.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Annonces</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="seemyownpub.css">
  <link rel="icon" href="mini.png" type="image/x-png">

  <style>
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      padding: 12px 20px;
      margin: 20px auto;
      border: 1px solid #c3e6cb;
      border-radius: 5px;
      text-align: center;
      width: fit-content;
      font-family: 'Poppins', sans-serif;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<header>
  <h1>Mes Annonces</h1>
</header>

<?php if (isset($_SESSION['success_message'])): ?>
  <div class="alert-success">
    <?php
      echo $_SESSION['success_message'];
      unset($_SESSION['success_message']);
    ?>
  </div>
<?php endif; ?>

<div class="container">
  <div class="retour-container">
    <a href="after_login.php" class="btn-retour"><i class='bx bx-left-arrow-alt'></i></a>
  </div>
  <div class="property-grid">
    <?php
    $stmt = $pdo->prepare("SELECT * FROM publications WHERE user_id = :id ORDER BY DateTime DESC");
    $stmt->execute(['id' => $_SESSION['id']]);

    while ($row = $stmt->fetch()):
      $imageArray = json_decode($row['image'], true);
      $carouselId = "carousel_" . $row['id'];
    ?>
    <div class="card">
      <?php if ($imageArray && is_array($imageArray) && count($imageArray) > 0): ?>
        <div class="carousel" id="<?php echo $carouselId; ?>">
          <?php foreach ($imageArray as $index => $imagePath): ?>
            <a href="viewpublication.php?id=<?php echo $row['id']; ?>">
              <img src="<?php echo htmlspecialchars($imagePath); ?>" class="carousel-image" style="<?php echo $index === 0 ? '' : 'display:none;'; ?>">
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="card-content">
        <div class="small_image">
          <i class='bx bx-camera'></i>
          <?php echo count($imageArray); ?>
        </div>
        <span class="badge <?php echo ($row['Type'] == 'Rent') ? 'rent' : 'sell'; ?>">
          <?php echo htmlspecialchars($row['Type']); ?>
        </span>
        <h3><?php echo htmlspecialchars($row['titre']); ?></h3>
        <div class="price"><?php echo htmlspecialchars($row['Prix']); ?> MAD</div>
        <div class="meta">Publié le : <?php echo htmlspecialchars($row['DateTime']); ?></div>
      </div>

      <div class="card-actions">
        <a href="publish_pub.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-edit">
          <button>Changer</button>
        </a>
        <form method="POST" style="display:inline;">
          <input type="hidden" name="publication_id" value="<?php echo htmlspecialchars($row['id']); ?>">
          <button type="submit" class="btn btn-delete" name="btn-delete">Supprimer</button>
        </form>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
  }

  const currentIndexes = {};

  function plusSlides(carouselId, n) {
    const carousel = document.getElementById(carouselId);
    const images = carousel.querySelectorAll('.carousel-image');
    if (!currentIndexes[carouselId]) currentIndexes[carouselId] = 0;

    images[currentIndexes[carouselId]].style.display = "none";
    currentIndexes[carouselId] = (currentIndexes[carouselId] + n + images.length) % images.length;
    images[currentIndexes[carouselId]].style.display = "block";
  }

  window.plusSlides = plusSlides;
});
</script>

</body>
</html>
