@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Edit Muat</h1>
@stop

@section('content')
    <div class="row">
        <!-- Header Data -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body box-profile">
                  <h3 class="profile-username text-center">{{$muat_data->owned_by}}</h3>

                  <ul class="list-group list-group-unbordered">
                    <div class="form-group">
                      <label for="client_name">No Invoice: {{$muat_data->showid}}</label>
                    </div>

                    <div class="form-group">
                        <label for="client_name">Tanggal Muat</label>
                        <input type="text" class="form-control datepicker" placeholder="Isikan Tanggal Muat" id="delivered_at" name="delivered_at" value="{{ \Carbon\Carbon::parse($muat_data->delivered_at)->format('d F Y') }}">
                        @if($errors->has('droporder_id'))
                            <p><span class="text-warning">{{$errors->first('delivered_at')}}</span></p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="client_name">No. DO</label>
                        <input type="text" class="form-control" id="droporder_id" name="droporder_id" placeholder="Masukkan No. DO" value="{{$muat_data->droporder_id}}">
                        @if($errors->has('droporder_id'))
                            <p><span class="text-warning">{{$errors->first('droporder_id')}}</span></p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="client_name">No. Truck</label>
                        <input type="text" class="form-control" id="truck_number" name="truck_number" placeholder="Masukkan No. Truck" value="{{$muat_data->truck_number}}">
                        @if($errors->has('truck_number'))
                            <p><span class="text-warning">{{$errors->first('truck_number')}}</span></p>
                        @endif
                    </div>
 
                  </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <!-- Footer Data -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Muat</h3>
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
                        <table class="table table-bordered" width="100%" cellspacing="0" id="t_item" style="margin-bottom: 50px;">
                            <thead id="th_item">
                              <th>#ID</th>
                              <th>Nama Barang</th>
                              <th>Jumlah Muat</th>
                              <th>Action</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <button class="pull-right">Simpan</button>
    <button class="pull-right">Batal</button>
    <button class="pull-left">Hapus Data</button>
@stop

@section('js')

<script type="text/javascript">
    console.log({!! $muat_data->detail !!});
    arrFooter=JSON.parse('{!! $muat_data->detail !!}');

    function edit_client(){
        $.ajax(
        {
            url: "{{ url('api/muat/edit') }}",
            type: 'post', // replaced from put
            dataType: "JSON",
            data: {
                id: $("#client_id").val(),
                name: $("#client_name").val(),
                address: $("#client_address").val(),
                phone1: $("#client_phone1").val(),
                phone2: $("#client_phone2").val(),
                email: $("#client_email").val()
            },
            success: function (response)
            {
                alert(response); // see the reponse sent
                console.log(response); 
                window.location.replace("{{ url('/master/client') }}");
            },
            error: function(xhr) {
                alert(xhr.responseText); // this line will save you tons of hours while debugging
                console.log(xhr.responseText); 
            // do something here because of error
           }
        });
    }

    function populate_item_table(){
        var table = document.getElementById("t_item");

        // helper function        
        function addCell(tr, text) {
            var td = tr.insertCell();
            td.textContent = text;
            return td;
        }
        // insert data

        for (var i = 0; i < arrFooter.length; i++) {
            var row = table.insertRow();
            addCell(row, arrFooter[i].item_id);
            addCell(row, arrFooter[i].item_name);
            addCell(row, arrFooter[i].qty);
            

            var button_group = "<div class='input-group-btn'>";
            button_group     += "<button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown'>Action<span class='fa fa-caret-down'></span></button>";
            button_group     += "<ul class='dropdown-menu' role='menu'>";
            button_group     += "<li><a class='btn btn-sm' style='text-align:left;' onclick=edit_item(" + i + ")>Ubah</a></li>";
            button_group     += "<li><a class='btn btn-sm delete' style='text-align:left;' onclick=delete_item(" + i + ")>Hapus</a></li>";
            button_group     += "</ul></div>";
            row.insertCell().innerHTML = button_group;
        };
    }

    $( document ).ready(function() {
        $('.datepicker').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
        });
        populate_item_table();
    });
</script>
@stop