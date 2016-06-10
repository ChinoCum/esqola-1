$(function () {

    NProgress.start();
    NProgress.done();

    $('.ui.button.submit').click(function () {$(this).addClass('loading')});

    $('.ui.table').DataTable({
        "language": {
            'lengthMenu': 'Mostrar _MENU_  de resultados por página',
            "zeroRecords": "No hay resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(Filtrados de _MAX_ datos en total)",
            "search": "Búscar: ",
            "paginate": {
                "previous": "<",
                "next": ">"
            }
        }
    });

    $('.ui.dropdown.normal').dropdown();

});
