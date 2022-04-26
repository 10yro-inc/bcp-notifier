document.addEventListener('DOMContentLoaded', function () {
    const msg = document.querySelector("#message");
    if (msg) {
        alertShow("処理結果", msg.innerHTML);
    }
});

document.querySelector("#bcp_form").addEventListener('submit',
function(e){
   // e.preventDefault();
    showSpinner();
    return true;
});
