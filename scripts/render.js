function render(updates){
    for( var key in updates ){
        document.getElementById(key).src = updates[key];
    }
}