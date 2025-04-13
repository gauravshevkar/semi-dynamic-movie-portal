
let search=document.getElementsByClassName('search')[0];
let search_input =document.getElementById('search_input');



let search1_json_url = "../json/main.json";

document.addEventListener("DOMContentLoaded", function () {
    fetch(search1_json_url)
        .then(response => response.json())
        .then(products => {

        
           
          products.forEach((product , i) => {
              let { title, url, genre,date,poster,imdb } = product;
                let productCard = document.createElement("a");
                productCard.classList.add("search_card");

                productCard.innerHTML = `
                       <img src="${poster} " alt="">
                            <div class="search_details">
                                <h3> ${title} </h3>
                                <p>${genre} ,  ${date}, <span>IMDB</span><i class="bi bi-star-fill"></i>${imdb} </p>
                            </div>
                `;

                // Click event to open product details page
                productCard.addEventListener("click", function () {
                    window.location.href = `../html/producted.php?id=${product.id}`;
                });

                search.appendChild(productCard);
            });
               // search filter 
    search_input.addEventListener('keyup', ()=>{
        let filter = search_input.value.toUpperCase();
        let a = search.getElementsByTagName('a');

        for (let index= 0; index < a.length; index++){
            let b = a[index].getElementsByClassName('search_details')[0];
            
            let TextValue = b.textContent || b.innerText;

         if (TextValue.toUpperCase().indexOf(filter) > -1) {
             a[index].style.display = "flex";
              search.style.visibility = "visible";
              search.style.opacity = 1;
             }
         else { 
            a[index].style.display = "none";
         } 
         if (search_input.value == 0) {
             search.style.visibility = "hidden"; search.style.opacity=0;
         }
        }
            
    })
        })
        .catch(error => console.error("Error loading products:", error));
});




// Below code use for multiple json file connect 


// const lists = ["./json/New_release.json", "./json/try.json"]

// let search_json_url = "./json/New_release.json";
// let search1_json_url = "./json/try.json";
// let search2_json_url="./json/most_popular.json";

// Promise.all([
//     fetch(search_json_url).then(response => response.json()),
//     fetch(search1_json_url).then(response => response.json()),
//     fetch(search2_json_url).then(response => response.json())

// ])
// .then(([data1, data2, data3]) => {


//     // Check if data1 and data2 are arrays
//     let combinedData = [...data1, ...data2, ...data3]; 

//     combinedData.forEach(element => {
//         let { name, Language, sposter, url, genre, date, bposter, image, imdb } = element;
        
//         let card = document.createElement('a');
//         card.classList.add("search_card");
//         card.href = url;
//         card.innerHTML = `
//             <img src="${image}" alt="">
//             <div class="search_details">
//                 <h3>${name}</h3>
//                 <p>${genre}, ${date}, <span>IMDB</span> <i class="bi bi-star-fill"></i> ${imdb}</p>
//             </div>
//         `;

//         search.appendChild(card);
//     });

//     // search filter 
//     search_input.addEventListener('keyup', ()=>{
//         let filter = search_input.value.toUpperCase();
//         let a = search.getElementsByTagName('a');

//         for (let index= 0; index < a.length; index++){
//             let b = a[index].getElementsByClassName('search_details')[0];
            
//             let TextValue = b.textContent || b.innerText;

//          if (TextValue.toUpperCase().indexOf(filter) > -1) {
//              a[index].style.display = "flex";
//               search.style.visibility = "visible";
//               search.style.opacity = 1;
//              }
//          else { 
//             a[index].style.display = "none";
//          } 
//          if (search_input.value == 0) {
//              search.style.visibility = "hidden"; search.style.opacity=0;
//          }
//         }
            
//     })

// })
