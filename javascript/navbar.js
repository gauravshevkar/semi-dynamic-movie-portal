// const menuIcon = document.querySelector('#menu-icon');
// const navbar = document.querySelector('.navbar');
// const navbg = document.querySelector('.nav-bg');
// menuIcon.addEventListener('click', () => {
//     menuIcon.classList.toggle('bx-x');
//     navbar.classList.toggle('active');
//     navbg.classList.toggle('active');
// });

// // collapse start 

// function toggleProfile() {
//     const box = document.getElementById('userProfile');
//     box.classList.toggle('open');
//   }
  
// Remove nav-open class on page load to prevent default blur
window.addEventListener('DOMContentLoaded', () => {
    document.body.classList.remove('nav-open');
});
  

const menuIcon = document.querySelector('#menu-icon');
const navbar = document.querySelector('.navbar');
const navbg = document.querySelector('.nav-bg');

// Handle toggle for menu
menuIcon.addEventListener('click', () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    navbg.classList.toggle('active');

    // Toggle body class based on menu state
    if (navbar.classList.contains('active')) {
        document.body.classList.add('nav-open');
    } else {
        document.body.classList.remove('nav-open');
    }
});

// Collapse start
function toggleProfile() {
    const box = document.getElementById('userProfile');
    box.classList.toggle('open');
}
  
document.addEventListener('click', function (event) {
    const profileBox = document.getElementById('userProfile');
    const profileBtn = document.querySelector('.profile-btn');
  
    if (
      profileBox.classList.contains('open') &&
      !profileBox.contains(event.target) &&
      !profileBtn.contains(event.target)
    ) {
      profileBox.classList.remove('open');
    }
  });




// Remove nav-open class and close nav when background is clicked
navbg.addEventListener('click', () => {
    document.body.classList.remove('nav-open');
    menuIcon.classList.remove('bx-x');
    navbar.classList.remove('active');
    navbg.classList.remove('active');
});


    



  






  
