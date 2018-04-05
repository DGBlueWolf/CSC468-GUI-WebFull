var load_button = document.getElementById('potato-load');
var save_button = document.getElementById('potato-save');
var default_button = document.getElementById('potato-default');
var frosh_button = document.getElementById('potato-frosh');
var reset_button = document.getElementById('potato-reset');
var element_button = document.getElementById('potato-element');
var add_button = document.getElementById('potato-element-add');
var remove_button = document.getElementById('potato-element-remove');
var textlink;

load_button.onclick = function(){
    var modal = document.getElementById('upload-wrapper');
    modal.style.display = "block";
    document.getElementById('upload-cancel').onclick = function(){
        modal.style.display = "none";
    }
}

save_button.onclick = function(){ 
    var modal = document.getElementById('download-wrapper');
    modal.style.display = "block";
    save(); 
    document.getElementById('download-cancel').onclick = function(){
        if( textlink != null ){
            window.URL.revokeObjectURL(textlink);
            textlink = null;
        }
        modal.style.display = "none";
    }
};

default_button.onclick = function(){
    preset_request('default');
}

frosh_button.onclick = function(){
    preset_request('frosh');
}

reset_button.onclick = function(){
    reset_request();
}

element_button.onclick = function(){
    var modal = document.getElementById('selection-wrapper');
    var selectpane = document.getElementById('selection-window');
    selectpane.innerHTML = "<p><b>Select one of the following elements.</b></p>\n";
    selectpane.innerHTML += "<a id='selection-cancel' class='w3-button cancel'>&times;</a>\n";
    modal.style.display = "block";
    document.getElementById('selection-cancel').onclick = function(){
        modal.style.display = "none";
    }
    get_selections();
}

add_button.onclick = function(){
    var modal = document.getElementById('selection-wrapper');
    var selectpane = document.getElementById('selection-window');
    selectpane.innerHTML = "<p><b>Select one of the following elements.</b></p>\n";
    selectpane.innerHTML += "<a id='selection-cancel' class='w3-button cancel'>&times;</a>\n";
    modal.style.display = "block";
    document.getElementById('selection-cancel').onclick = function(){
        modal.style.display = "none";
    }
    get_options();
}

remove_button.onclick = function(){
    remove_request();
}