document.addEventListener("DOMContentLoaded", function(event) { 
    getdata();

    if(document.querySelector(".updatedata")){
        document.querySelector(".updatedata").onclick = function(){
            console.log('updatedata');

            document.getElementById('setcurrs').innerHTML = '';

            getdata();
        }
    }
});

function getdata(){
    var x = new XMLHttpRequest();
    x.open("GET", "http://localhost:3000/task1/main.php", true);
    x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    x.send();
    x.onload = function(){
           let result = JSON.parse(this.response);
           
           set_curr_data(result[0]);

           set_weather_data(result[1]);
    };
}

function set_curr_data(currency){
    currency.forEach(el =>
        document.getElementById('setcurrs').innerHTML += '<div class="u-container-style u-list-item u-repeater-item">'+
        '<div class="u-container-layout u-similar-container u-container-layout-1">'+
        '<div class="u-align-center u-container-style u-grey-5 u-group u-radius-47 u-shape-round u-group-1">'+
        '<div class="u-container-layout u-container-layout-2">'+
        '<h1 class="u-text u-text-1">1 '+el['Code']+' = '+el['Value']+' RUB</h1><p class="u-text u-text-2">'+el['Name']+'</p></div></div></div></div>'
     );
}

function set_weather_data(weather){
    document.querySelector("#weather-city").innerText = weather['City'];
    document.querySelector("#weather-date").innerText = weather['Date'];
    document.querySelector("#weather-temp").innerText = weather['Temp'];
    document.querySelector("#weather-f-temp").innerText = weather['Feels_like_temp'];
    document.querySelector("#weather-description").innerText = weather['Description'];
}
