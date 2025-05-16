<?php
session_start();
require_once('connect.php'); 

if (!isset($_SESSION['id'])) {
    echo 'User not logged in.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $user_id = $_SESSION['id'];

    $name = $_POST['name'] ?? '';
    $secondName = $_POST['secondName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';

    $passwordHash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    $photoPath = null;
    $tempname = null;

    // Vérifie si une image a été uploadée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $photoPath = 'pictures/' . $file_name;
    }

    // Construction dynamique de la requête
    $query = "UPDATE users 
              SET firstname = :name, 
                  lastname = :secondName, 
                  email = :email, 
                  telephone = :phone";

    if (!empty($passwordHash)) {
        $query .= ", password = :password";
    }

    if (!empty($photoPath)) {
        $query .= ", photo = :photo";
    }

    $query .= " WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':secondName', $secondName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    if (!empty($passwordHash)) {
        $stmt->bindParam(':password', $passwordHash);
    }
    if (!empty($photoPath)) {
        $stmt->bindParam(':photo', $photoPath);
    }
    $stmt->bindParam(':id', $user_id);

    if ($stmt->execute()) {
        // Déplacement de l'image seulement si elle est présente
        if (!empty($photoPath) && !empty($tempname)) {
            move_uploaded_file($tempname, $photoPath);
            $_SESSION['image'] = $photoPath;
        }

        // Mise à jour de la session
        $_SESSION['user_name1'] = $name;
        $_SESSION['user_name2'] = $secondName;
        $_SESSION['email'] = $email;
        $_SESSION['telephone'] = $phone;
      
        $_SESSION['success']='Profile updated successfully!';
        header("Location: user_modification1.php");
        exit();
    } else {
        $_SESSION['failed']='Profile not been updated successfully!';
    }
}
?>
