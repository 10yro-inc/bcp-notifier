document.addEventListener('DOMContentLoaded', function () {
    const err_msg = document.querySelector("#err_message");
    if (err_msg) {
        alertShow("認証エラー", err_msg.innerHTML);
    }
});

document.querySelector("#login_form").addEventListener('submit',
function(e){
   // e.preventDefault();
    showSpinner();
  
});
