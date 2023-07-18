let left_btn = document.getElementsByClassName('bi-chevron-left')[0];
let right_btn = document.getElementsByClassName('bi-chevron-right')[0];
let cards = document.getElementsByClassName('cards')[0];
let search = document.getElementsByClassName('search')[0];
let search_input = document.querySelector('.search_input'); // Add the correct selector for the search input

left_btn.addEventListener('click', () => {
    cards.scrollLeft -= 140;
});

right_btn.addEventListener('click', () => {
    cards.scrollLeft += 140;
});


let json_url = "json/myfile.json";

fetch(json_url)
    .then(Response => Response.json())
    .then((data) => {
        data.forEach((ele, i) => {
            let { title, movie_rating, release_year, cover_page, genre } = ele;
            let card = document.createElement('a');
            card.classList.add('card');
            card.href = `display-movie.php?title=${title}`;
            card.innerHTML = `
                <img src="${cover_page}" alt="${title}" class="poster">
                <div class="rest_card"> 
                    <img src="${cover_page}" alt="${title}">
                    <div class="cont">
                        <h4>${title}</h4>
                        <div class="sub">
                            <p> ${genre}, ${release_year}</p>
                            <h3><span>IMDB </span><i class="bi bi-star-fill"></i> ${movie_rating}</h3>
                        </div>
                    </div>
                </div>
            `;
            cards.appendChild(card);
        });

        document.getElementById('title').innerText = data[0].title;
        document.getElementById('gen').innerText = data[0].genre;
        document.getElementById('plot').innerText = data[0].plot;
        document.getElementById('date').innerText = data[0].release_year;
        document.getElementById('rate').innerHTML = `<span>IMDB </span><i class="bi bi-star-fill"></i> ${data[0].movie_rating}`;

        data.forEach(element => {
            let { title, movie_rating, release_year, cover_page, genre, url } = element;
            let card = document.createElement('a');
            card.classList.add('card');
            card.href = url;
            card.innerHTML = `
                <img src="${cover_page}" alt="">
                <div class="cont">
                    <h3>${title}</h3>
                    <p>${genre}, ${release_year} , <span>IMDB </span><i class="bi bi-star-fill"></i>${movie_rating}</p>
                </div> 
            `;
            search.appendChild(card);
        });

        search_input.addEventListener('keyup', () => {
            let filter = search_input.value.toUpperCase();
            let a = search.getElementsByTagName('a');

            for (let index = 0; index < a.length; index++) {
                let b = a[index].getElementsByClassName('cont')[0];
                let textValue = b.textContent || b.innerText;
                if (textValue.toUpperCase().indexOf(filter) > -1) {
                    a[index].style.display = "flex";
                    search.style.visibility = "visible";
                    search.style.opacity = 1;
                } else {
                    a[index].style.display = "none";
                }
            }

            if (search_input.value.length === 0) {
                search.style.visibility = "hidden";
                search.style.opacity = 0;
            }
        });
        let video = document.getElementsByTagName('video')[0];
        let play = document.getElementById('play');
        play.addEventListener('click', () => {
          if (video.paused) {
            video.play();
            play.innerHTML = `Play  <i class="bi bi-pause-fill"></i>`;
          } else {
            play.innerHTML = 'WATCH <i class="bi bi-play-fill"></i>';
            video.pause();
          }

        });
        
        let series = document.getElementById('series');
        series.addEventListener('click',()=>{
            cards.innerHTML= '';
            let series_array = data.filter(ele => {
                return ele.type === "series";
            })

        });
        



       
       

        
        
    });
