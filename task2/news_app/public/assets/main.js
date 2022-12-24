document.addEventListener("DOMContentLoaded", function(event) { 

    if(document.querySelector("#createnews")){
        document.querySelector("#createnews").onclick = function(){
            send_news_data(); 
        }
    }
});

function send_news_data(){
    let header = document.getElementById('form-header').value;
    let preview = document.getElementById('form-preview').value;
    let tags = document.getElementById('form-tags').value;
    let text = document.getElementById('form-text').value;

    if(header != '' && preview != '' && tags != '' && text != ''){

        var x = new XMLHttpRequest();
        let body = 'header=' + encodeURIComponent(header) +
                '&preview=' + encodeURIComponent(preview) +
                '&tags=' + encodeURIComponent(tags) +
                '&text=' + encodeURIComponent(text);
        x.open("POST", "api/create", true);
        x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        x.send(body);
        x.onload = function(){
        let info = this.response;
            if(info == 'good-create-news'){
                clear_inputs();
                document.getElementById('errors').innerHTML = '<div style="display: block;" class="u-form-send-message u-form-send-success"> Вы успешно добавили новость! </div>';
                setTimeout(() => {
                    document.getElementById('errors').innerHTML = "";
                }, 2000);
            }else{
                clear_inputs();
            } 
            
        };

    }else{
        document.getElementById('errors').innerHTML = '<div style="display: block;" class="u-form-send-error u-form-send-message"> Внимание! Вы заполнили не все поля! </div>';
        setTimeout(() => {
            document.getElementById('errors').innerHTML = "";
        }, 2500);
    }
}

/**
 * 
 * <div style="display: block;" class="u-form-send-message u-form-send-success">  </div>
 * <div style="display: block;" class="u-form-send-error u-form-send-message">  </div>
 */



function clear_inputs(){
    document.getElementById('form-header').value = "";
    document.getElementById('form-preview').value = "";
    document.getElementById('form-tags').value = "";
    document.getElementById('form-text').value = "";
}
