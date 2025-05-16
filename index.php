<?php 
session_start();
$errors=[
    'login'=>$_SESSION['register_erreur'] ?? '',
    'register'=>$_SESSION['login_erreur'] ?? '',
    'user_name1' =>$_SESSION['user_name1'] ?? '',
    'user_name2' =>$_SESSION['user_name2'] ?? '',
    'login_success'=>$_SESSION['login_success']?? '',
    'login_error'=>$_SESSION['login_error'] ?? '',
     'notequal'=>$_SESSION['notequal'] ?? '',
];
session_unset();
function showserreur($type){
    global $errors;
    return !empty($errors[$type]) ? "<div class='input-group-erreur'><p class='error_msg'>{$errors[$type]}</p> </div>":'';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HouseXpress - Sign Up</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link rel="icon" href="mini.png" type="image/x-png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .logo {
            position: absolute;
            top: 1rem;
            left: 2rem;
        }
        
        .logo h1 {
            font-size: 24px;
            color: #333;
        }
        
        .logo .highlight {
            color: #854836;
        }
        
        .container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            position: relative;
        }
        
        .form-header {
            background-color: #854836;
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .form-header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .form-container {
            padding: 30px;
        }
        
        .input-group,.input-group-erreur {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group-erreur{
            text-align:center;
            color:red;
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 18px;
        }
        
        .form-container input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-container input:focus {
            border-color: #854836;
            outline: none;
            box-shadow: 0 0 0 3px #a16452;
        }
        
        .name-fields {
            display: flex;
            gap: 15px;
        }
        
        .name-fields .input-group {
            flex: 1;
        }
        
        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #854836;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        .submit-btn:hover {
            background-color: #854836;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        
        .login-link a {
            color: #854836;
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
            text-decoration: underline;
            cursor: pointer;
        }
        .hide{
            display: none;
        }
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        
        body.dark-mode .container {
            background-color: #2d2d2d;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        body.dark-mode .form-container input {
            background-color: #3a3a3a;
            border-color: #444;
            color: #e0e0e0;
        }
        
        body.dark-mode .input-group i {
            color: #b0b0b0;
        }
        
        body.dark-mode .login-link {
            color: #b0b0b0;
        }
        body.dark-mode .logo h1{
            color:white;
        }
        body.dark-mode .logo .highlight{
            color:#854836;
        }

        
    </style>
</head>
<body>
    <div class="logo">
        <h1>House<span class="highlight">X</span>press</h1>
    </div>
    
    <div class="container" id="container_register">
        <div class="form-header">
            <h2>Create Your Account</h2>
            <p>Join HouseXpress to find your dream property</p>
        </div>
        
        <form method="post" action="register.php" class="form-container">
         <?php echo showserreur('login') ?>
         <?php echo showserreur('notequal') ?>
         <?php echo showserreur('login_error') ?>
            <div class="name-fields">
                <div class="input-group">
                    <i class='bx bx-user'></i>
                    <input name="firstname" type="text" placeholder="First name" required>
                </div>
                <div class="input-group">
                    <i class='bx bx-user'></i>
                    <input name="lastname" type="text" placeholder="Last name" required>
                </div>
            </div>
            
            <div class="input-group">
                <i class='bx bx-envelope'></i>
                <input name="email" type="email" placeholder="Email address" required>
            </div>
             
            <div class="input-group">
                <i class='bx bx-phone'></i>
                <input name="telephone" type="tel" placeholder="Phone number" required>
            </div>
            
            <div class="input-group">
                <i class='bx bx-lock-alt'></i>
                <input name="password" type="password" placeholder="Create password" required>
            </div>

            <div class="input-group">
                <i class='bx bx-lock-alt'></i>
                <input name="comfirme" type="password" placeholder="confirme password" required>
            </div>
                        
            <button name="submit" type="submit" class="submit-btn">Sign Up</button>
            
            <div class="login-link">
                Already have an account? <a id="showregister">Log in</a>
            </div>
        </form>
    </div>
    <div class="container hide" id="container_login">
        <div class="form-header">
            <h2>Login To Your Account</h2>
        </div>
        
        <form method="post" action="register.php" class="form-container">
            <?php echo showserreur('login_error') ?>
            <div class="input-group">
                <i class='bx bx-envelope'></i>
                <input name="email" type="email" placeholder="Email address" required>
            </div>
            
            <div class="input-group">
                <i class='bx bx-lock-alt'></i>
                <input name="password" type="password" placeholder="Create password" required>
            </div>
            
            <button name="login" id="login" type="submit" class="submit-btn">Sign Up</button>
            
            <div class="login-link">
                D'ont have an account? <a id="showlogin">Sign in</a>
            </div>
        </form>
    </div>
    <script>
        document.getElementById("showlogin").addEventListener("click", function(event) {
    event.preventDefault(); 
    document.getElementById("container_login").classList.add("hide");
    document.getElementById("container_register").classList.remove("hide");
});

document.getElementById("showregister").addEventListener("click", function(event) {
    event.preventDefault(); 
    document.getElementById("container_register").classList.add("hide");
    document.getElementById("container_login").classList.remove("hide");
});
document.addEventListener('DOMContentLoaded', function() {
        // Get theme from localStorage
        const savedTheme = localStorage.getItem('theme');
        
        // Apply dark mode if it was set
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }
    });
// On the page where dark mode is toggled:
function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');
    
    // Store in localStorage
    localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
}

        document.addEventListener('DOMContentLoaded', function() {
            // Get dark mode state from sessionStorage
            const isDarkMode = sessionStorage.getItem('darkMode') === 'true';
            
            // Apply dark mode if needed
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
            }
        });

    </script>
</body>
</html>