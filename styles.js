let scroll = document.getElementById("scrool");
const menu = document.querySelector("section.user");
// let user_picture = document.querySelector("a i.bx-user-circle");
let user_picture = document.getElementsByClassName('hakimi')[0];
let click=false;
user_picture.onclick=function(event){
     event.stopPropagation();
if(!click){
    menu.classList.remove("hide_u");
}else{
    menu.classList.add("hide_u");
}
click=!click;
}

document.onclick = function() {
    if (click) {
        menu.classList.add("hide_u");
        click = false;
    }
    };
window.onscroll = function() {
    if (window.scrollY > 140) {  
        scroll.classList.remove("hide"); 
    } else {
        scroll.classList.add("hide"); 
    }
};
// Dark Mode Functionality
const userDarkModeBtn = document.getElementById('userDarkModeBtn');
const body = document.body;

// Check for saved user preference
const currentTheme = localStorage.getItem('theme');
if (currentTheme === 'dark') {
    enableDarkMode();
}

// Toggle dark mode when user clicks the button
if (userDarkModeBtn) {
    userDarkModeBtn.addEventListener('click', toggleDarkMode);
}

function toggleDarkMode() {
    if (body.classList.contains('dark-mode')) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
}

function enableDarkMode() {
    body.classList.add('dark-mode');
    localStorage.setItem('theme', 'dark');
    if (userDarkModeBtn) {
        userDarkModeBtn.innerHTML = '<i class="bx bx-sun"></i><p>Light Mode</p>';
    }
}

function disableDarkMode() {
    body.classList.remove('dark-mode');
    localStorage.setItem('theme', 'light');
    if (userDarkModeBtn) {
        userDarkModeBtn.innerHTML = '<i class="bx bx-moon"></i><p>Dark Mode</p>';
    }
}
const buttons = document.querySelectorAll(".h");scroll.onclick = function() {
    window.scrollTo({ top: 0, behavior: "smooth" });
};
let aboutus = document.getElementById("aboutus");
aboutus.onclick = function() {
    window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
};
let buy = document.getElementById("buy");
    buy.onclick = function () {
        const section = document.querySelector(".main3");
        section.scrollIntoView({ behavior: "smooth" });
    };
let active=document.getElementById("h1");
let active1=document.getElementById("h2");
active.onclick=function(){
 active.classList.add("active");
 active1.classList.remove("active");
}
active1.onclick=function(){
    active.classList.remove("active");
    active1.classList.add("active");
}
