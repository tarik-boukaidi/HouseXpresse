<?php
include('connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ang">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HouseXpress-Choose your dream place</title>
    <link rel="stylesheet" href="styles.css">
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
                <a href="idex.php"><li>Home</li></a>
                <a href="#"><li id="buy">Buy</li></a>
                <a href="index.php"><li>Sell</li></a>
                <a href="#"><li id="aboutus">About Us</li></a>
                <a href="https://www.linkedin.com/in/tarik-boukaidi-25092b24b/"><li>Contact</li></a>
            </ul>
        <a href="index.php"><button type="submit">Signup</button></a>
        </div>
    </header>

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
    
            <form class="search-container" method="GET" action="idex.php" id="searchForm">
                <input type="hidden" id="typeInput" name="type" value="Sell">
        <div class="search">
            <label for="ville">Choisissez une ville :</label>
                <i class="fa-solid fa-location-dot"></i>
                <select id="ville" name="ville">
                <option value="">Ville</option>
                <option value="Casablanca">Casablanca</option>
                <option value="Rabat">Rabat</option>
                <option value="Fès">Fès</option>
                <option value="Marrakech">Marrakech</option>
                <option value="Agadir">Agadir</option>
                <option value="Tanger">Tanger</option>
                <option value="Meknes">Meknès</option>
                <option value="Oujda">Oujda</option>
                <option value="Kenitra">Kénitra</option>
                <option value="Tétouan">Tétouan</option>
                <option value="Nador">Nador</option>
                <option value="Laayoune">Laâyoune</option>
                <option value="Safi">Safi</option>
                <option value="Khouribga">Khouribga</option>
                <option value="El Jadida">El Jadida</option>
                <option value="Beni Mellal">Béni Mellal</option>
                <option value="Errachidia">Errachidia</option>
                <option value="Khemisset">Khemisset</option>
                <option value="Taza">Taza</option>
                <option value="Settat">Settat</option>
                <option value="Guelmim">Guelmim</option>
                <option value="Al Hoceima">Al Hoceïma</option>
                <option value="Ouarzazate">Ouarzazate</option>
                <option value="Tan-Tan">Tan-Tan</option>
                <option value="Dakhla">Dakhla</option>
                <option value="Essaouira">Essaouira</option>
                <option value="Larache">Larache</option>
                </select>
                <div class="button_search">
                    <button id="bt">Search Now</button>
                </div>
            </div>

             <div class="Categorie">
                <label for="Categorie">Select Categories:</label>
                    <select id="Categorie" name="Categorie">
                        <option value="Maison">Maison</option>
                        <option value="Garage">Garage</option>
                        <option value="Terrain">Terrain</option>
                    </select>
             </div>
            <div class="min">
             <label for="min">Min Price :</label>
                <select id="min" name="min_price">
                    <option value="">Min Price</option>
                    <option value="5000">5000</option>
                    <option value="7000">7000</option>
                    <option value="9000">9000</option>
                </select>
            </div>
            <div class="max">
                <label for="max">Max Price :</label>
                <select id="max" name="max_price" >
                    <option value="">Max Price</option>
                    <option value="15000">15000</option>
                    <option value="17000">17000</option>
                    <option value="19000">19000</option>
                </select>
            </div>
        </form>
    </main>
    <section class="main2" id="main2">
     <div class="ivideo">
       <video id="video" src="2.mp4"></video>
       <i id="play" class="bx bx-play"></i>
     </div>
     <div class="textbutton">
        <p class="m1">Efficiency. Transparency.<br> Control.</p>
        <p class="m2">Real Estate marketplace that allows buyers and sellers to easily execute a transaction on their own. The platform drives efficiency, cost transparency and control into the hands of the consumers. Hously is Real Estate Redefined.</p>
        <button>Learn More</button>
     </div>
    </section>
    <section class="main3" id="main3">
        <div class="h">
            <h2>How It Works</h2>
            <p class="texte">A great plateform to buy, sell and rent your properties without any agent or<br>commisions.</p>
        </div>
        <div class="icons">
            <div class="mini">
                <ion-icon name="home-outline"></ion-icon>
                <p>Evaluate Property</p>
                <p class="texte">If the distribution of letters and 'words' is<br>random, the reader will not be distracted<br>from making.</p>                </div>
            <div class="mini">
                <ion-icon name="briefcase-outline"></ion-icon>
                <p>Meeting with Agent</p>
                <p class="texte">If the distribution of letters and 'words' is<br>random, the reader will not be distracted<br>from making.</p>                </div>
            <div class="mini">
                <ion-icon name="key"></ion-icon>
                <p>Close the Deal</p>
                <p class="texte">If the distribution of letters and 'words' is<br>random, the reader will not be distracted<br>from making.</p>
            </div>

        </div>
    </section>

    <section class="main3">
     <div class="images">
        <?php
        $type = $_GET['type'] ?? 'Sell';
        $ville = isset($_GET['ville']) ? $_GET['ville'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * 9;
        $ville = $_GET['ville'] ?? '';
        $categorie = $_GET['Categorie'] ?? '';
        $min_price = $_GET['min_price'] ?? '';
        $max_price = $_GET['max_price'] ?? '';

        $conditions = [];
        $params = [];
        
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
                
                <?php endif; ?>
            </div>
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
                        <p class="texte">Prix</p>
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
    <section class="main4">
     <div class="meta-3">
        <div class="h">
            <h2>Have Question ? Get in touch!</h2>
            <p class="texte">A great plateform to buy, sell and rent your properties without any agent or<br>commisions.</p>
        </div>
        <a href="https://www.instagram.com/tarik_boukaidi/">
            <button class="btn">
                <ion-icon name="call-outline"></ion-icon>
                <span>Contact Us</span>
            </button>
        </a>
     </div>
    </section>
    <section class="sell-rent">
        <div class="sell">
          <p class="sell-text">
            Want to sell or rent your property?
          </p>
          <a href="index.php" class="sell-btn">Join Us</a>
        </div>
    </section>

      
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
                    <li><a href="https://www.instagram.com/tarik_boukaidi/">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.instagram.com/tarik_boukaidi/"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="https://www.linkedin.com/in/tarik-boukaidi-25092b24b/"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
            </div>
        </div>
        <button class="dark-mode-toggle" id="darkModeToggle">
            <i class='bx bx-moon'></i>
        </button>
        <div class="footer-bottom">
            <p>&copy; 2025 HouseXpress. All Rights Reserved.</p>
        </div>
    </footer>
    
    <button id="scrool" class="hide"><i class='bx bx-up-arrow-alt' ></i></button>

<script>
let scroll = document.getElementById("scrool");
let play = document.getElementById("play");
let video=document.getElementById("video");
const buttons = document.querySelectorAll(".h");scroll.onclick = function() {
    window.scrollTo({ top: 0, behavior: "smooth" });
};
window.onscroll = function() {
    if (window.scrollY > 140) {  
        scroll.classList.remove("hide"); 
    } else {
        scroll.classList.add("hide"); 
    }
};
video.addEventListener('play', () => {
    play.style.opacity = '0';
});
video.addEventListener('pause', () => {
    play.style.opacity = '1';
});

play.addEventListener('click', () => {
    if (video.paused) {
        video.play();
        video.setAttribute('controls', '');
    } else {
        video.pause();
        video.removeAttribute('controls');
    }
});
let aboutus = document.getElementById("aboutus");
aboutus.onclick = function() {
    window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
};
let buy = document.getElementById("buy");
    buy.onclick = function () {
        const section = document.querySelector(".main33");
        section.scrollIntoView({ behavior: "smooth" });
    };
// Dark Mode Toggle
const darkModeToggle = document.getElementById('darkModeToggle');
const body = document.body;

// Check for saved user preference
const currentTheme = localStorage.getItem('theme');
if (currentTheme === 'dark') {
    body.classList.add('dark-mode');
    darkModeToggle.innerHTML = '<i class="bx bx-sun"></i>';
}

// Toggle dark mode
darkModeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        darkModeToggle.innerHTML = '<i class="bx bx-sun"></i>';
    } else {
        localStorage.setItem('theme', 'light');
        darkModeToggle.innerHTML = '<i class="bx bx-moon"></i>';
    }

});
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

    document.getElementById('bt').addEventListener('click', function() {
    localStorage.setItem('hideSections', 'true');
});

document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('hideSections') === 'true') {
        document.getElementById('main2').style.display = 'none';
        document.getElementById('main3').style.display = 'none';
        localStorage.removeItem('hideSections'); // Optionnel: ne le supprimez pas si vous voulez que ça persiste
    }
});
</script>
</body>
</html>
