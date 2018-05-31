function toggle_input_pass(elem){
    elementos = document.getElementsByClassName('input_pass');
    if(elem.checked == false){
        for (elem of elementos){
            elem.setAttribute("disabled", "disabled");
        }
    }
    else{
        for (elem of elementos) {
            elem.removeAttribute("disabled");
        }
    }
}