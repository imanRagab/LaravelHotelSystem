
$(document).ready(function() {
console.log("mm");
    oTable = $('#users').DataTable({

        "processing": true,

        "serverSide": true,

        "ajax": "datatable/getposts",

        "columns": [

            {data: 'id', name: 'id'},

            {data: 'name', name: 'name'},

            {data: 'email', name: 'email'},

            

        ]

    });

});