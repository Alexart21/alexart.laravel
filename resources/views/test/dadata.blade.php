<h1>HERE</h1>
{{--<script>
    var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";
    var token = "570d95978c2db5381256783439e3ea14984c7e2b";
    var query = "москва хабар";

    var options = {
        method: "POST",
        mode: "cors",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "Authorization": "Token " + token
        },
        body: JSON.stringify({query: query})
    }

    fetch(url, options)
        .then(response => response.text())
        .then(result => console.log(result))
        .catch(error => console.log("error", error));
</script>--}}
<h3 id="res"></h3>
<input id="address" name="address" type="text" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>

<script>
    $("#address").suggestions({
        token: "570d95978c2db5381256783439e3ea14984c7e2b",
        type: "ADDRESS",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            console.log(suggestion);
            document.getElementById('res').innerHTML = suggestion['value'];
        }
    });
</script>
