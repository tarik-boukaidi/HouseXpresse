<?php
include('connect.php');
session_start();
$user_information = [
    'first_name' => $_SESSION['user_name1'] ?? '',
    'last_name' => $_SESSION['user_name2'] ?? '',
    'email' => $_SESSION['email'] ?? '',
    'password' => $_SESSION['password'] ?? '',
    'telephone' => $_SESSION['telephone'] ?? '',
    'id' => $_SESSION['id'] ?? '',
    'photo' => $_SESSION['image'] ?? '',
];
?>
<!DOCTYPE html>
<html lang="ang">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HouseXpress-Choose your dream place</title>
    <link rel="stylesheet" href="stylesafterlogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://kit.fontawesome.com/a9427fd68b.js" crossorigin="anonymous"></script>
        <link rel="icon" href="mini.png" type="image/x-png">

</head>
<body>
    <header>
        <div class="logo">
            <h1>House<span class="highlight">X</span>press</h1>      
        </div>
        <div class="nav">
            <ul class="items">
                <a href="after_login.php"><li>Home</li></a>
                <a href="#"><li id="buy">Buy</li></a>
                <a href="publish_pub.php"><li>Sell</li></a>
                <a href="#"><li id="aboutus">About Us</li></a>
                <a href="https://www.linkedin.com/in/tarik-boukaidi-25092b24b/"><li>Contact</li></a>
            </ul>
            <?php if (empty($user_information['photo'])): ?>
                <a href="#" class="hakimi"><i class='bx bx-user-circle'></i></a>
            <?php else:
                $photo = $user_information['photo'];
            ?>  <div class="profile hakimi">
                <img src="<?php echo $photo; ?>" alt="user_picture" class="bx-user-circle">
                </div>
            <?php endif; ?>

        </div>
    </header>
    <section class="user hide_u">
        <div class="user_options">
            <div class="user_modifier">
                <div class="user_information">
                    <?php
                    $photo = !empty($user_information['photo']) ? $user_information['photo'] : 'pictures/C.jpeg';
                    ?>
                    <img src="<?php echo $photo; ?>" alt="user_picture">
                    <p><?php echo $user_information['first_name'] . ' ' . $user_information['last_name']; ?></p>
                </div>
            </div>
            <hr>
            <a href="user_modification1.php">
                <button class="user_modifier uss">
                    <i class='bx bxs-user-detail' ></i>
                    <p>Modifier Profil</p>
                </button>
            </a>
            
            <button class="user_modifier uss" id="userDarkModeBtn">
                <i class='bx bx-moon'></i>
                <p>Dark Mode</p>
            </button>

            <a href="publish_pub.php">
                <button class="user_modifier uss">
                    <i class='bx bxs-plus-square'></i>
                    <p>Publish Pub</p>
                </button>
            </a>

            <a href="seemyownpub.php">
                <button class="user_modifier uss">
                    <i class='bx bx-photo-album'></i>
                    <p>Voire Votre Pub</p>
                </button>
            </a>
            <a href="avis.php">
                <button class="user_modifier uss">
                    <i class='bx bxs-message-error' ></i>              
                    <p>give your opinion</p>
                </button>
            </a>
            <hr>
            <a href="logout.php">
                <button class="user_modifier uss">
                    <i class='bx bx-log-out bx-flip-horizontal' ></i>
                    <p>Log Out</p>
                </button>
            </a>
        </div>
    </section>

    <main>
        <section class="house">
            <p class="main">We will help you find<br>your <span class="highlight">Wonderful</span> home</p>
            <p class="h">A great plateform to buy, sell and rent your properties without<br>any agent or commisions.</p>
        </section>
        <div class="t">
            <div class="button">
                <button type="button" id="h1" class="h active" data-type="Sell">Sell</button>
                <button type="button" id="h2" class="h" data-type="Rent">Rent</button>
            </div>
        
            <form class="search-container" method="GET" action="after_login.php" id="searchForm">
                <input type="hidden" id="typeInput" name="type" value="Sell">
                <div class="search">
                    <label for="ville">Choose a city:</label>
                    <i class="fa-solid fa-location-dot"></i>
                    <select id="ville" name="ville">
                        <option value="">Ville</option>
                        <option value="Casablanca" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Casablanca') ? 'selected' : ''; ?>>Casablanca</option>
                        <option value="Rabat" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Rabat') ? 'selected' : ''; ?>>Rabat</option>
                        <option value="Fès" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Fès') ? 'selected' : ''; ?>>Fès</option>
                        <option value="Marrakech" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Marrakech') ? 'selected' : ''; ?>>Marrakech</option>
                        <option value="Agadir" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Agadir') ? 'selected' : ''; ?>>Agadir</option>
                        <option value="Tanger" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Tanger') ? 'selected' : ''; ?>>Tanger</option>
                        <option value="Meknes" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Meknes') ? 'selected' : ''; ?>>Meknès</option>
                        <option value="Oujda" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Oujda') ? 'selected' : ''; ?>>Oujda</option>
                        <option value="Kenitra" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Kenitra') ? 'selected' : ''; ?>>Kénitra</option>
                        <option value="Tétouan" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Tétouan') ? 'selected' : ''; ?>>Tétouan</option>
                        <option value="Nador" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Nador') ? 'selected' : ''; ?>>Nador</option>
                        <option value="Laayoune" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Laayoune') ? 'selected' : ''; ?>>Laâyoune</option>
                        <option value="Safi" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Safi') ? 'selected' : ''; ?>>Safi</option>
                        <option value="Khouribga" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Khouribga') ? 'selected' : ''; ?>>Khouribga</option>
                        <option value="El Jadida" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'El Jadida') ? 'selected' : ''; ?>>El Jadida</option>
                        <option value="Beni Mellal" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Beni Mellal') ? 'selected' : ''; ?>>Béni Mellal</option>
                        <option value="Errachidia" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Errachidia') ? 'selected' : ''; ?>>Errachidia</option>
                        <option value="Khemisset" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Khemisset') ? 'selected' : ''; ?>>Khemisset</option>
                        <option value="Taza" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Taza') ? 'selected' : ''; ?>>Taza</option>
                        <option value="Settat" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Settat') ? 'selected' : ''; ?>>Settat</option>
                        <option value="Guelmim" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Guelmim') ? 'selected' : ''; ?>>Guelmim</option>
                        <option value="Al Hoceima" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Al Hoceima') ? 'selected' : ''; ?>>Al Hoceïma</option>
                        <option value="Ouarzazate" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Ouarzazate') ? 'selected' : ''; ?>>Ouarzazate</option>
                        <option value="Tan-Tan" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Tan-Tan') ? 'selected' : ''; ?>>Tan-Tan</option>
                        <option value="Dakhla" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Dakhla') ? 'selected' : ''; ?>>Dakhla</option>
                        <option value="Essaouira" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Essaouira') ? 'selected' : ''; ?>>Essaouira</option>
                        <option value="Larache" <?php echo (isset($_GET['ville']) && $_GET['ville'] == 'Larache') ? 'selected' : ''; ?>>Larache</option>
                    </select>
                    <div class="button_search">
                        <button type="submit">Search Now</button>
                    </div>
                </div>

                <div class="Categorie">
                    <label for="Categorie">Select Categories:</label>
                    <select id="Categorie" name="Categorie">
                        <option value="Maison" <?php echo (isset($_GET['Categorie']) && $_GET['Categorie'] == 'Maison') ? 'selected' : ''; ?>>Maison</option>
                        <option value="Garage" <?php echo (isset($_GET['Categorie']) && $_GET['Categorie'] == 'Garage') ? 'selected' : ''; ?>>Garage</option>
                        <option value="Terrain" <?php echo (isset($_GET['Categorie']) && $_GET['Categorie'] == 'Terrain') ? 'selected' : ''; ?>>Terrain</option>
                    </select>
                </div>
                <div class="min">
                    <label for="min">Min Price :</label>
                    <select id="min" name="min_price">
                        <option value="">Min Price</option>
                        <option value="5000" <?php echo (isset($_GET['min_price']) && $_GET['min_price'] == '5000') ? 'selected' : ''; ?>>5000</option>
                        <option value="7000" <?php echo (isset($_GET['min_price']) && $_GET['min_price'] == '7000') ? 'selected' : ''; ?>>7000</option>
                        <option value="9000" <?php echo (isset($_GET['min_price']) && $_GET['min_price'] == '9000') ? 'selected' : ''; ?>>9000</option>
                    </select>
                </div>
                <div class="max">
                    <label for="max">Max Price :</label>
                    <select id="max" name="max_price">
                        <option value="">Max Price</option>
                        <option value="15000" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '15000') ? 'selected' : ''; ?>>15000</option>
                        <option value="17000" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '17000') ? 'selected' : ''; ?>>17000</option>
                        <option value="19000" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '19000') ? 'selected' : ''; ?>>19000</option>
                    </select>
                </div>
            </form>
        </div>
    </main>

    <section class="main3">
        <div class="images">
            <?php
            $type = $_GET['type'] ?? 'Sell';
            $ville = $_GET['ville'] ?? '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * 9;
            $categorie = $_GET['Categorie'] ?? '';
            $min_price = $_GET['min_price'] ?? '';
            $max_price = $_GET['max_price'] ?? '';

            $conditions = [];
            $params = [];
            
            // Add type condition
            $conditions[] = 'type = :type';
            $params[':type'] = $type;
            
            if (!empty($ville)) {
                $conditions[] = 'ville = :ville';
                $params[':ville'] = $ville;
            }
            
            if (!empty($categorie)) {
                $conditions[] = 'Categorie = :categorie';
                $params[':categorie'] = $categorie;
            }
            
            if (!empty($min_price)) {
                $conditions[] = 'Prix >= :min_price';
                $params[':min_price'] = $min_price;
            }
            
            if (!empty($max_price)) {
                $conditions[] = 'Prix <= :max_price';
                $params[':max_price'] = $max_price;
            }
            
            $whereClause = '';
            if (!empty($conditions)) {            
                $whereClause = 'WHERE ' . implode(' AND ', $conditions);
            }
            
            $countQuery = "SELECT COUNT(*) FROM publications $whereClause";
            $stmt1 = $pdo->prepare($countQuery);
            $stmt1->execute($params);
            $total = $stmt1->fetchColumn();
            $totalPages = ceil($total / 9);
            
            $dataQuery = "SELECT * FROM publications $whereClause ORDER BY DateTime DESC LIMIT $start, 9";
            $stmt = $pdo->prepare($dataQuery);
            $stmt->execute($params);
            

            while ($row = $stmt->fetch()):
                $imageArray = json_decode($row['image'], true);
                $carouselId = 'carousel_' . $row['id'];
            ?>
            <div class="boxes">
                <?php if ($imageArray && is_array($imageArray) && count($imageArray) > 0): ?>
                <div class="carousel" id="<?php echo $carouselId; ?>">
                    <?php foreach ($imageArray as $index => $imagePath): ?>
                        <a href="viewpublication.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" class="carousel-image" style="<?php echo $index === 0 ? '' : 'display:none;'; ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="border">
                <div class="twachi1">
                <span class="badge <?php echo ($row['Type'] == 'Rent') ? 'rent' : 'sell'; ?>">
                    <?php echo htmlspecialchars($row['Type']); ?>
                </span>
                    <div class="small_image">
                        <i class='bx bx-camera'></i>
                        <?php echo count($imageArray) ?>
                    </div>
                </div>
                    <div class="card-content">
                        <p><?php echo $row['titre'] ?></p>
                    </div>
                    <div class="twachi">
                        <hr>
                        <div class="dakchi">
                            <i class='bx bx-cube'></i>
                            <p><?php echo $row['Surface'].' m²'?></p>
                        </div>
                        <div class="dakchi">
                            <i class='bx bx-bed' ></i>
                            <p><?php echo $row['chambres'].' rooms'?></p>
                        </div>
                        <div class="dakchi">
                            <i class='bx bx-bath'></i>
                            <p><?php echo $row['salles'].' baths'?></p>
                        </div>
                        <hr>
                    </div>
                    <div class="card_price">
                        <div>
                            <p class="texte">Price</p>
                            <p class="price"><?php echo $row['Prix'].' DH' ?></p>
                        </div>
                        <div class="meta-title">
                            <p class="texte">Publie le:</p>
                            <div class="l">
                                <div class="star">
                                    <i class='bx bx-time'></i>
                                    <?php echo $row['DateTime'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>&type=<?php echo $type; ?><?php 
                echo isset($_GET['ville']) ? '&ville='.$_GET['ville'] : '';
                echo isset($_GET['Categorie']) ? '&Categorie='.$_GET['Categorie'] : '';
                echo isset($_GET['min_price']) ? '&min_price='.$_GET['min_price'] : '';
                echo isset($_GET['max_price']) ? '&max_price='.$_GET['max_price'] : '';
            ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&type=<?php echo $type; ?><?php 
                echo isset($_GET['ville']) ? '&ville='.$_GET['ville'] : '';
                echo isset($_GET['Categorie']) ? '&Categorie='.$_GET['Categorie'] : '';
                echo isset($_GET['min_price']) ? '&min_price='.$_GET['min_price'] : '';
                echo isset($_GET['max_price']) ? '&max_price='.$_GET['max_price'] : '';
            ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>&type=<?php echo $type; ?><?php 
                echo isset($_GET['ville']) ? '&ville='.$_GET['ville'] : '';
                echo isset($_GET['Categorie']) ? '&Categorie='.$_GET['Categorie'] : '';
                echo isset($_GET['min_price']) ? '&min_price='.$_GET['min_price'] : '';
                echo isset($_GET['max_price']) ? '&max_price='.$_GET['max_price'] : '';
            ?>">&raquo;</a>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>A great plateform to buy, sell and rent your properties without any agent or commisions.</p>
            </div>
            <div class="footer-section">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="#">Terms of Services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="https://www.linkedin.com/in/tarik-boukaidi-25092b24b/">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="https://www.linkedin.com/in/tarik-boukaidi-25092b24b/"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 HouseXpress. All Rights Reserved.</p>
        </div>
    </footer>
    
    <button id="scrool" class="hide"><i class='bx bx-up-arrow-alt' ></i></button>

    <script src="styles.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sellBtn = document.getElementById('h1');
        const rentBtn = document.getElementById('h2');
        const typeInput = document.getElementById('typeInput');
        
        // Set initial active button based on current type
        const urlParams = new URLSearchParams(window.location.search);
        const currentType = urlParams.get('type') || 'Sell';
        
        if (currentType === 'Rent') {
            sellBtn.classList.remove('active');
            rentBtn.classList.add('active');
            typeInput.value = 'Rent';
        }
        
        // Button click handlers
        sellBtn.addEventListener('click', function() {
            sellBtn.classList.add('active');
            rentBtn.classList.remove('active');
            typeInput.value = 'Sell';
        });
        
        rentBtn.addEventListener('click', function() {
            sellBtn.classList.remove('active');
            rentBtn.classList.add('active');
            typeInput.value = 'Rent';
        });
    });
    </script>
</body>
</html>