let nextButton = document.getElementById('next');
let prevButton = document.getElementById('prev');
let carousel = document.querySelector('.carousel');
let listHTML = document.querySelector('.carousel .list');

// upcoming_films_carouse slider button 
nextButton.onclick = function(){
    showSlider('next');
}
prevButton.onclick = function(){
    showSlider('prev');
}
let unAcceppClick;
const showSlider = (type) => {
    nextButton.style.pointerEvents = 'none';
    prevButton.style.pointerEvents = 'none';

    carousel.classList.remove('next', 'prev');
    let items = document.querySelectorAll('.carousel .list .item');
    if(type === 'next'){
        listHTML.appendChild(items[0]);
        carousel.classList.add('next');
    }else{
        listHTML.prepend(items[items.length - 1]);
        carousel.classList.add('prev');
    }
    clearTimeout(unAcceppClick);
    unAcceppClick = setTimeout(()=>{
        nextButton.style.pointerEvents = 'auto';
        prevButton.style.pointerEvents = 'auto';
    }, 2000)
}







let upcoming_films_carousel=document.getElementsByClassName('list')[0];

  let upcoming_films_carousel_json_url = "../json/upcoming_films_carousel.json";




// Fetch and Display Carousel Items
document.addEventListener("DOMContentLoaded", function () {
    fetch(upcoming_films_carousel_json_url)
        .then(response => response.json())
        .then(data => {
            data.forEach((ele) => {
                let { id, title, language, url, genre, date, poster, type, paragraph, duration } = ele;

                let card = document.createElement('div');
                card.classList.add("item");

                card.innerHTML = `
                    <img src="${poster}" alt="${title}">
                    <div class="introduce">
                        <div class="title">UPCOMING FILMS</div>
                        <div class="topic">${title}</div>
                        <div class="des">${paragraph}</div>
                        <div class="time flex">
                            <span><i class="fas fa-circle"></i> ${duration}</span>
                            <span><i class="fas fa-circle"></i> ${type}</span>
                            <span><i class="fas fa-circle"></i> ${date}</span>
                            <span><i class="fas fa-circle"></i> ${genre}</span>
                            <span><i class="fas fa-circle"></i> ${language}</span>
                        </div>
                    <a href="../html/upcoming_product.php?id=${id}" class="watch_trailer">WATCH TRAILER &#8599;</a>

                    </div>


                `;

                upcoming_films_carousel.appendChild(card);
            });
        })
        .catch(error => console.error("Error loading products:", error));
});
