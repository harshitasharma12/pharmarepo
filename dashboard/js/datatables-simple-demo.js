window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
       var dtable = new simpleDatatables.DataTable(datatablesSimple,{
       	perPageSelect: [10, 20, 30, 40, 50, 100]
       });


    }
});
