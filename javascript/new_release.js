
let new_release = document.getElementsByClassName('new_release')[0];

let left_btn= document.getElementsByClassName('new-left')[0];
 let right_btn = document.getElementsByClassName('new-right')[0];
 let cards= document.getElementsByClassName('new_release')[0];

//  card_carousel scroll 
 left_btn.addEventListener('click', ()=> { 
    cards.scrollLeft -= 140;
  }) 
  right_btn.addEventListener('click', ()=> { 
    cards.scrollLeft +=140;

  })




let new_release_json_url = "../json/main.json";

document.addEventListener("DOMContentLoaded", function () {
    fetch(new_release_json_url)
    .then(response => response.json())
    .then(products => {

      // data filter 
      let product_array = products.filter(ele => {
        return ele.new_release_section === "New_release";
      })

      //  allow only to 13 datas  
      product_array.slice(0, 13).forEach((product , i) => {
      let { title, url, genre,date,poster,imdb,trailer,shorts } = product;
      let productCard = document.createElement("a");
      productCard.classList.add("card");

      productCard.innerHTML = `
            <img src="${poster}" alt="" class="poster">
              <div class="rest_card">
                <video src="${shorts} "  autoplay muted loop></video>
                <div class="container_detail">
                  <h4>${title}</h4>
                  <div class="sub">
                    <p>${genre} , ${date}</p>
                    <h3><span>IMDB</span><i class="bi bi-star-fill"></i>${imdb} </h3>
                  </div>
                </div>
              </div>
                `;

                // Click event to open product details page
                productCard.addEventListener("click", function () {
                    window.location.href = `../html/producted.php?id=${product.id}`;
                });

                new_release.appendChild(productCard);
            });
        })
        .catch(error => console.error("Error loading products:", error));
});

