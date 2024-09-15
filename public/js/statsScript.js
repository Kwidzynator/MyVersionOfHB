document.getElementById('words_label').style.display = "none";

document.getElementById('numbers_label').style.display = "none";

document.getElementById('reflex_label').style.display = "none";

document.getElementById('words_stats').addEventListener('click', function(){

    document.getElementById('numbers_label').style.display = "none";

    document.getElementById('reflex_label').style.display = "none";

    document.getElementById('words_label').style.display = "flex";

});

document.getElementById('numbers_stats').addEventListener('click', function(){

    document.getElementById('words_label').style.display = "none";

    document.getElementById('reflex_label').style.display = "none";

    document.getElementById('numbers_label').style.display = "flex";

});

document.getElementById('reflex_stats').addEventListener('click', function(){

    document.getElementById('numbers_label').style.display = "none";

    document.getElementById('words_label').style.display = "none";

    document.getElementById('reflex_label').style.display = "flex";

});