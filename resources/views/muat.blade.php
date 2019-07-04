@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <div id="form_1">
        <h2>Form Muat (Step 1)</h2>
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
                    <label for="client_name">Pemilik Barang</label>
                    <select class="form-control" id="select_client" required>   
                        <option></option>
                        @foreach ($client_data as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach   
                    </select>
                    <p><span class="text-danger" id="warning_select_client"></span></p>
                </div>
                <div class="form-group">
                    <label for="truck_number">No. Kendaraan</label>
                    <input type="text" class="form-control" id="truck_number" name="truck_number" placeholder="Masukkan Nomor Kendaraan" required>
                    <p><span class="text-danger" id="warning_truck_number"></span></p>
                </div>
                <div class="form-group">
                    <label for="do_number">No. Surat / DO</label>
                    <input type="text" class="form-control" id="do_number" name="do_number" placeholder="Diisi Bila Ada" required>
                    <p><span class="text-danger" id="warning_do_number"></span></p>
                </div>

                <div class="form-group">
                    <label for="muat_date">Tanggal Muat</label>
                    <input type="text" class="form-control datepicker" placeholder="Isikan Tanggal Muat" id="muat_date" required>
                    <p><span class="text-danger" id="warning_muat_date"></span></p>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-primary btn-sm pull-right btn-flat" onclick="form_2()">Selanjutnya</button>
            </div>
        </div>
        <!-- /.box -->
    </div>

    <div id="form_2" hidden>
        <h2>Form Muat (Step 2)</h2>
        <div class="box box-primary">
            <div class="box-header with-border">
              <strong>Form Barang</strong>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- general form elements -->
            <div class="box-body">

                <!-- form start -->
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="item_name">Barang</label>
                        <select class="form-control" id="select_item">   
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="item_name">Jumlah Sisa</label><BR>
                        <p id="item_sisa"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="client_name">Note</label>
                        <input type="text" class="form-control" id="item_note" name="item_note" placeholder="Isikan Catatan Bila Ada.">
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="client_name">Jumlah Keluar</label>
                        <input type="number" class="form-control" id="item_qty" name="item_qty" placeholder="Isikan Jumlah muat.">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-primary btn-sm pull-right btn-flat" onclick="add_rincian()">Tambahkan Rincian</button>
            </div>
        </div>
        <!-- /.box -->

        <div class="box box-primary">
            <div class="box-header with-border">
              <strong>Rincian Barang</strong>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- general form elements -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="t_items">
                        <thead id="th_item">
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody id="tb_item"></tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-success btn-sm pull-right btn-flat" onclick="create_muat()">Submit</button>
                <button class="btn btn-danger btn-sm pull-right btn-flat"  style="margin-right: 5px;" onclick="form_1()">Kembali</a>
            </div>
        </div>
        <!-- /.box -->
    </div>
@stop



@section('js')
<script type="text/javascript">
    var item_list = new Array();
    
    function delete_item(index){
        item_list.splice(index,1);
        fill_item_table();
    }

    function fill_item_table(){
        var content="";
        for(i=0; i<item_list.length; i++){
            content += '<tr><td class="text-left">' + item_list[i].name + '</td>';
            content += '<td class="text-left">' + item_list[i].qty + '</td>';
            content += "<td class='text-center'><button type='button' class='btn btn-danger btn-flat btn-sm' onclick='delete_item(" + i + ")'>Hapus</button></td>";
            content += '</tr>';
        }       
        $("#tb_item").html(content);
    }

    function create_muat(){
        $.ajax(
        {
            url: "{{ url('api/item/muat') }}",
            type: 'post', // replaced from put
            dataType: "JSON",
            data: {
                client_id: $("#select_client").val(),
                droporder_id: $("#do_number").val(),
                truck_number: $("#truck_number").val(),
                delivered_at: $("#muat_date").val(),
                muat_footer: JSON.stringify(item_list)
            },
            success: function (response)
            {
                // alert('Muat Berhasil.');
                window.location.replace("{{ url('/master/muat') }}");
            },
            error: function(xhr) {
                alert(xhr.responseText); // this line will save you tons of hours while debugging
                console.log(xhr.responseText); 
            // do something here because of error
           }
        });
    }

    function add_rincian(){
        var item = new Object();
        item.id = $('#select_item option:selected').val();
        item.name = $('#select_item option:selected').text();
        item.qty = $('#item_qty').val();
        item.note = $("#item_note").val();
        item_list.push(item);

        fill_item_table();
    }

    function ajax_select_item(){
        $.ajax(
        {
            url: '{{url("api/client/item/get")}}',
            type: 'GET',
            dataType: "JSON",
            data: {
                "client_id": $("#select_client").val() // method and token not needed in data
            },
            success: function (response)
            {
                $('#select_item').html('');
                for (var i = response.length - 1; i >= 0; i--) {
                    if(response[i].qty>0){
                        var newOption = new Option(response[i].name, response[i].id, false, false);
                        $(newOption).attr('data-qty', response[i].qty);
                        $('#select_item').append(newOption).trigger('change');
                    }
                }
            },
            error: function(xhr) {
             console.log(xhr.responseText); // this line will save you tons of hours while debugging
            // do something here because of error
           }
        });
    }

    function form1_validator() {
      var validationFlag = true;
      var inpObj = document.getElementById("select_client");
      if (!inpObj.checkValidity()) {
        document.getElementById("warning_select_client").innerHTML = inpObj.validationMessage;
        validationFlag = false;
      }
      else{
        document.getElementById("warning_select_client").innerHTML = "";
      }

      var inpObj = document.getElementById("truck_number");
      if (!inpObj.checkValidity()) {
        document.getElementById("warning_truck_number").innerHTML = inpObj.validationMessage;
        validationFlag = false;
      }
      else{
        document.getElementById("warning_truck_number").innerHTML = "";
      }

      var inpObj = document.getElementById("do_number");
      if (!inpObj.checkValidity()) {
        document.getElementById("warning_do_number").innerHTML = inpObj.validationMessage;
        validationFlag = false;
      }
      else{
        document.getElementById("warning_do_number").innerHTML = "";
      }

      var inpObj = document.getElementById("muat_date");
      if (!inpObj.checkValidity()) {
        document.getElementById("warning_muat_date").innerHTML = inpObj.validationMessage;
        validationFlag = false;
      }
      else{
        document.getElementById("warning_muat_date").innerHTML = "";
      }

      return validationFlag;
    }

    function form_1(){
        $('#form_1').show();
        $('#form_2').hide();
    }

    function form_2(){
        if(form1_validator()){
            $('#form_2').show();
            $('#form_1').hide();
            ajax_select_item();
            
            item_list = [];
            fill_item_table();

            $('#select_item').select2({
                placeholder: 'Tidak terdapat barang yang tersisa.',
            });
            $( "#select_item" ).change(function() {
                var sisa = $('#select_item').find(':selected').data('qty');
                $('#item_sisa').html(sisa);
            });
            
            $('#item_client_name').html($('#select_client option:selected').text());
        }
    }

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

    // $(".datepicker").datepicker( "setDate" , now() );
</script>
@stop