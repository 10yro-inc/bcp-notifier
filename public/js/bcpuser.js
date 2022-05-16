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
   
});


var testNotifyClick = function () {
    showSpinner()
    var params = {
        company_cd: document.querySelector("input[name='company_cd']").value,
        user_cd: document.querySelector("input[name='user_cd']").value,
        prame: document.querySelector("input[name='prame']").value,
    }


    post("/bcp/test/notify", params);

}
