
var alertShow = function(titile,message){
    const dialog= document.querySelector("#alertDialog")

    if(dialog){
        dialog.style.visibility ="visible";
        document.querySelector("#alert_title").innerHTML = titile;
        document.querySelector("#alert_message").innerHTML = message;
    }
}
var  closeAlertDialog  = function(titile,message){
    const dialog= document.querySelector("#alertDialog")

    if(dialog){
        dialog.style.visibility ="hidden";
    }
}