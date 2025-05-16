<?php
session_start();
require_once 'connect.php';

$user_information = [
  'first_name' => $_SESSION['user_name1'] ?? '',
  'last_name'  => $_SESSION['user_name2'] ?? '',
  'email'      => $_SESSION['email'] ?? '',
  'id'         => $_SESSION['id'] ?? '',  
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['push'])) {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $note     = intval($_POST['note'] ?? 0);
    $comment  = trim($_POST['comment'] ?? '');

    if (!empty($name) && !empty($email) && $note > 0 && !empty($comment)) {
        $sql = "INSERT INTO opinions (user_id, Nom_complet, note, commentaire, email) 
                VALUES (:id, :nom, :note, :commentaire, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id'          => $user_information['id'],  
            ':nom'         => $name,
            ':email'       => $email,
            ':note'        => $note,
            ':commentaire' => $comment
        ]);
        $_SESSION['msg'] = "Thank you for your feedback!";
    } else {
        $_SESSION['msg'] = "Veuillez remplir tous les champs.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Donnez votre avis</title>
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

    /* Dark mode styles */
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
      color: white;
    }

    body.dark-mode button:hover {
      background: #a05a4a;
    }

    form {
      background: white;
      padding: 30px;
      border-radius: 10px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .titre {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
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
      resize: vertical;
      min-height: 80px;
    }

    button {
      background: #854836;
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 20px;
      transition: background 0.3s ease;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    button:hover {
      background: #6e3a2c;
    }

    .msg {
      text-align: center;
      margin-bottom: 20px;
      color: green;
      font-weight: bold;
    }
    .retour-container {
  position: absolute;
  top: 7%;
  left: 2%;
  z-index: 10;
}

.btn-retour {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background-color: #854836;
  color: white;
  border-radius: 50%;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.btn-retour i {
  font-size: 24px;
}

.btn-retour:hover {
  background-color: #6d3a2b;
}

/* Dark mode */
body.dark-mode .btn-retour {
  background-color: rgba(105, 98, 98, 0.8);
  color: #121212;
}

body.dark-mode .btn-retour:hover {
  background-color: rgba(146, 134, 134, 0.8);
}
  </style>
</head>
<body>

<div class="msg"><?php echo $msg; ?></div>
  <div class="retour-container">
    <a href="after_login.php" class="btn-retour"><i class='bx bx-left-arrow-alt'></i></a>
  </div>
<form method="POST">
  <div class="titre">
    <h2>Donnez votre avis sur notre site</h2>
  </div>

  <div class="form-group">
    <label for="name">Nom</label>
    <input type="text" name="name" id="name" 
           value="<?php echo htmlspecialchars($_SESSION['user_name1'] . ' ' . $_SESSION['user_name2']); ?>" required>
  </div>

  <div class="form-group">
    <label for="email">Adresse e-mail</label>
    <input type="email" name="email" id="email" 
           value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required>
  </div>

  <div class="form-group">
    <label for="note">Note (sur 5)</label>
    <select name="note" id="note" required>
      <option value="">Choisissez une note</option>
      <option value="5">5 - Excellent</option>
      <option value="4">4 - Très bon</option>
      <option value="3">3 - Bon</option>
      <option value="2">2 - Passable</option>
      <option value="1">1 - Mauvais</option>
    </select>
  </div>

  <div class="form-group">
    <label for="comment">Votre commentaire</label>
    <textarea name="comment" id="comment" placeholder="Partagez votre expérience..." required></textarea>
  </div>

  <button type="submit" name="push">Envoyer l'avis</button>
</form>

<script>
  // Check for dark mode preference when page loads
  document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('theme') === 'dark') {
      document.body.classList.add('dark-mode');
    }
  });
</script>

</body>
</html>