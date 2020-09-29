$(function () {
    initToolTip();
    initDataTable();
    initCounters();
    //initCharts();
});

//Tooltip
function initToolTip() {
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();
}

//dataTable
function initDataTable() {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
}

//Widgets count plugin
function initCounters() {
    $('.count-to').countTo();
}
