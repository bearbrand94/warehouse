@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Edit Muat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body box-profile">
                  <h3 class="profile-username text-center">{{$muat_data->showid}}</h3>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Pemilik</b> <a class="pull-right">{{$muat_data->owned_by}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Tanggal Muat</b> <a class="pull-right">{{ \Carbon\Carbon::parse($muat_data->delivered_at)->format('d M Y') }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>No. DO</b> <a class="pull-right">{{$muat_data->droporder_id}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>No. Truck</b> <a class="pull-right">{{$muat_data->truck_number}}</a>
                    </li>
                  </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

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
                    <table class="table table-bordered" width="100%" cellspacing="0" id="t_item">
                        <thead id="th_item">
                          <th>#ID</th>
                          <th>Nama Barang</th>
                          <th class="text-center">Jumlah Muat</th>
                          <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                          @foreach ($muat_data->detail as $detail)
                          <tr>
                            <td>{{ $detail->id }}</td>
                            <td class="text-center">
                              {{ $detail->item_name }}
                            </td>
                            <td class="text-center">
                                {{ $detail->qty }}
                            </td>
                            <!-- Sisa Column -->
                            <td class="text-center"></td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@stop

@section('js')

<script type="text/javascript">
    function edit_client(){
        $.ajax(
        {
            url: "{{ url('api/client/edit') }}",
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
</script>
@stop