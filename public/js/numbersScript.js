document.getElementById('game-over-panel').style.display ='none';

document.getElementById('ready-button').addEventListener('click', function() {
    document.getElementById('content').style.display = 'none';
    document.getElementById('game-panel').style.display = 'block';

    game();
});

function game() {

    fetch('/draw_number', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {

            const randomNumber = data.randomNumber;
            const displayTime = data.time * 1000;

            const numberDisplay = document.getElementById('number-shown');
            numberDisplay.textContent = randomNumber;



            setTimeout(function() {

                numberDisplay.textContent = '';


                nextStep();
            }, displayTime);
        })
        .catch(error => {
            console.error('Error fetching the number:', error);
        });
}

function nextStep() {
   document.getElementById('typing-panel').style.visibility = 'visible';

}
document.getElementById('answer-button').addEventListener('click', function() {
    const userInput = document.getElementById('typing-area').value;

    fetch('/compare_numbers', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ input: userInput }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.correct) {

                document.getElementById('typing-panel').style.visibility = 'hidden';
                game();
            } else {
                gameOver()
                document.getElementById('typing-panel').style.visibility = 'hidden';
                document.getElementById('game-over-panel').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function gameOver(){

    document.getElementById('typing-panel').style.visibility = 'hidden';
    document.getElementById('game-over-panel').style.display = 'block';

    fetch('/get_score_numbers')
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
document.getElementById('replay-button').addEventListener('click', function() {
    location.reload();
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

document.getElementById('save-score-button').addEventListener('click', function() {

    fetch('/save_score_numbers', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({})
    })
        .then(response => response.json())
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                console.log('Score saved successfully!', data);
                alert('Score saved successfully!');
            } else {
                console.log('Error:', data.error);
                alert('Error saving score: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving score');
        });

});