<?php 
session_start();
require_once 'connect.php';

$user_id = $_SESSION['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['push']) && $user_id) {
    // Collect form data
    $titre       = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $surface     = $_POST['surface'] ?? '';
    $chambres    = $_POST['chambres'] ?? '';
    $salles      = $_POST['salles'] ?? '';
    $ville       = $_POST['ville'] ?? '';
    $categorie   = $_POST['categorie'] ?? '';
    $price       = $_POST['price'] ?? '';
    $sellrent    = $_POST['sellrent'] ?? ''; // Add sellrent data

    // Gestion des images multiples
    $photoPaths = [];
    if (isset($_FILES['images'])) {
        $totalFiles = count($_FILES['images']['name']);
        $upload_dir = 'uploads/';

        for ($i = 0; $i < $totalFiles; $i++) {
            if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                $file_name = basename($_FILES['images']['name'][$i]);
                $tempname = $_FILES['images']['tmp_name'][$i];
                $photoPath = $upload_dir . time() . '_' . $i . '_' . $file_name;

                if (move_uploaded_file($tempname, $photoPath)) {
                    $photoPaths[] = $photoPath;
                }
            }
        }
    }

    // Convert image paths to JSON for storing in the database
    $imagesJSON = json_encode($photoPaths);

    try {
        // Prepare the SQL query for inserting data into the database
        $stmt = $pdo->prepare("INSERT INTO publications 
            (titre, description, image, user_id, surface, chambres, salles, Ville, Categorie, Prix, Type) 
            VALUES (:titre, :description, :image, :user_id, :surface, :chambres, :salles, :ville, :categorie, :price, :sellrent)");

        // Bind parameters
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $imagesJSON); // Store multiple images as JSON
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':surface', $surface);
        $stmt->bindParam(':chambres', $chambres);
        $stmt->bindParam(':salles', $salles);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sellrent', $sellrent); // Bind SellRent parameter

        // Execute the statement and provide feedback
        if ($stmt->execute()) {
            echo "✅ Publication insérée avec succès.";
        } else {
            echo " Erreur lors de l'insertion.";
        }

    } catch (PDOException $e) {
        echo " Erreur PDO : " . $e->getMessage();
    }
} else {
    echo "⚠️ Requête non valide ou utilisateur non connecté.";
}
?>
