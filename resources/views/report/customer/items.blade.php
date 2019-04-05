@extends('adminlte::page')

@section('title', 'Customer Stock Report')


@section('content')
<style type="text/css" media="print">
    div.page
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>

<!-- <body onload="window.print();"> -->
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> PT. Karya Bersama Bersaudara
            <small class="pull-right">Tanggal Cetak: {{date('d M Y', strtotime(now()))}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-xs-12">
          <h4><strong>Laporan Stock Gudang</strong></h4>
        </div>
        <div class="col-xs-8">
          <address>
            <strong>Pemilik Barang, </strong><br>
            {{$data->name}}<br>
<!--             {{$data->address}}<br>
            {{$data->phone1}}<br>
            {{$data->email}} -->
          </address>
        </div>
        <!-- /.col -->
        <div class="col-xs-4 text-right">
          No. Invoice</b><br>
          <b>Surabaya, {{date('d M Y', strtotime(now()))}}</b>
          <br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <br>Dengan ini kami mengirimkan laporan stock barang bulanan dengan rincian sebagai berikut:
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th class="text-right">Jumlah</th>
              <th class="text-center">Satuan</th>
            </tr>
            </thead>
            <tbody>
              <?php $no=1;?>
              @foreach ($data->item_data as $item)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $item->name }}</td>
                  <td class="text-right">{{ $item->qty }}</td>
                  <td class="text-center">{{ $item->unit_name }}</td>
                </tr>
                <?php $no++?>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="page">
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12">
            <h4><strong>Kartu Barang</strong></h4>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-bordered table-sm">
              <thead>
              <tr>
                <th>Tgl</th>
                <th>No. DO</th>
                <th>Ket.</th>
                <th class="text-center">Masuk</th>
                <th class="text-center">Keluar</th>
                <th class="text-center">Sisa</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($data->item_data as $item)
                  <tr>
                    @if(count($item->detail)>0)
                      <td colspan="6"><strong>{{ $item->name }}</strong></td>
                    @else
                      <td colspan="5"><strong>{{ $item->name }}</strong></td>
                      <td class="text-center">{{ $item->qty }}</td>
                    @endif
                  </tr>
                  @for ($i = count($item->detail)-1; $i>=0; $i--)
                    <tr>
                      <td>{{ \Carbon\Carbon::parse($item->detail[$i]->created_at)->format('d M Y') }}</td>
                      <td>{{ $item->detail[$i]->droporder_id }}</td>
                      <td>{{ $item->detail[$i]->header_id }}</td>
                      <?php $type = $item->detail[$i]->note ?>
                      <!-- Bongkar Column -->
                      <td class="text-center">
                        @if($type == "bongkar")
                          {{ $item->detail[$i]->qty }}
                        @endif
                      </td>
                      
                      <!-- Muat Column -->
                      <td class="text-center">
                        @if($type == "muat")
                          {{ $item->detail[$i]->qty }}
                        @endif
                      </td>
                      
                      <!-- Sisa Column -->
                      <td class="text-center">{{ $item->detail[$i]->sisa }}</td>
                    </tr>
                  @endfor
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->

  </div>

</div>
<!-- ./wrapper -->
@stop