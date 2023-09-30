function get_text(event){
    var string = event.textContent;
    document.getElementsByClassName('search_box')[0].value = string;
    document.getElementById('search_result').innerHTML = '';
    
}

    function load_data(query){
        if(query.lenghth > 2){
            var form_data = new FormData();
            form_data.append('query', query);
            var ajax_request = new XMLHttpRequest();
            ajax_request.open('POST', 'process_data.php');
            ajax_request.send(form_data);
            ajax_request.onreadystatechange = function(){
                if(ajax_request.readyState == 4 && ajax_request.status ==200){
                    var response = JSON.parse(ajax_request.responseText);
                    var html = '<div class="list-group">';
                    if(response.lenghth > 0)
                    {
                        for(var count = 0; count < response.length; count++){
                            html += '<a href="#" class="list-group-item list-group-item-action" onclick="get_text(this)">'+response[count].progressNumber+'</a>';
                        }
                    }else{
                        html += '<a href="#" class="list-group-item list-group-item-action disabled">No result found</a>';
                    }

                    html += '</div>';
                    document.getElementById('search_result').innerHTML = html;
                }
            }
        }else{
            document.getElementById('search_result').innerHTML = '';
        }
    }