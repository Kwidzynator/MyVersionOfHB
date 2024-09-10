document.getElementById('ready-button').addEventListener('click', function() {
    document.getElementById('content').style.display = 'none';
    document.getElementById('game-panel').style.display = 'block';

    game();
});

function game() {
    fetch('/screenChangingTime')
        .then(response => response.json())
        .then(data => {
            const seconds = data.time_to_start;
            const milliseconds = data.miliseconds;
            const totalDelay = (seconds * 1000) + milliseconds;

            console.log(`Waiting for ${seconds} seconds and ${milliseconds} milliseconds`);

            document.getElementById('game-panel').style.backgroundColor = 'green';

            setTimeout(function() {
                document.getElementById('game-panel').style.backgroundColor = 'red';

                fetch('/startTimer');

                document.getElementById('game-panel').addEventListener('click', stopTimer);
            }, totalDelay);
        });
}

function stopTimer() {
    fetch('/stopTimer')
        .then(response => response.json())
        .then(data => {
            if (data.elapsed_time_ms) {
                const reactionTime = data.elapsed_time_ms;
                document.getElementById('reaction-time-text').innerText = `Your reaction time: ${reactionTime} ms`;

                // Show the game-over-panel and hide the game panel
                document.getElementById('game-over-panel').style.display = 'flex';
                document.getElementById('game-panel').style.display = 'none';

                console.log(`Reaction time: ${reactionTime} ms`);

                document.getElementById('game-panel').removeEventListener('click', stopTimer);
            } else {
                console.error('Error:', data.error);
            }
        })
        .catch(error => console.error('Error in fetching stopTimer:', error));
}

document.getElementById('save-score-button').addEventListener('click', function() {
    console.log('Save score button clicked');

});

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