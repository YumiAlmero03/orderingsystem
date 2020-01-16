$(document).ready( function () {
    var table = $('#costumer-table').DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url : 'https://8001-e95be19b-2f27-4bd8-8195-659118abe105.ws-ap01.gitpod.io/api/costumers',
                dataSrc: ''
            },
            columns:[
                {data : 'status'},
            ]
        }
    );
} );
