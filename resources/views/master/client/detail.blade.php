@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Client Profile</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                  <h3 class="profile-username text-center">{{$client->name}}</h3>

                  <p class="text-muted text-center">{{$client->email}}</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Alamat</b> <a class="pull-right">{{$client->address}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Phone 1</b> <a class="pull-right">{{$client->phone1}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Phone 2</b> <a class="pull-right"><?php echo $client->phone2 ? $client->phone2 : "Tidak Ada"; ?></a>
                    </li>
                  </ul>
                  <a href="{{url('master/client/detail?id=').($client->id+1)}}" class="btn btn-default pull-right"><b>Next</b></a>
                  <a href="{{url('master/client/detail?id=').($client->id-1)}}" class="btn btn-default pull-left"><b>Prev</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#item" data-toggle="tab">Barang</a></li>
              <li><a href="#transaction" data-toggle="tab">Transaksi</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="item">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="t_item">
                        <thead id="th_item">
                            <th>ID#</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th class="text-center">Action</th>
                        </thead>
                    </table>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="transaction">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="t_transaction">
                        <thead id="th_transaction">
                            <th>Tanggal</th>
                            <th>Desc</th>
                            <th>Qty</th>
                            <th>Hrg. Satuan</th>
                            <th>Subtotal</th>
                        </thead>
                    </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
    </div>
@stop

@section('js')

<script type="text/javascript">
    var item_table;
    var transaction_table;

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
                "url": "{{ url('api/client/item/get?client_id=').$client->id }}",
                "dataSrc": ""
            },
            "columns": [
                { data: 'id', name: 'id' },
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
                    "targets": 4
                }
            ],
            "order": [0,"desc"] 
        });

        transaction_table = $('#t_transaction').DataTable({
            "processing": false,
            "serverSide": false,
            "ajax": {
                "url": "{{ url('api/client/transactions/get?client_id=').$client->id }}",
                "dataSrc": ""
            },
            "columns": [
                { data: 'updated_at', name: 'updated_at' },
                { data: 'desc', name: 'desc' },
                { data: 'qty', name: 'qty', className: "text-center" },
                { data: null},
                { data: 'nominal', name: 'nominal', className: "text-right", "render": function ( data, type, row ) {
                    return numberWithCommas(data);}
                }
            ],
            "columnDefs": [ 
                {
                    // The `data` parameter refers to the data for the cell
                    "render": function ( data, type, row ) {
                        return numberWithCommas(data.nominal/data.qty);
                    },
                    "className": "text-right",
                    "targets": 3
                }
            ],
            "order": [0,"desc"] 
        });
    });
</script>
@stop