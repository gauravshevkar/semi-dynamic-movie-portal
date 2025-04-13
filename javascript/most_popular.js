let most_popular=document.getElementsByClassName('most_popular')[0];
let left_btn1= document.getElementsByClassName('popular-left')[0];
let right_btn1 = document.getElementsByClassName('popular-right')[0];
let cards1= document.getElementsByClassName('most_popular')[0];


// card left and right scroll  

 left_btn1.addEventListener('click', ()=> { 
    cards1.scrollLeft -= 140;
  }) 
  right_btn1.addEventListener('click', ()=> { 
    cards1.scrollLeft +=140;

  })


// json data load 

  let most_popular_json_url = "../json/main.json";


  document.addEventListener("DOMContentLoaded", function () {
    fetch(most_popular_json_url)
        .then(response => response.json())
        .then(products => {

          // data filter 
          let product_array = products.filter(ele => {
            return ele.popular_section === "most";
          })

          // only allow top 13 data 
          product_array.slice(0, 13).forEach((product , i) => {
          let { title, url, genre,date,poster,imdb,shorts } = product;
          let productCard = document.createElement("a");
          productCard.classList.add("card");

          productCard.innerHTML = `
                    <img src="${poster}" alt="" class="poster">
                    <div class="rest_card">
                        <video src="${shorts} "loop autoplay muted ></video>
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

                most_popular.appendChild(productCard);
            });
        })
        .catch(error => console.error("Error loading products:", error));
});





















