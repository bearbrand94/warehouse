@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Form Muat</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Data Barang</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">

            <!-- form start -->
            <div class="form-group">
		        <label for="client_name">Client</label>
		        <div class="row">
			        <div class="col-xs-12">
			        	<select class="form-control" id="select_client"><option></option><option>Mat Solar</option><option>Mat Premium</option></select>
					</div>
				</div>
	        </div>
            <div class="form-group">
		        <label for="client_name">Barang</label>
		        <div class="row">
			        <div class="col-xs-12">
			        	<select class="form-control" id="select_item"><option></option><option>Solar</option><option>Premium</option></select>
					</div>
				</div>
	        </div>

	        <div class="form-group">
		        <label for="client_address">Sisa Barang: 0</label>
	        </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Data Muat</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">

            <!-- form start -->
            <div class="form-group">
		        <label for="client_name">No. Kendaraan</label>
		        <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Masukkan Nama Client">
				@if($errors->has('name'))
				    <p><span class="text-warning">{{$errors->first('name')}}</span></p>
				@endif
	        </div>
            <div class="form-group">
		        <label for="client_name">No. Surat Jalan</label>
		        <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Masukkan Nama Client">
				@if($errors->has('name'))
				    <p><span class="text-warning">{{$errors->first('name')}}</span></p>
				@endif
	        </div>
            <div class="form-group">
		        <label for="client_name">Nama Penerima</label>
		        <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Masukkan Nama Client">
				@if($errors->has('name'))
				    <p><span class="text-warning">{{$errors->first('name')}}</span></p>
				@endif
	        </div>

	        <div class="form-group">
		        <label for="client_address">Tanggal Muat</label>
		        <input type="text" class="form-control datepicker" placeholder="Isikan Tanggal Muat">
	        </div>
	        <div class="form-group">
		        <label for="client_address">Jumlah Muat</label>
		        <input type="text" class="form-control" id="client_address" name="client_address" placeholder="Masukkan Alamat Client">
				@if($errors->has('address'))
				    <p><span class="text-warning">{{$errors->first('address')}}</span></p>
				@endif
	        </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-success btn-sm pull-right btn-flat" onclick="create_client()">Submit</button>
          <a type="submit" class="btn btn-danger btn-sm pull-right btn-flat" style="margin-right: 5px;" href="{{ url('/master/client') }}">Kembali</a>
        </div>
    </div>
    <!-- /.box -->
@stop

@section('js')
<script type="text/javascript">
    function create_client(){
        $.ajax(
        {
            url: "{{ url('api/client/add') }}",
            type: 'post', // replaced from put
            dataType: "JSON",
            data: {
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
    $('#select_item').select2({
  		placeholder: 'Select an option',
        allowClear: true
	})
    $('#select_client').select2({
  		placeholder: 'Select an option',
        allowClear: true
	});
    $('.datepicker').datepicker({
        format: "dd MM yyyy",
        autoclose: true,
        todayHighlight: true
    });
</script>
@stop