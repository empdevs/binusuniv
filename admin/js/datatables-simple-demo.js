window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementsById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
    // const datatablesDua = document.getElementById('datatablesDua');
    // if (datatablesDua) {
    //     new dualeDatatables.DataTable(datatablesDua);
    // }
   
});
