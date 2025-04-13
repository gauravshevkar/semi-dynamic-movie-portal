let movie=document.getElementsByClassName('movie')[0];





  let movie_json_url = "../json/main.json";


  document.addEventListener("DOMContentLoaded", function () {
    fetch(movie_json_url)
    .then(response => response.json())
    .then(products => {

      // data filter 
      let product_array = products.filter(ele => {
        return ele.type === "Movie";
      })

           
      product_array.forEach((product , i) => {
      let { title, url, genre,date,poster,imdb,shorts } = product;
      let productCard = document.createElement("a");
      productCard.classList.add("card");

      productCard.innerHTML = `
              <img src="${poster}" alt="" class="poster">
              <div class="rest_card">
                <video src="${shorts} " loop autoplay muted ></video>
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

                movie.appendChild(productCard);
            });
        })
        .catch(error => console.error("Error loading products:", error));
});
