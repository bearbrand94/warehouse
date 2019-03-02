@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Detail Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body box-profile">
                  <h3 class="profile-username text-center">{{$item->name}}</h3>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Pemilik</b> <a class="pull-right">{{$item->owned_by}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Satuan</b> <a class="pull-right">{{$item->unit_name}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Sisa</b> <a class="pull-right">{{$item->qty}}</a>
                    </li>
                  </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-12">
            <h3 class="text-left">Histori Barang</h3>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#item" data-toggle="tab">Semua</a></li>
              <li><a href="#bongkar" data-toggle="tab">Bongkar</a></li>
              <li><a href="#muat" data-toggle="tab">Muat</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="item">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="t_item">
                        <thead id="th_item">
                          <th>#ID</th>
                          <th>Tanggal</th>
                          <th class="text-center">Bongkar</th>
                          <th class="text-center">Muat</th>
                          <th class="text-center">Sisa</th>
                        </thead>
                        <tbody>
                          <?php $t_item_sisa = $item->qty; ?>
                          <?php $t_item_bongkar = 0; ?>
                          <?php $t_item_muat = 0; ?>

                          @foreach ($item->detail as $detail)
                          <tr>
                            <td>{{ $detail->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($detail->updated_at)->format('d M Y, H:i:s') }}</td>

                            <!-- Bongkar Column -->
                            <td class="text-center">
                              @if($detail->note == "bongkar")
                                {{ $detail->qty }}
                              @endif
                            </td>
                            
                            <!-- Muat Column -->
                            <td class="text-center">
                              @if($detail->note == "muat")
                                {{ $detail->qty }}
                              @endif
                            </td>
                            
                            <!-- Sisa Column -->
                            <td class="text-center">{{ $t_item_sisa }}</td>
                            @if($detail->note == "muat")
                            <?php $t_item_sisa += $detail->qty; $t_item_muat += $detail->qty ?>
                            @else
                            <?php $t_item_sisa -= $detail->qty; $t_item_bongkar += $detail->qty ?>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <td></td><td></td>
                            <td class="text-center"><label>{{$t_item_bongkar}}</label></td>
                            <td class="text-center"><label>{{$t_item_muat}}</label></td>
                            <td class="text-center"><label>{{$t_item_bongkar-$t_item_muat}}</label></td>
                          </tr>
                        </tfoot>
                    </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="bongkar">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="t_bongkar">
                        <thead id="th_item">
                            <th>#ID</th>
                            <th>Tanggal</th>
                            <th>Note</th>
                            <th>Qty</th>
                            <th>Harga</th>
                        </thead>
                        <tbody>
                            @foreach ($item->detail as $detail)
                            @if($detail->note == "bongkar")
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($detail->updated_at)->format('d M Y, H:i:s') }}</td>
                                <td>{{ $detail->note }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>{{ $detail->price_each*$detail->qty }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="muat">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="t_muat">
                        <thead id="th_item">
                          <th>#ID</th>
                          <th>Tanggal</th>
                          <th>Note</th>
                          <th>Qty</th>
                          <th>Harga</th>
                        </thead>
                        <tbody>
                          @foreach ($item->detail as $detail)
                          @if($detail->note == "muat")
                          <tr>
                              <td>{{ $detail->id }}</td>
                              <td>{{ \Carbon\Carbon::parse($detail->updated_at)->format('d M Y, H:i:s') }}</td>
                              <td>{{ $detail->note }}</td>
                              <td>{{ $detail->qty }}</td>
                              <td>{{ $detail->price_each*$detail->qty }}</td>
                          </tr>
                          @endif
                          @endforeach
                        </tbody>
                    </table>
                </div>
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
        "pageLength": 50
      });
    });
</script>
@stop