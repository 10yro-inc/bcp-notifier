document.addEventListener('DOMContentLoaded', function () {
    const err_msg = document.querySelector("#err_message");
    if (err_msg) {
        alertShow("処理結果", err_msg.innerHTML);
    }
});


var openAddDialog = function () {

    var dailog = document.querySelector('#addDialog');

    if (dailog) {

        dailog.style.visibility = "visible";

    }
}


var openModDialog = function () {

    var dailog = document.querySelector('#modDialog');
    var selectedRow = document.querySelector('.row-selected');
    console.log(selectedRow.querySelector('#group_name').innerHTML);
    if (dailog) {

        dailog.querySelector('#group_name').value = selectedRow.querySelector('#group_name').innerHTML;
        dailog.querySelector('#company_name').value = selectedRow.querySelector('#company_name').innerHTML;
        dailog.querySelector('#api_url').value = selectedRow.querySelector('#api_url').innerHTML;
        dailog.querySelector('#push_notification').value = selectedRow.querySelector('#push_notification').innerHTML;
        dailog.querySelector('#company_cd').value = selectedRow.querySelector('#company_cd').innerHTML;
        dailog.querySelector('#company_settings_id').value = selectedRow.dataset.company_settings_id;
        dailog.querySelector('#company_group_id').value = selectedRow.dataset.company_group_id;
        dailog.querySelector('#company_id').value = selectedRow.dataset.company_id;

        dailog.style.visibility = "visible";

    }
}


var cancelClick = function () {

    document.querySelector('#addDialog').style.visibility = "hidden";;
    document.querySelector('#modDialog').style.visibility = "hidden";;
}

var addRegistClick = function () {

    var dailog = document.querySelector('#addDialog');

    if (dailog) {

        var params = {
            company_name: dailog.querySelector('#company_name').value,
            company_cd: dailog.querySelector('#company_cd').value,
            company_group_id: dailog.querySelector('#company_group_id').value,
            api_url: dailog.querySelector('#api_url').value,
            push_notification: dailog.querySelector('#push_notification').value,
        }


        post("/company/add", params);

    }
}

var modRegistClick = function () {

    var dailog = document.querySelector('#modDialog');

    if (dailog) {

        var params = {
            company_name: dailog.querySelector('#company_name').value,
            company_id: dailog.querySelector('#company_id').value,
            company_cd: dailog.querySelector('#company_cd').value,
            company_group_id: dailog.querySelector('#company_group_id').value,
            api_url: dailog.querySelector('#api_url').value,
            push_notification: dailog.querySelector('#push_notification').value,
            company_settings_id: dailog.querySelector('#company_settings_id').value,
        }


        post("/company/update", params);

    }
}

var deleteClick = function () {
    var selectedRow = document.querySelector('.row-selected');
    var params = {
        company_id: selectedRow.dataset.company_id,
        company_settings_id: selectedRow.dataset.company_settings_id,
    }

    post("/company/delete", params);


}