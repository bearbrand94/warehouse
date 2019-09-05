@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Edit Bongkar</h1>
@stop

@section('content')
<!-- Edit Modal -->
<div class="modal" id="edit-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Item</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <input type="hidden" id="edit_index" value="">
            <label for="edit_select_item">Barang</label>
            <select class="form-control select_item" id="edit_select_item" required style="width: 100%">
                @foreach($item_data as $item)
                <option value="{{$item->id}}" data-qty="{{ $item->qty }}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="edit_item_sisa">Stock Gudang</label>
            <p class="item_sisa" id="edit_item_sisa"></p>
        </div>   
        <div class="form-group">
            <label for="edit_item_qty">Jumlah Bongkar</label>
            <input type="number" class="form-control" id="edit_item_qty" placeholder="Isikan Jumlah Bongkar." min="1" required>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="save_item()">Simpan</button>
      </div>

    </div>
  </div>
</div>

<div class="row">
    <!-- Header Data -->
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">{{$bongkar_data->owned_by}}</h3>

              <ul class="list-group list-group-unbordered">
                <div class="form-group">
                  <label for="client_name">No Invoice: {{$bongkar_data->showid}}</label>
                </div>

                <div class="form-group">
                    <label for="client_name">Tanggal Bongkar</label>
                    <input type="text" class="form-control datepicker" placeholder="Isikan Tanggal Muat" id="delivered_at" name="delivered_at" value="{{ \Carbon\Carbon::parse($bongkar_data->delivered_at)->format('d F Y') }}">
                    @if($errors->has('droporder_id'))
                        <p><span class="text-warning">{{$errors->first('delivered_at')}}</span></p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="client_name">No. DO</label>
                    <input type="text" class="form-control" id="droporder_id" name="droporder_id" placeholder="Masukkan No. DO" value="{{$bongkar_data->droporder_id}}">
                    @if($errors->has('droporder_id'))
                        <p><span class="text-warning">{{$errors->first('droporder_id')}}</span></p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="client_name">No. Truck</label>
                    <input type="text" class="form-control" id="truck_number" name="truck_number" placeholder="Masukkan No. Truck" value="{{$bongkar_data->truck_number}}">
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
                <h3 class="box-title">Daftar Bongkar</h3>
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
                          <th>#Item</th>
                          <th>Nama Barang</th>
                          <th>Jumlah Bongkar</th>
                          <th>Action</th>
                        </thead>
                        <tbody id="tb_item">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
            <div class="box-footer">
                <!-- /.box-header -->
                <button class="btn btn-primary btn-sm pull-right hidden" data-toggle="modal" data-target="#edit-modal">Tambah Bongkar</button>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
</div>

<div class="box">
    <button class="btn btn-primary pull-right" style="margin: 1em;" onclick="save()">Simpan</button>
    <button class="btn btn-default pull-right" style="margin-top: 1em;">Batal</button>
    <button class="btn btn-danger pull-left" style="margin: 1em; display: none">Hapus Semua Data</button>
</div>
@stop

@section('js')
<script type="text/javascript">
    console.log({!! json_encode($bongkar_data) !!});
    console.log({!! json_encode($item_data) !!});
    arrFooter=JSON.parse('{!! $bongkar_data->detail !!}');

    $( ".select_item" ).change(function() {
        var sisa = $('.select_item').find(':selected').data('qty');
        $('.item_sisa').html(sisa);
    });

    function save(){
        console.log(arrFooter);
        $.ajax(
        {
            url: "{{ url('api/bongkar/edit/bulk') }}",
            type: 'post', // replaced from put
            dataType: "JSON",
            data: {
                header_id: {{ $bongkar_data->id }},
                droporder_id: $("#droporder_id").val(),
                truck_number: $("#truck_number").val(),
                delivered_at: $("#delivered_at").val(),
                bongkar_footer: JSON.stringify(arrFooter)
            },
            success: function (response)
            {
                window.location.replace("{{ url('/master/item') }}");
            },
            error: function(xhr) {
                alert(xhr.responseText); // this line will save you tons of hours while debugging
                console.log(xhr.responseText); 
            // do something here because of error
           }
        });
    }

    function edit_item(index){
        $('#edit_index').val(index);
        $('#edit_select_item').val(arrFooter[index].item_id);
        $('#edit_item_qty').val(arrFooter[index].qty);
        $('.select_item').change();
        $('#edit-modal').modal('show');
    }

    function save_item(){
        if($('#edit_index').val() == ""){
            add_item()
        }
        else{
            var index = $('#edit_index').val();
            arrFooter[index].item_id = $('#edit_select_item').val();
            arrFooter[index].item_name = $('#edit_select_item option:selected').text();
            arrFooter[index].qty = $('#edit_item_qty').val();
            $('#edit_index').val("");
            populate_item_table();
        }

    }

    function add_item(){
        var item = new Object();
        item.item_id = $('#edit_select_item').val();
        item.item_name = $('#edit_select_item option:selected').text();
        item.qty = $('#edit_item_qty').val();
        arrFooter.push(item);
        populate_item_table();
    }

    function delete_item(index){
        arrFooter.splice(index,1);
        populate_item_table();
    }

    function populate_item_table(){
        $('#tb_item').empty();
        // insert data
        var content="";
        for (var i = 0; i < arrFooter.length; i++) {
            content += '<tr><td class="text-left">' + arrFooter[i].item_id + '</td>';
            content += '<td class="text-left"><a href={{ url("master/item/detail?id=") }}' + arrFooter[i].item_id + '>' + arrFooter[i].item_name + '</a></td>';
            content += '<td class="text-left">' + arrFooter[i].qty + '</td>';

            var button_group = "<td><div class='input-group-btn'>";
            button_group     += "<button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown'>Action<span class='fa fa-caret-down'></span></button>";
            button_group     += "<ul class='dropdown-menu' role='menu'>";
            button_group     += "<li><a class='btn btn-sm' style='text-align:left;' onclick=edit_item(" + i + ")>Ubah</a></li>";
            button_group     += "<li><a class='btn btn-sm delete' style='text-align:left;' onclick=delete_item(" + i + ")>Hapus</a></li>";
            button_group     += "</ul></div></td>";
            content += button_group;
            content += '</tr>';
        };
        $("#tb_item").html(content);
    }

    $( document ).ready(function() {
        $('.datepicker').datepicker({
            format: "dd MM yyyy",
            autoclose: true,
            todayHighlight: true
        });
        populate_item_table();
        $( ".select_item" ).change();
        $('.select_item').select2({
            placeholder: 'Select an option',
            allowClear: true
        })
    });
</script>
@stop