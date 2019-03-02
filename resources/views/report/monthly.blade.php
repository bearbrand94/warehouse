@extends('adminlte::page')

@section('title', 'Bukti Tanda Terima')


@section('content')
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
          <strong>Kepada Yth,</strong><br>
          Pemilik<br>
          Alamat
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
    <br>Dengan ini kami mengirimkan tagihan bulanan dengan rincian sebagai berikut:
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Barang</th>
            <th rowspan="2">Sisa Bulan Lalu</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Sisa</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
@stop