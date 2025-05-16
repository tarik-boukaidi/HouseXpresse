<?php 
session_start();

function shownotice() {
  if (isset($_SESSION['success']) && $_SESSION['success'] !== '') {
    $msg = "<div class='input-notice'><p class='notice_msg_s'>{$_SESSION['success']}</p></div>";
    unset($_SESSION['success']); // Doit être avant le return
    return $msg;
  } elseif (isset($_SESSION['failed']) && $_SESSION['failed'] !== '') {
    $msg = "<div class='input-notice'><p class='notice_msg_f'>{$_SESSION['failed']}</p></div>";
    unset($_SESSION['failed']);
    return $msg;
  }
  return '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Profile</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="user_modification.css" />
      <link rel="icon" href="mini.png" type="image/x-png">

  <style>
    /* Dark mode styles */
    body.dark-mode {
      background-color: #121212;
      color: #e0e0e0;
    }
    .profile-container{
      margin-top:40px;
    }
    body.dark-mode .profile-container {
      background-color: #1e1e1e;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }
    
    body.dark-mode input,
    body.dark-mode .upload-btn {
      background-color: #2d2d2d;
      color: #e0e0e0;
      border-color: #444;
    }
    
    body.dark-mode input::placeholder {
      color: #aaa;
    }
    
    body.dark-mode .submit-btn {
      background-color: #854836;
      color: white;
    }
    
    body.dark-mode .upload-btn:hover,
    body.dark-mode .submit-btn:hover {
      background-color: #a05a4a;
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
  position:absolute;
  top: 20px;
  left: 20px;

}
.btn-retour i {
  font-size: 20px;
}

.btn-retour:hover {
  background-color:rgba(0, 0, 0, 0.8);;
}

/* Dark mode styles for retour button */
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
  <div class="retour-container">
    <a href="after_login.php" class="btn-retour"><i class='bx bx-left-arrow-alt'></i></a>
  </div>
  <div class="profile-container">
    <h2>Update Profile</h2>

    <form action="user_modification.php" method="POST" enctype="multipart/form-data">
      <!-- Image Upload Container -->
      <div class="image-upload-container">
        <img id="profileImage" src="<?php echo $_SESSION['image']; ?>" alt="Profile Image">
        <!-- File input field inside the form -->
        <input type="file" id="imageInput" accept="image/*" name="image" style="display: none;">
        <button type="button" class="upload-btn" onclick="document.getElementById('imageInput').click()">Upload Image</button>
      </div>
      <p><?php echo shownotice()?></p>
      <div class="profile-info">

        <div class="name-row">
          <div class="first-name">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your first name" 
                   value="<?php echo isset($_SESSION['user_name1']) ? htmlspecialchars($_SESSION['user_name1']) : ''; ?>" />
          </div>

          <div class="second-name">
            <label for="secondName">Second Name:</label>
            <input type="text" id="secondName" name="secondName" placeholder="Enter your second name" 
                   value="<?php echo isset($_SESSION['user_name2']) ? htmlspecialchars($_SESSION['user_name2']) : ''; ?>" />
          </div>
        </div>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" 
               value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" />

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="Enter your phone number" 
               value="<?php echo isset($_SESSION['telephone']) ? htmlspecialchars($_SESSION['telephone']) : ''; ?>" />

        <label for="modpaas">New Password:</label>
        <input type="password" id="modpaas" name="password" placeholder="Enter new password"/>
      </div>

      <button type="submit" class="submit-btn" name="submit">Submit</button>
    </form>
  </div>

  <script>
    // Check for saved dark mode preference at page load
    document.addEventListener('DOMContentLoaded', function() {
      const darkModeEnabled = localStorage.getItem('theme') === 'dark';
      if (darkModeEnabled) {
        document.body.classList.add('dark-mode');
      }
    });

    // JavaScript for displaying image preview
    const imageInput = document.getElementById('imageInput');
    const profileImage = document.getElementById('profileImage');

    imageInput.addEventListener('change', function () {
      const file = imageInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          profileImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
</html>