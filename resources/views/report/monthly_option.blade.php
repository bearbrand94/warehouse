@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <div id="form_1">
        <h2>Cetak Laporan</h2>
        <div class="box box-primary">
            <div class="box-header with-border">
              <strong>Data Bongkar</strong>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- general form elements -->
            <div class="box-body">
            {!! Form::open(['method' => 'GET', 'url' => "report/monthly/print" ]) !!}
                <!-- form start -->
                <div class="row">
                    <div class="form-group col-xs-12">
        		        <label for="client_name">Pilih Client</label>
    		        	<select class="form-control" id="select_client" name="client_id">   
                            @foreach ($client_data as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach   
                        </select>
        	        </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="client_name">Periode</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-8">
                        <select class="form-control" name="period_month">   
<!--                             <option value="1">January</option> 
                            <option value="2">February</option>  -->
                            <option value="3">March</option> 
                            <option value="4">April</option> 
<!--                             <option value="5">May</option> 
                            <option value="6">June</option> 
                            <option value="7">July</option> 
                            <option value="8">August</option> 
                            <option value="9">September</option> 
                            <option value="10">October</option> 
                            <option value="11">November</option> 
                            <option value="12">December</option>  -->
                        </select>
                    </div>
                    <div class="form-group col-xs-4">
                        <select class="form-control" name="period_year">
                            <option value="2019">2019</option>  
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm pull-right btn-flat">Lihat Nota</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>
@stop



@section('js')
<script type="text/javascript">
    function show_invoice(){
        $.ajax(
        {
            url: '',
            type: 'GET',
            dataType: "JSON",
            data: {
                "client_id": $("#select_client").val() // method and token not needed in data
            },
            success: function (response)
            {
            },
            error: function(xhr) {
             console.log(xhr.responseText); // this line will save you tons of hours while debugging
            // do something here because of error
           }
        });
    };

    $( document ).ready(function() {
        $('#select_client').select2({
            placeholder: 'Select an option',
            allowClear: true
        })

        $('.datepicker').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
@stop