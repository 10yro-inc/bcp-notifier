var table = document.querySelectorAll('#listData tbody tr');

if (table) {
    table[0].classList.add("row-selected");
    table.forEach(function (tr) {

        tr.addEventListener('click', function () {
            table.forEach(function (tr) {
                tr.classList.remove("row-selected");
            });

            tr.classList.add("row-selected");

        });
    });
}