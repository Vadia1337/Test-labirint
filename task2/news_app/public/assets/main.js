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
            document.getElementById('errors').innerHTML = '<div style="display: block;" class="u-form-send-message u-form-send-success"> Вы успешно добавили новость! </div>';
            clear_inputs();
            setInterval(() => {
                document.getElementById('errors').innerHTML = "";
            }, 1500);
        }else{
            clear_inputs();
        } 
        
    };
}

/**
 * 
 * <div style="display: block;" class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
 * <div style="display: block;" class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
 */



function clear_inputs(){
    document.getElementById('form-header').value = "";
    document.getElementById('form-preview').value = "";
    document.getElementById('form-tags').value = "";
    document.getElementById('form-text').value = "";
}
