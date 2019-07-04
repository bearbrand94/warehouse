@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <div id="form_1">
        <h2>Form Bongkar (Step 1)</h2>
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
                    <label for="bongkar_date">Tanggal Bongkar</label>
                    <input type="text" class="form-control datepicker" placeholder="Isikan Tanggal Bongkar" id="bongkar_date" required>
                    <p><span class="text-danger" id="warning_bongkar_date"></span></p>
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
        <h2>Form Bongkar (Step 2)</h2>
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
                <div class="form-group">
                    <label for="item_name">Barang</label>
                    <select class="form-control" id="select_item" required>   
                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="client_name">Note</label>
                        <input type="text" class="form-control" id="item_note" name="item_note" placeholder="Isikan Catatan Bila Ada.">
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="client_name">Jumlah</label>
                        <input type="number" class="form-control" id="item_qty" name="item_qty" placeholder="Isikan Jumlah Bongkar." min="1" required>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-primary btn-sm pull-left btn-flat" onclick='$("#create_item_modal").modal();'>Barang Baru</button>
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
                            <th>Action</th>
                        </thead>
                        <tbody id="tb_item"></tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-success btn-sm pull-right btn-flat" onclick="create_bongkar()">Submit</button>
                <button class="btn btn-danger btn-sm pull-right btn-flat"  style="margin-right: 5px;" onclick="form_1()">Kembali</a>
            </div>
        </div>
        <!-- /.box -->
    </div>

<!-- Create Detail Modal -->
<div class="modal" tabindex="-1" id="create_item_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add New Item</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="document_description">Pemilik Barang</label>
            <br>
            <p id="item_client_name"></p>
        </div>

        <div class="form-group">
            <label for="client_name">Kategori Barang</label>
            <select class="form-control" id="select_new_item_category" required>
            </select>
        </div>

        <div class="form-group">
            <label for="document_description">Nama Barang</label>
            <input type="email" class="form-control" id="new_item_name" placeholder="Masukkan Nama Barang" required>
        </div>
        <div class="form-group">
            <label for="document_description">Satuan</label>
            <input type="email" class="form-control" id="new_item_unit_name" placeholder="Contoh: Palet, Pak, Karung ,Dus" required>
        </div>
        <div class="form-group">
            <label for="client_name">Jumlah</label>
            <input type="number" class="form-control" id="new_item_qty" name="item_qty" placeholder="Isikan Jumlah Bongkar." min="1" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-flat btn-sm" data-dismiss="modal" onclick="create_new_item()">Add</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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

    function create_new_item(){
        $.ajax(
        {
            url: "{{ url('api/item/add') }}",
            type: 'post', // replaced from put
            dataType: "JSON",
            data: {
                category_id: $('#select_new_item_category').val(),
                client_id: $("#select_client").val(),
                name: $("#new_item_name").val(),
                unit_name: $("#new_item_unit_name").val()
            },
            success: function (response)
            {
                console.log(response);

                var item = new Object();
                item.id = response.id;
                item.name = response.name;
                item.qty = $('#new_item_qty').val();
                item.note = $("#item_note").val(),
                item_list.push(item);
                fill_item_table();
                ajax_select_item();
            },
            error: function(xhr) {
                alert(xhr.responseText); // this line will save you tons of hours while debugging
                console.log(xhr.responseText); 
            // do something here because of error
           }
        });
    }

    function create_bongkar(){
        $.ajax(
        {
            url: "{{ url('api/item/bongkar') }}",
            type: 'post', // replaced from put
            dataType: "JSON",
            data: {
                client_id: $("#select_client").val(),
                droporder_id: $("#do_number").val(),
                truck_number: $("#truck_number").val(),
                delivered_at: $("#bongkar_date").val(),
                bongkar_footer: JSON.stringify(item_list)
            },
            success: function (response)
            {
                // alert('Bongkar Berhasil.');
                window.location.replace("{{ url('/master/bongkar') }}");
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
        item.id = $('#select_item').val();
        item.name = $('#select_item option:selected').text();
        item.qty = $('#item_qty').val();
        item.note = $("#item_note").val(),
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
                    var newOption = new Option(response[i].name, response[i].id, false, false);
                    $('#select_item').append(newOption).trigger('change');
                }
            },
            error: function(xhr) {
             console.log(xhr.responseText); // this line will save you tons of hours while debugging
            // do something here because of error
           }
        });
    }

    function ajax_select_category(){
        $.ajax(
        {
            url: '{{url("api/client/item/category/get")}}',
            type: 'GET',
            dataType: "JSON",
            data: {
                "client_id": $("#select_client").val() // method and token not needed in data
            },
            success: function (response)
            {
                $('#select_new_item_category').html('');
                for (var i = response.length - 1; i >= 0; i--) {
                    var newOption = new Option(response[i].name, response[i].id, false, false);
                    $('#select_new_item_category').append(newOption).trigger('change');
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

      var inpObj = document.getElementById("bongkar_date");
      if (!inpObj.checkValidity()) {
        document.getElementById("warning_bongkar_date").innerHTML = inpObj.validationMessage;
        validationFlag = false;
      }
      else{
        document.getElementById("warning_bongkar_date").innerHTML = "";
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
            ajax_select_category();
            item_list = [];
            fill_item_table();

            $('#select_item').select2({
                placeholder: 'Tidak terdapat item, tambahkan barang baru.',
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