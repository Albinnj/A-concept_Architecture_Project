// BANNER CAROUSEL VARIABLES
const slides = document.querySelectorAll('.banner-box');
const next = document.querySelector('#next');
const prev = document.querySelector('#prev');
const auto = true;
const intervalTime = 5000;
let slideInterval;

// BANNER CAROUSEL FUNCTIONS
const nextSlide = () => {
    const current = document.querySelector('.current');
    current.classList.remove('current');
    if (current.nextElementSibling) {
        current.nextElementSibling.classList.add('current');
    } else {
        slides[0].classList.add('current');
    }
    setTimeout(() => current.classList.remove('current'));
};

const prevSlide = () => {
    const current = document.querySelector('.current');
    current.classList.remove('current');
    if (current.previousElementSibling) {
        current.previousElementSibling.classList.add('current');
    } else {
        slides[slides.length - 1].classList.add('current');
    }
    setTimeout(() => current.classList.remove('current'));
};

// ARROW BUTTON FUNCTIONS
next.addEventListener('click', e => {
    nextSlide();
    if (auto) {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, intervalTime);
    }
});

prev.addEventListener('click', e => {
    prevSlide();
    if (auto) {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, intervalTime);
    }
});

// Wapp
function openWhatsApp() {
    window.open("https://wa.me/7090969074?text=Hello! I'm looking for an architectural services.Would A-Concept Architecture be available for a consultation?");
}  

// AUTOSLIDE FUNCTION
if (auto) {
    slideInterval = setInterval(nextSlide, intervalTime);
}

// MENU BUTTON VARIABLES
const menuBtn = document.querySelector(".menu-button");
const closeBtn = document.querySelector(".close-button");
const navigation = document.querySelector(".navigation ul");
const navigationItems = document.querySelectorAll(".navigation ul li a");

// MENU BUTTON FUNCTIONS
menuBtn.addEventListener("click", () => {
    menuBtn.classList.toggle("active");
    closeBtn.classList.toggle("active");
    navigation.classList.toggle("active");
});

closeBtn.addEventListener("click", () => {
    menuBtn.classList.toggle("active");
    closeBtn.classList.toggle("active");
    navigation.classList.toggle("active");
});

navigationItems.forEach((navigationItem) => {
    navigationItem.addEventListener("click", () => {
        menuBtn.classList.remove("active");
        closeBtn.classList.remove("active");
        navigation.classList.remove("active");
    });
});
/*cobtact form*/
src="https://smtpjs.com/v3/smtp.js"
function sendMail() {
    Email.send({
        SecureToken: "06e3431e-d1fa-43c0-88c4-e72019bd5ba2",
        Host: "smtp.gmail.com",
        Username: "malluhub27@gmail.com",
        Password: "06e3431e-d1fa-43c0-88c4-e72019bd5ba2", // Use an App Password instead of your actual password
        To: 'malluhub27@gmail.com',
        From: document.getElementById("email").value,
        Subject: "A-concept Customer Details",
        Body: "Name: " + document.getElementById("name").value +
              "<br> Email: " + document.getElementById("email").value +
              "<br> Phone: " + document.getElementById("phone").value +
              "<br> Message: " + document.getElementById("message").value
    }).then(
        message => alert(message)
    ).catch(
        error => alert("Failed to send email: " + error)
    );
}