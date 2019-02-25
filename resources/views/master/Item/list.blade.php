@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Master Item</h1>
@stop

@section('content')
	<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Item</h3>
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
                <table class="table table-bordered" width="100%" cellspacing="0" id="t_item">
                    <thead id="th_item">
                        <th>ID#</th>
                        <th>Pemilik</th>
                        <th>Nama Barang</th>
                        <th>Unit</th>
                        <th>Qty</th>
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
    var item_table;
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    $(document).ready(function() {
        item_table = $('#t_item').DataTable({
            "processing": false,
            "serverSide": false,
            "ajax": {
                "url": "{{ url('api/item/get') }}",
                "dataSrc": ""
            },
            "columns": [
                { data: 'id', name: 'id' },
                { data: 'owned_by', name: 'owned_by' },
                { data: 'name', name: 'name' },
                { data: 'unit_name', name: 'unit_name' },
                { data: 'qty', name: 'qty' },
                { data: 'id', name: 'id' }
            ],
            "columnDefs": [ 
                {
                    // The `data` parameter refers to the data for the cell
                    "render": function ( data, type, row ) {
                        var button_code;
                        button_code = '<a href="<?php echo url('master/item/detail?id=')?>' + data + '">Detail</a>';
                        return button_code;
                    },
                    "className": "text-center",
                    "targets": 5
                }
            ],
            "order": [0,"desc"] 
        });
    });
</script>
@stop