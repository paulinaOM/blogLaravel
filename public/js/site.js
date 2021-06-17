$(document).ready(function() {
    var idPost;

    $('#example').DataTable();

    var table = $('#tblPost').DataTable( {
        "ajax": "datatable_data",
        "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "content" },
            { "data": "image" },
            { "data": "create_date" },
            { "data": "update_date" },
            { "data": "user_id" },
        ],
        columnDefs: [ {
            targets: 2,
            render: function ( data, type, row ) {
                return data.substr( 0, 50 );
            }
        } ]
    } );

    $('#tblPost tbody').on('click', 'tr', function () { //Detecta clic sobre renglon row
        var data = table.row( this ).data();  //Recupera datos del renglon
        //alert( 'You clicked on '+data.id+'\'s row' );
        listTableComments(data.id)
    } );

    function listTableComments(idPost){
        $('#tblComments').DataTable( {
            "ajax": "/datatable_comments/"+ idPost,
            "columns": [
                { "data": "id" },
                { "data": "comment" },
                { "data": "create_date" },
                { "data": "update_date" },
            ],
            columnDefs: [ {
                targets: 2,
                render: function ( data, type, row ) {
                    return data.substr( 0, 50 );
                }
            } ]
        } );
    }

} );


