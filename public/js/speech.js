$("#read").click(function (e) {
    e.preventDefault();
    var language = document.getElementById('language_nav').text.trim();

    if (language =='Türkçe') {
        language = "Turkish Female";
    } else if (language =='English') {
        language = 'US English Female';
    } else if (language == 'Ελληνικά') {
        language = "Greek Female"
    }

    responsiveVoice.speak(document.getElementById("speech").textContent,language);

    $("#stop").click(function (e) {
        e.preventDefault();

        responsiveVoice.cancel();
    });
});