var exportClick = function () {
    var company_id = document.querySelector('#company_id');
   
    var params = {
        company_id: company_id.value
    }

    post("/bcp/export", params);
   


}