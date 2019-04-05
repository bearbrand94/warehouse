@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Tambah Client</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <strong>Data Client</strong>
          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <!-- general form elements -->
        <div class="box-body">
            <input type="hidden" id="client_id" name="client_id" value="{{$client->id}}">
            <!-- form start -->
            <div class="form-group">
		        <label for="client_name">Nama</label>
		        <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Masukkan Nama Client" value="{{$client->name}}">
				@if($errors->has('name'))
				    <p><span class="text-warning">{{$errors->first('name')}}</span></p>
				@endif
	        </div>
	        <div class="form-group">
		        <label for="client_address">Alamat</label>
		        <input type="text" class="form-control" id="client_address" name="client_address" placeholder="Masukkan Alamat Client" value="{{$client->address}}">
				@if($errors->has('address'))
				    <p><span class="text-warning">{{$errors->first('address')}}</span></p>
				@endif
	        </div>
	        <div class="form-group">
	          	<label for="client_address">No.Telp</label>
	        	<div class="row">
	        		<div class="col-xs-6">
	        			<input type="text" class="form-control" id="client_phone1" name="client_phone1" placeholder="Telepon 1" value="{{$client->phone1}}">
						@if($errors->has('phone1'))
						    <p><span class="text-warning">{{$errors->first('phone1')}}</span></p>
						@endif
	        		</div>
		            <div class="col-xs-6">
	        			<input type="text" class="form-control" id="client_phone2" name="client_phone2" placeholder="Telepon 2" value="{{$client->phone2}}">
						@if($errors->has('phone2'))
						    <p><span class="text-warning">{{$errors->first('phone2')}}</span></p>
						@endif
	        		</div>
		         </div>
	        </div>
	        <div class="form-group">
		        <label for="client_address">E-Mail</label>
		        <input type="email" class="form-control" id="client_email" name="client_email" placeholder="Masukkan Alamat E-Mail Client" value="{{$client->email}}">
				@if($errors->has('email'))
				    <p><span class="text-warning">{{$errors->first('email')}}</span></p>
				@endif
	        </div>   
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-success btn-sm pull-right btn-flat" onclick="edit_client()">Submit</button>
          <a type="submit" class="btn btn-danger btn-sm pull-right btn-flat" style="margin-right: 5px;" href="{{ url('/master/client') }}">Kembali</a>
        </div>
    </div>
    <!-- /.box -->
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