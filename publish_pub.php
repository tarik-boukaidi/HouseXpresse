<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['id'] ?? null;
$publicationId = $_GET['id'] ?? 0;
$isEditing = ($publicationId > 0);

// Redirect if not logged in
if (!$user_id) {
    header("Location: login.php");
    exit();
}

// Fetch existing publication if editing
if ($isEditing) {
    $stmt = $pdo->prepare("SELECT * FROM publications WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $publicationId, 'user_id' => $user_id]);
    $publication = $stmt->fetch();
    
    if (!$publication) {
        header("Location: seemyownpub.php");
        exit();
    }
    $existingImages = json_decode($publication['image'] ?? '[]', true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['push'])) {
    // Collect form data
    $titre = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $surface = $_POST['surface'] ?? '';
    $chambres = $_POST['chambres'] ?? '';
    $salles = $_POST['salles'] ?? '';
    $ville = $_POST['ville'] ?? '';
    $categorie = $_POST['categorie'] ?? '';
    $price = $_POST['price'] ?? '';
    $sellrent = $_POST['sellrent'] ?? '';

    // Handle images
    if ($isEditing) {
        // Keep existing images - no changes allowed
        $imagesJSON = $publication['image'];
    } else {
        // Process new images for new publication
        $photoPaths = [];
        if (!empty($_FILES['images']['name'][0])) {
            $upload_dir = 'uploads/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $file_name = basename($_FILES['images']['name'][$key]);
                    $tempname = $_FILES['images']['tmp_name'][$key];
                    $photoPath = $upload_dir . time() . '_' . $key . '_' . $file_name;

                    if (move_uploaded_file($tempname, $photoPath)) {
                        $photoPaths[] = $photoPath;
                    }
                }
            }
        }
        
        if (empty($photoPaths)) {
            $_SESSION['error'] = "Veuillez télécharger au moins une image";
            header("Location: publish_pub.php");
            exit();
        }
        
        $imagesJSON = json_encode($photoPaths);
    }

    try {
        if ($isEditing) {
            // Update existing publication
            $stmt = $pdo->prepare("UPDATE publications SET 
                titre = :titre, 
                description = :description, 
                surface = :surface, 
                chambres = :chambres, 
                salles = :salles, 
                ville = :ville, 
                categorie = :categorie, 
                prix = :price, 
                type = :sellrent
                WHERE id = :id AND user_id = :user_id");
                
            $stmt->bindParam(':id', $publicationId);
        } else {
            // Create new publication
            $stmt = $pdo->prepare("INSERT INTO publications 
                (titre, description, image, user_id, surface, chambres, salles, ville, categorie, prix, type) 
                VALUES (:titre, :description, :image, :user_id, :surface, :chambres, :salles, :ville, :categorie, :price, :sellrent)");
        }

        // Bind parameters
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        if (!$isEditing) $stmt->bindParam(':image', $imagesJSON);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':surface', $surface);
        $stmt->bindParam(':chambres', $chambres);
        $stmt->bindParam(':salles', $salles);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sellrent', $sellrent);

        if ($stmt->execute()) {
    $_SESSION['success'] = "Publication " . ($isEditing ? "mise à jour" : "créée") . " avec succès!";
} else {
    $_SESSION['error'] = "Une erreur est survenue lors de la publication.";
}
header("Location: publish_pub.php" . ($isEditing ? "?id=$publicationId" : ""));
exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur: " . $e->getMessage();
        header("Location: publish_pub.php" . ($isEditing ? "?id=$publicationId" : ""));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $isEditing ? 'Modifier' : 'Publier'; ?> une annonce</title>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" href="mini.png" type="image/x-png">
</head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 15px;
      transition: background 0.3s ease, color 0.3s ease;
    }

    body.dark-mode {
      background: #121212;
      color: #e0e0e0;
    }

    body.dark-mode form {
      background: #1e1e1e;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    body.dark-mode label {
      color: #e0e0e0;
    }

    body.dark-mode input,
    body.dark-mode textarea,
    body.dark-mode select {
      background: #2d2d2d;
      color: #e0e0e0;
      border-color: #444;
    }

    body.dark-mode input::placeholder,
    body.dark-mode textarea::placeholder {
      color: #aaa;
    }

    body.dark-mode button {
      background: #854836;
    }

    body.dark-mode button:hover {
      background: #a05a4a;
    }

    form {
      background: white;
      padding: 30px;
      border-radius: 10px;
      max-width: 1000px;
      margin: auto;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .titre {
      text-align: center;
      margin-bottom: 30px;
    }

    .formm {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin-top: 10px;
    }

    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 10px;
    }

    .form-group {
      flex: 1;
      min-width: 200px;
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 6px;
      font-weight: bold;
      color: #444;
      transition: color 0.3s ease;
    }

    input, textarea, select {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
      box-sizing: border-box;
      font-size: 15px;
      transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    textarea {
      resize: none;
      height: 100px;
    }

    button {
      background: #854836;
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 30px;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #6e3a2c;
    }

    .error {
      color: red;
      margin-bottom: 15px;
      text-align: center;
    }
    
    .success {
      color: green;
      margin-bottom: 15px;
      text-align: center;
    }
    
    .current-images {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }
    
    .current-images img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .image-note {
      font-style: italic;
      color: #666;
      margin-top: 5px;
    }

    body.dark-mode .image-note {
      color: #aaa;
    }
    .retour-container {
  max-width: 1200px;
  margin: 20px auto 0;
  padding: 0 20px;
  position: absolute;
  left: 0px;
  top:0%;
  
}

/* Retour button styles */
.btn-retour {
  display: inline-block;
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  padding: 11px 11px;
  border-radius: 50%;
  text-decoration: none;
  font-size: 14px;
  transition: background 0.2s ease;
  display: flex;
  align-items: center;


}
.btn-retour i {
  font-size: 20px;
}

.btn-retour:hover {
  background-color:rgba(0, 0, 0, 0.8);
}

/* Dark mode styles for retour button */
body.dark-mode .btn-retour {
  background-color: rgba(105, 98, 98, 0.8);
  color: #121212;
}

body.dark-mode .btn-retour:hover {
  background-color: rgba(146, 134, 134, 0.8);
}
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 12px 20px;
    margin: 15px 0;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 12px 20px;
    margin: 15px 0;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}


</style>
<body class="<?php echo isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === 'on' ? 'dark-mode' : ''; ?>">

<form method="POST" action="publish_pub.php<?php echo $isEditing ? '?id='.$publicationId : ''; ?>" enctype="multipart/form-data">
  <div class="titre">
    <h2><?php echo $isEditing ? 'Modifier votre annonce' : 'Publier votre maison'; ?></h2>
  </div>
  <?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success">
    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif; ?>
  
  <div class="retour-container">
    <a href="after_login.php" class="btn-retour"><i class='bx bx-left-arrow-alt'></i></a>
  </div>

  <div class="formm">
    <div class="form-group">
      <label for="title">Titre de l'annonce</label>
      <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($publication['titre'] ?? ''); ?>" required>
    </div>
    
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" required><?php echo htmlspecialchars($publication['Description'] ?? ''); ?></textarea>
    </div>
    
    <div class="form-group">
      <?php if ($isEditing && !empty($existingImages)): ?>
        <label>Images actuelles</label>
        <div class="current-images">
          <?php foreach ($existingImages as $image): ?>
            <img src="<?php echo htmlspecialchars($image); ?>" alt="Image du bien">
          <?php endforeach; ?>
        </div>
        <p class="image-note">Les images existantes ne peuvent pas être modifiées</p>
      <?php elseif (!$isEditing): ?>
        <label for="images">Images</label>
        <input type="file" name="images[]" id="images" multiple accept="image/*" required>
        <small>Téléchargez au moins une image (JPEG, PNG)</small>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="surface">Surface (en m²)</label>
      <input type="number" name="surface" id="surface" value="<?php echo htmlspecialchars($publication['Surface'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label for="chambres">Nombre de chambres</label>
      <input type="number" name="chambres" id="chambres" value="<?php echo htmlspecialchars($publication['chambres'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label for="salles">Nombre de salles de bain</label>
      <input type="number" name="salles" id="salles" value="<?php echo htmlspecialchars($publication['salles'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label for="ville">Ville</label>
      <select id="ville" name="ville" required>
        <?php
        $villes = ["Casablanca", "Rabat", "Fès", "Marrakech", "Agadir", "Tanger", "Meknes", "Oujda", "Kenitra", "Tétouan"];
        foreach ($villes as $ville) {
            $selected = ($isEditing && ($publication['ville'] ?? '') === $ville) ? 'selected' : '';
            echo "<option value=\"$ville\" $selected>$ville</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="categorie">Catégorie</label>
      <select name="categorie" id="categorie" required>
        <option value="Maison" <?php echo ($isEditing && ($publication['Categorie'] ?? '') === 'Maison') ? 'selected' : ''; ?>>Maison</option>
        <option value="Appartement" <?php echo ($isEditing && ($publication['Categorie'] ?? '') === 'Appartement') ? 'selected' : ''; ?>>Appartement</option>
        <option value="Terrain" <?php echo ($isEditing && ($publication['Categorie'] ?? '') === 'Terrain') ? 'selected' : ''; ?>>Terrain</option>
      </select>
    </div>

    <div class="form-group">
      <label for="price">Prix (en dirhams marocains)</label>
      <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($publication['Prix'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label for="sellrent">Type</label>
      <select name="sellrent" id="sellrent" required>
        <option value="Sell" <?php echo ($isEditing && ($publication['type'] ?? '') === 'Sell') ? 'selected' : ''; ?>>Sell</option>
        <option value="Rent" <?php echo ($isEditing && ($publication['type'] ?? '') === 'Rent') ? 'selected' : ''; ?>>Rent</option>
      </select>
    </div>
  </div>

  <button type="submit" name="push"><?php echo $isEditing ? 'Mettre à jour' : 'Publier'; ?></button>
</form>

<script>
  // Check for dark mode preference when page loads

  document.addEventListener('DOMContentLoaded', function () {
  // Vérifie si le thème enregistré est "dark"
  if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
  }})
</script>

</body>
</html>