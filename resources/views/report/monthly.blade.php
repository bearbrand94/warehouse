@extends('adminlte::page')

@section('title', 'Bukti Tanda Terima')


@section('content')

<style type="text/css" media="print">
    div.page
    {
        page-break-after: auto;
        page-break-inside: avoid;
        margin-bottom: 50px;
    }
    div.endpage
    {
        page-break-before: always;
        page-break-inside: avoid;
    }

</style>

<!-- <body onload="window.print();"> -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->

    <!-- /.row -->
    <?php 
      class Rekapitulasi
      {
        // property declaration
        public $nama_kategori = "";
        public $awal = 0;
        public $masuk = 0;
        public $keluar = 0;
        public $sisa = 0;
        public $biaya = 0;
      }
      $rekap_data = [];
      $head_cetak = 0;
    ?>
        <!-- Table row -->
    @foreach ($data->item_data as $item)
    <?php $flag_print=false; ?>
    @foreach($item->items as $cnt)
      @if($period_data->period_month == date('m', strtotime($cnt->created_at)))
        <?php $flag_print=true; ?>
      @endif
    @endforeach

    @if($flag_print)
    <div class="page">
      @if($head_cetak == 0)
      <div class="row invoice-info">

        <div class="col-xs-8">
          <!-- <strong>Kepada Yth,</strong><br> -->
          <p style="font-size: 18px;">{{$data->name}}</p></div>
        <!-- /.col -->
        <div class="col-xs-4 text-right"></div>
        <!-- /.col -->
      </div>
      <?php $head_cetak = 1;?>   
      @endif

      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-condensed">
            <thead class="">
              <tr>
                <th colspan="5" class="text-center" style="font-size: 18px;">{{$item->name}}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <!-- <th>ID</th> -->
                <th>Tanggal</th>
                <th class="text-center">Pekerjaan</th>
                <th class="text-center">Masuk</th>
                <th class="text-center">Keluar</th>
                <th class="text-center">Keterangan</th>
              </tr>
              <?php $balance_masuk=0; $balance_keluar=0; $half1=0; $half2=0; $half1_keluar=0; $total_bongkar=0; $total_muat=0;?>
              <tr>
                <td></td>
                <td class="text-center">SISA</td>
                <td class="text-center">                
                  <?php $sisa_awal = $item->total_sisa-($item->total_masuk-$item->total_keluar); ?>
                  {{$sisa_awal}}
                  <?php $balance_masuk += $sisa_awal; ?>
                </td>
                <td></td>
                <td>Bulan {{DateTime::createFromFormat('!m', $period_data->period_month-1)->format('F') . " " . $period_data->period_year}}</td>
              </tr>

              <?php $half1=$sisa_awal; ?>
              @for($i=0; $i<count($item->items); $i++)
              @if($period_data->period_month == date('m', strtotime($item->items[$i]->created_at)))
              <tr>
                <!-- <td>{{$item->items[$i]->id}}</td> -->
                <td>{{ date('d F Y', strtotime($item->items[$i]->created_at)) }}</td>
                <?php
                  if(date('d', strtotime($item->items[$i]->created_at)) <= 15 && $item->items[$i]->type == "addition"){
                    $half1 += $item->items[$i]->qty;
                  }
                  elseif(date('d', strtotime($item->items[$i]->created_at)) <= 15 && $item->items[$i]->type == "subtraction"){
                    $half1_keluar += $item->items[$i]->qty;
                  }
                  elseif(date('d', strtotime($item->items[$i]->created_at)) > 15 && $item->items[$i]->type == "addition"){
                    $half2 += $item->items[$i]->qty;
                  };
                ?>

                <td class="text-center">{{ strtoupper($item->items[$i]->note) }}</td>
                <td class="text-center">
                  @if($item->items[$i]->type == "addition")
                    {{ $item->items[$i]->qty}}
                    <?php $balance_masuk += $item->items[$i]->qty; $total_bongkar += $item->items[$i]->qty; ?>
                  @endif
                </td>
                <td class="text-center">
                  @if($item->items[$i]->type == "subtraction")
                    {{ $item->items[$i]->qty }}
                    <?php $balance_keluar += $item->items[$i]->qty; $total_muat += $item->items[$i]->qty;?>
                  @endif                
                </td>
                <td class="text-left">{{$item->items[$i]->name}}</td>
              </tr>
              @endif
              @endfor
              <?php $half2 += $half1 - $half1_keluar; ?>
              <tr>
                <td colspan="2" class="text-right">Sisa Barang:</td>
                <td class="text-center">-</td>
                <td class="text-center">
                  {{$sisa_awal + $total_bongkar - $total_muat}}
                  <?php $balance_keluar += $sisa_awal + $total_bongkar - $total_muat;?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan="2" class="text-right">Balance:</td>
                <td class="text-center">{{$balance_masuk}}</td>
                <td class="text-center">{{$balance_keluar}}</td>
                <td></td>
              </tr>
              <tr>
                <td colspan="6">
                  <table class="table" border=0>
                    <thead>
                      <th class="text-right">Ongkos-Ongkos</th>
                      <th class="text-right">Banyak Barang</th>
                      <th class="text-right">Harga Satuan</th>
                      <th class="text-right">Subtotal</th>
                    </thead>
                    <tbody>
                      <?php $subhalf1 = $half1 * $item->price_simpan; ?>
                      <?php $subhalf2 = $half2 * $item->price_simpan; ?>
                      <?php $subbongkar = $item->price_bm * $total_bongkar; ?>
                      <?php $submuat = $item->price_bm * $total_muat; ?>
                      <?php $subtotal = $subbongkar + $submuat + $subhalf1 + $subhalf2; ?>

                      @if($item->price_stapel == 0)
                      <tr>
                        <td class="text-right">Penitipan Tgl 01-15</td>
                        <td class="text-right">{{$half1}}</td>
                        <td class="text-right">{{number_format($item->price_simpan)}}</td>
                        <td class="text-right">{{number_format($subhalf1)}}</td>
                      </tr>
                      <tr>
                        <td class="text-right">Penitipan Tgl 16-31</td>
                        <td class="text-right">{{$half2}}</td>
                        <td class="text-right">{{number_format($item->price_simpan)}}</td>
                        <td class="text-right">{{number_format($subhalf2)}}</td>
                      </tr>
                      <tr>
                        <td class="text-right">Bongkar</td>
                        <td class="text-right">{{$total_bongkar}}</td>
                        <td class="text-right">{{number_format($item->price_bm)}}</td>
                        <td class="text-right">{{number_format($subbongkar)}}</td>
                      </tr>
                      <tr>
                        <td class="text-right">Muat</td>
                        <td class="text-right">{{$total_muat}}</td>
                        <td class="text-right">{{number_format($item->price_bm)}}</td>
                        <td class="text-right">{{number_format($submuat)}}</td>
                      </tr>
                      @else
                      <tr>
                        <td class="text-right">Stapel</td>
                        <td class="text-right">{{$half1+$half2}}</td>
                        <td class="text-right">{{number_format($item->price_stapel)}}</td>
                        <td class="text-right">{{number_format($item->price_stapel*$balance_masuk)}}</td>
                        <?php $subtotal += $item->price_stapel*$balance_masuk; ?>
                      </tr>
                      @endif
                      <tr>
                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                        <td class="text-right">Rp. {{number_format($subtotal)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

    <?php 
      $rekap = new Rekapitulasi(); 
      $rekap->nama_kategori = $item->name;
      $rekap->awal = $sisa_awal;
      $rekap->masuk = $item->total_masuk;
      $rekap->keluar = $item->total_keluar;
      $rekap->sisa = $sisa_awal + $item->total_masuk - $item->total_keluar;
      $rekap->biaya = $subtotal;
      array_push($rekap_data, $rekap);
    ?>
    @endif
    @endforeach


    <div class="endpage">
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th colspan="6" class="text-center" style="font-size: 18px;">Rekapitulasi {{DateTime::createFromFormat('!m', $period_data->period_month)->format('F') . " " . $period_data->period_year}}</th>
            </tr>
            <tr>
              <th style="width: 80%">Nama Barang</th>
<!--               <th class="text-center">Awal</th>
              <th class="text-center">Masuk</th>
              <th class="text-center">Keluar</th>
              <th class="text-center">Sisa</th> -->
              <th class="text-right">Biaya</th>
            </tr>
            </thead>
            <tbody>
              <?php $total = 0; ?>
              @foreach($rekap_data as $rekap)
              <tr>
                <td>{{$rekap->nama_kategori}}</td>
<!--                 <td class="text-center">{{$rekap->awal}}</td>
                <td class="text-center">{{$rekap->masuk}}</td>
                <td class="text-center">{{$rekap->keluar}}</td>
                <td class="text-center">{{$rekap->sisa}}</td> -->
                <td class="text-right">{{number_format($rekap->biaya)}}</td>
              </tr>
              <?php $total += $rekap->biaya; ?> 
              @endforeach
              <tr>
                <td class="text-right"><strong>Total:</strong></td>
                <td class="text-right"><strong>Rp. {{number_format($total)}}</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@stop