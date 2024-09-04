document.getElementById('ready-button').addEventListener('click', function() {
    document.getElementById('content').style.display = 'none';
    document.getElementById('game-panel').style.display = 'block';
    loadNextWord();
    fetch('/set_health')
        .then(response => response.json())
        .then(data => {
            updateHealthDisplay(data.health);
        });
});

//bellow is entire game interface like every button

//seen button
document.getElementById('seen-button').addEventListener('click', function() {
    fetch('/seen')
        .then(response => response.json())
        .then(data => {
            if (data.correct) {
                loadNextWord();
            } else {
                fetch('/set_health')
                    .then(response => response.json())
                    .then(data => {

                        updateHealthDisplay(data.health);
                        if (data.status === 'game_over') {
                            showGameOver()

                        } else {
                            alert("Wrong! You lost one life.");
                        }
                    });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred, please try again.");
        });
});

//new button
document.getElementById('new-button').addEventListener('click', function() {
    fetch('/new')
        .then(response => response.json())
        .then(data => {
            if (!data.correct) {
                loadNextWord();
            } else {
                fetch('/set_health')
                    .then(response => response.json())
                    .then(data => {

                        updateHealthDisplay(data.health);
                        if (data.status === 'game_over') {
                            showGameOver()
                        } else {
                            alert("Wrong! You lost one life.");
                        }
                    });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred, please try again.");
        });
});

//implementation of comming back to menu
document.getElementById('menu').addEventListener('click', function ()
{
    fetch('/back_to_the_pit', {
        method: 'GET',
    }).then(response => {
        window.location.href = response.url;
    }).catch(error => {
        console.error('Error', error)
    });
});

document.getElementById('game-over-menu').addEventListener('click', function ()
{
    fetch('/back_to_the_pit', {
        method: 'GET',
    }).then(response => {
        window.location.href = response.url;
    }).catch(error => {
        console.error('Error', error)
    });

});

document.getElementById('try-again').addEventListener('click', function() {
    location.reload();
});

document.getElementById('save-result').addEventListener('click', function(){



})

//in case of being wrong we update health on screen here
function updateHealthDisplay(health) {
    document.getElementById('health-left').innerText = health;
}

//obv
function loadNextWord() {
    fetch('/nextWord')
        .then(response => response.json())
        .then(data => {
            document.getElementById('word-display').innerText = data.word;
        });
}

function showGameOver(){
    document.getElementById('game-panel').style.display = 'none';
    document.getElementById('game-over-panel').style.display = 'block';
    fetch('/get_score')
        .then(response => response.json())
        .then(data => {
            showScore(data.score);
        }).catch(error => {
        console.error('Error fetching score:', error);
        });
}

function showScore(score) {
    document.getElementById('score').innerText = score;
}