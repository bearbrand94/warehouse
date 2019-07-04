@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Master Bongkar - Muat</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Bongkar - Muat</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" id="t_bongkarmuat">
                    <thead id="th_item">
                        <!-- <th>Tanggal Input</th> -->
                        <th>ID#</th>
                        <th>Tanggal Terima</th>
                        <th>Client</th>
                        <th>Pekerjaan</th>
                        <th>Jumlah</th>
                        <th>No. DO</th>
                        <th>No. Truck</th>
                        <th class="text-center">Action</th>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('js')
<script type="text/javascript">
    var client_table;
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    function delete_client(id){
        $.ajax(
        {
            url: "{{ url('api/client/delete') }}",
            type: 'delete', // replaced from put
            dataType: "JSON",
            data: {
                "id": id // method and token not needed in data
            },
            success: function (response)
            {
                alert(response); // see the reponse sent
                client_table.ajax.reload();
            },
            error: function(xhr) {
             console.log(xhr.responseText); // this line will save you tons of hours while debugging
            // do something here because of error
           }
        });
    }

    $(document).ready(function() {
        client_table = $('#t_bongkarmuat').DataTable({
            "processing": false,
            "serverSide": false,
            "ajax": {
                "url": "{{ url('api/bongkarmuat/get') }}",
                "dataSrc": ""
            },
            "columns": [
                // { data: 'updated_at', name: 'updated_at' },
                { data: 'showid', name: 'showid' },
                { data: 'delivered_at', name: 'delivered_at' },
                { data: 'name', name: 'name' },
                { data: 'table_name', name: 'table_name' },
                { data: 'qty', name: 'qty' },
                { data: 'droporder_id', name: 'droporder_id' },
                { data: 'truck_number', name: 'truck_number' },
                
                { data: 'id', name: 'id' }
            ],
            "columnDefs": [ 
                {
                    // The `data` parameter refers to the data for the cell
                    "render": function ( data, type, row ) {
                        console.log(row.table_name);
                        var button_code;
                        button_code = '<div class="btn-group" role="group">';
                        button_code += '<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi <span class="caret"></span></button>';
                        button_code += '<ul class="dropdown-menu dropdown-menu-right">';
                        // button_code += '    <li><a href="<?php echo url('master/client/detail?id=')?>' + data + '">Detail</a></li>';

                        if(row.table_name=="muat"){
                            button_code += '    <li><a href="<?php echo url('master/muat/edit?id=')?>' + data + '">Edit</a></li>';
                        }
                        else{
                            button_code += '    <li><a href="<?php echo url('master/bongkar/edit?id=')?>' + data + '">Edit</a></li>';
                        }  

                        // button_code += '    <li><a class="btn btn-block" style="text-align:left" onclick=delete_client(' + data + ')>Delete</a></li>';
                        button_code += '   </ul>';
                        button_code += '</div>';
                        return button_code;
                    },
                    "className": "text-center",
                    "targets": 7
                }
            ],
            "order": [1,"desc"] 
        });
    });
</script>
@stop