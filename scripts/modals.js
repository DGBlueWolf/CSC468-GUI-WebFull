//List of modal elements
modal_map= { 
    "upload-modal":    "upload-cancel",
    "selection-modal": "selection-cancel",
    "download-modal":  "download-cancel",
};

//Exit modal when clicking outside of it
window.onclick = function(event) {
  for( var id in modal_map ){
    if( event.target == document.getElementById(id) ){
      document.getElementById(modal_map[id]).click();
    }
  }
}