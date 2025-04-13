

  // let main_banner = "../json/main.json";

  // fetch(main_banner).then (Response => Response.json()) 
  //   .then((data) => {


  //     document.getElementById('banner').innerHTML = `<img src="${data[0].mainbanner} " alt="" class="index-banner">`;
  //       document.getElementById('title').innerText = data[0].title;
  //       document.getElementById('gen').innerText = data[0].genre;
  //       document.getElementById('duration').innerText = data[0].duration;
  //       document.getElementById('date').innerText = data[0].date;
  //       document.getElementById('rate').innerHTML = `<span>IMDB</span><i class="bi bi-star-fill"></i> ${data[0].imdb} `
  //       document.getElementById('paragraph').innerText = data[0].paragraph;
  //   })  
    


let main_banner = "../json/main.json";

document.addEventListener("DOMContentLoaded", function () {
  fetch(main_banner)
    .then((response) => response.json())
    .then((products) => {

      // data filter 
      let data = products.filter(ele => ele.home_banner_section === "Yes");

      if (data.length > 0) {  // Ensure data[0] exists before accessing its properties
        document.getElementById('banner').innerHTML = `<img src="${data[0].mainbanner}" alt="" class="index-banner">`;
        document.getElementById('title').innerText = data[0].title;
        document.getElementById('gen').innerText = data[0].genre;
        document.getElementById('duration').innerText = data[0].duration;
        document.getElementById('date').innerText = data[0].date;
        document.getElementById('rate').innerHTML = `<span>IMDB</span><i class="bi bi-star-fill"></i> ${data[0].imdb}`;
        document.getElementById('paragraph').innerText = data[0].paragraph;

        let main_banner1 = document.getElementById('play');

        // Click event to open product details page
        main_banner1.addEventListener("click", function () {
          window.location.href = `../html/producted.php?id=${data[0].id}`;
        });
      } else {
        console.error("No products found for the new release section.");
      }
    })
    .catch(error => console.error("Error loading products:", error));
});
