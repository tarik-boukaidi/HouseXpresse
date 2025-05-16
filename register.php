<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
        $telephone = $_POST['telephone'] ?? '';


        if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($telephone)) {
            $_SESSION['register_error'] = "Tous les champs sont obligatoires.";
            header("Location: index.php");
            exit;
        }

        // Vérifier email et téléphone
        $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR telephone = ?");
        $check->execute([$email, $telephone]);
        if ($check->fetchColumn() > 0) {
            $_SESSION['register_error'] = "Email ou téléphone déjà utilisé.";
            header("Location: index.php");
            exit;
        }
        if($password != $_POST['comfirme']){
            $_SESSION['notequal'] = "comfirme password dosn't match the password";
            header("Location: index.php");
            exit;
        }

        // Insertion
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insert = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, telephone) VALUES (?, ?, ?, ?, ?)");
        $insert->execute([$firstname, $lastname, $email, $hashedPassword, $telephone]);

        $_SESSION['register_success'] = "Inscription réussie !";
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['login'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['login_error'] = "Tous les champs sont obligatoires.";
            header("Location: index.php");
            exit;
        }

        $stmt = $pdo->prepare("SELECT firstname, lastname, password, telephone,id,photo FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_name1'] = $user['firstname'];
                $_SESSION['user_name2'] = $user['lastname'];
                $_SESSION['email'] = $email;
                $_SESSION['telephone'] = $user['telephone'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['id']=$user['id'];
                $_SESSION['image']= $user['photo'];
                $_SESSION['login_success'] = "Connexion réussie.";
                $_SESSION['localisation'] = "after_login.php";
                header("Location: after_login.php");
                exit();                
            } else {
                $_SESSION['login_error'] = "Mot de passe incorrect.";
            }
        } else {
            $_SESSION['login_error'] = "Utilisateur introuvable.";
        }

        header("Location: index.php");
        exit();
    }
}

// $limit = 9; // Records per page

// // Get current page number from URL
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $start = ($page - 1) * $limit;

// // Get total number of records
// $result = $conn->query("SELECT COUNT(*) AS total FROM publications");
// $row = $result->fetch_assoc();
// $total = $row['total'];
// $pages = ceil($total / $limit);

// // Fetch data
//  $sql = "SELECT * FROM publications LIMIT $start, $limit";
//  $res = $conn->query($sql);



// // Pagination links
// for ($i = 1; $i <= $pages; $i++) {
//     echo "<a href='index.php?page=$i'>$i</a> ";
// }
// ?>
