function init_modals(divs) {
    for (let i = 0; i < divs.length; i++) {
        divs[i].addEventListener('click', (e) => {
            let modalBg = generate_modal();
            document.querySelector(".closeModal").addEventListener('click', () => {
                modalBg.classList.remove('modalActive');
                document.body.removeChild(modalBg);
            });

            let game_id = "game_id=" + e.currentTarget.getAttribute("game-id");

            //AJAX
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "index.php?action=gameView&" + game_id, true);
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let content = JSON.parse(xhr.responseText);
                    let div_generated = generate_content_modal(content);
                    modalBg.firstElementChild.firstElementChild.appendChild(div_generated);
                    generate_rating_System(game_id);
                }
            };
            xhr.send(null);
        });
    }
}

function generate_modal() {
    let modalBg = document.createElement('div');
    modalBg.className = "modalBg";
    modalBg.classList.add('modalActive');

    let viewCont = document.createElement('div');
    viewCont.className = "modalGameViewContainer";

    let gameCont = document.createElement('div');
    gameCont.className = "gameInfosContainer";


    let closeModal = document.createElement('span');
    closeModal.className = "closeModal";
    closeModal.textContent = "X";

    viewCont.appendChild(gameCont);
    viewCont.appendChild(closeModal);

    modalBg.appendChild(viewCont);

    return document.body.appendChild(modalBg);
}

function generate_content_modal(content) {

    let gameView = document.createElement('div');
    gameView.className = "gameView";

    let gameViewHeader = document.createElement('div');
    gameViewHeader.className = "gameViewHeader";

    let gameViewImg = document.createElement('img');
    gameViewImg.className = "gameViewImg";
    gameViewImg.src = "./images/" + content.img;

    let gameViewName = document.createElement('h3');
    gameViewName.textContent = content.name;

    gameViewHeader.appendChild(gameViewImg);
    gameViewHeader.appendChild(gameViewName);

    let gameViewContent = document.createElement('div');
    gameViewContent.className = "gameViewContent";

    let gameViewText = document.createElement('p');
    gameViewText.textContent = content.fullTxt;

    let gameViewinfo = document.createElement('p');
    gameViewinfo.textContent =
        content.minP + " - " + content.maxP + ' Players | ' + content.minT + " - " + content.maxT + " Minutes";

    let rating = document.createElement('div');
    rating.id = "rating";
    gameViewContent.appendChild(gameViewText);
    gameViewContent.appendChild(gameViewinfo);
    gameViewContent.appendChild(rating);

    gameView.appendChild(gameViewHeader);
    gameView.appendChild(gameViewContent);

    return gameView;
}

function generate_rating_System(game_id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "index.php?action=rating&" + game_id, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var content = xhr.responseText;
            let container = document.querySelector("#rating");
            container.innerHTML = content;
            generate_rating(game_id);
        }
    };

    xhr.send();
}


function generate_rating(game_id) {
    let rateBtns = document.querySelectorAll(".rate-btn");
    let divCont = document.querySelector("div .rate");

    // coloring yellow all the stars for the current rating
    let currentRating = document.querySelector("div.container > span").textContent;
    for (let i = 1; i <= currentRating; i++) {
        document.querySelector('.btn-' + i).classList.add('rate-btn-hover');
    }

    // Set all the Event listener for each buttons of the rating system
    for (let i = 0; i < rateBtns.length; i++) {
        let rateBtn = rateBtns[i];

        rateBtn.addEventListener("mouseover", function (e) {
            let target = e.currentTarget;
            let rating = target.id;
            for (let j = rating; j > 0; j--) {
                document.querySelector('.btn-' + j).classList.add('rate-btn-hover');
                target.classList.remove('rate-btn-hover');
            }
        });

        divCont.addEventListener("mouseout", function () {
            for (let i = 0; i < rateBtns.length; i++) {
                let rateBtn = rateBtns[i];
                rateBtn.classList.remove('rate-btn-hover');
            }
            for (let i = 1; i <= currentRating; i++) {
                document.querySelector('.btn-' + i).classList.add('rate-btn-hover');
            }
        });

        rateBtn.addEventListener("click", function (e) {
            let target = e.currentTarget;
            var rating = target.id;
            console.log("onclick : ", target);
            let dataRate = game_id + '&rate=' + rating;
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "index.php?action=updateRating&" + dataRate);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200 || xhr.status == 0) {
                    let cont = document.querySelector("#rating");
                    cont.innerHTML = xhr.responseText;
                    let currentRating = document.querySelector("div.container > span").textContent;
                    console.log(currentRating);
                    for (let i = 1; i <= currentRating; i++) {
                        document.querySelector('.btn-' + i).classList.add('rate-btn-hover');
                    }
                    generate_rating(game_id)
                }
            }
            xhr.send();
        });
    }


}


/**
 * Execution Section 
 */

{
    let divs = document.querySelectorAll("div[modal=game]");
    init_modals(divs);
}