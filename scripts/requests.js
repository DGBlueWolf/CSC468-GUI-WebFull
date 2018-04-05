function init_session(){
    var formData = new FormData();
    formData.append('action', 'init');
    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status !== 200){
            alert("Init request failed.");
        } else {
            if( request.response === "false" ){
                preset_request('default');
            } else {
                console.log(request.response);
                render(JSON.parse(request.response));
            }
        }
    }
    request.send(formData);    
}

function upload(){
    element_button.innerHTML = "potato";
    var fileField = document.getElementById('potato-load-file');
    var file = fileField.files[0];
    if( file === undefined ){
        return false;
    }
    var formData = new FormData();
    formData.append('action', 'load');
    formData.append(fileField.name, file, file.name);
    
    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true); 
    request.onload = function(){
        if(request.status === 200){
            console.log(request.response);
            render(JSON.parse(request.response));
        } else {
            alert('Upload request failed.');
        }
        document.getElementById('upload-cancel').click();
    }
    request.send(formData);
    return false;
}

function save(){
    var formData = new FormData();
    formData.append('action', 'save');

    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status === 200){
            var blob = new Blob([request.response], { type: "text/plain" });
            var link = document.getElementById('downloadlink');
            textlink = window.URL.createObjectURL(blob);
            link.href = textlink;
        } else {
            alert('Save request failed.');
        }
    }
    request.send(formData);
}

function preset_request(name){
    element_button.innerHTML = "potato";
    var formData = new FormData();
    formData.append('action', 'preset');
    formData.append('preset', name);

    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status === 200){
            console.log(request.response);
            render(JSON.parse(request.response));
        } else {
            alert("Preset request failed.");
        }
    }
    request.send(formData);
}

function reset_request(){
    element_button.innerHTML = "potato";
    var formData = new FormData();
    formData.append('action', 'reset');

    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status === 200){
            console.log(request.response);
            render(JSON.parse(request.response));
        } else {
            alert("Reset request failed.");
        }
    }
    request.send(formData);
}

function get_selections(){
    var formData = new FormData();
    formData.append('action', 'element');
    formData.append('action-type', 'select');

    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status === 200){
            console.log(request.response);
            selection_form(JSON.parse(request.response));
        } else {
            alert("Select request failed.");
        }
    }
    request.send(formData);
}

function selection_form(selections){
    selectpane = document.getElementById('selection-window');
    for( var idx in selections ){
        if( selections[idx] === "end" ){ break; }
        var pair = selections[idx];
        var name = pair[0];
        var img = document.createElement("img");
        img.src = pair[1];
        img.onclick = make_select_request(name);
        selectpane.appendChild(img);
    }
}

function make_select_request(name){
    return function(){ select_request(name); }
}

function select_request(name){
    document.getElementById("selection-cancel").click();
    element_button.innerHTML = name;
}

function get_options(){
    var formData = new FormData();
    var path = document.getElementById('potato-element').innerHTML;
    formData.append('action', 'element');
    formData.append('action-type', 'option');
    formData.append('element-path', path)

    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status === 200){
            console.log(request.response);
            option_form(JSON.parse(request.response));
        } else {
            alert("Options request failed.");
        }
    }
    request.send(formData);
}

function option_form(selections){
    selectpane = document.getElementById('selection-window');
    if( selections.length === 1 ){
        selectpane.innerHTML += "\n<p>No add options available for selected element.</p>\n";
    } else {
        for( var idx in selections ){
            if( selections[idx] === "end" ){ break; }
            var pair = selections[idx];
            var name = pair[0];
            var img = document.createElement("img");
            img.src = pair[1];
            img.onclick = make_add_request(name);
            selectpane.appendChild(img);
        }
    }
}

function make_add_request(name){
    return function(){ add_request(name); }
}

function add_request(name){
    var formData = new FormData();
    var path = document.getElementById('potato-element').innerHTML;
    formData.append('action', 'element');
    formData.append('action-type', 'add');
    formData.append('selection', path);
    formData.append('option', name);

    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status === 200){
            console.log(request.response);
            render(JSON.parse(request.response));
        } else {
            alert("Add request failed.");
        }
        document.getElementById("selection-cancel").click();
    }
    request.send(formData);
}

function remove_request(){
    var formData = new FormData();
    var path = document.getElementById('potato-element').innerHTML;
    formData.append('action', 'element');
    formData.append('action-type', 'remove');
    formData.append('selection', path);

    var request = new XMLHttpRequest();
    request.open('POST', 'php/main.php', true);
    request.onload = function(){
        if(request.status === 200){
            console.log(request.response);
            render(JSON.parse(request.response));
        } else {
            alert("Remove request failed.");
        }
    }
    request.send(formData);
}
