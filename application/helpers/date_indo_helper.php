<?php

function full_tgl_indo($tanggal)
{
     $bulan = array(
          1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
     );
     $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));

     // variabel pecahkan 0 = tanggal
     // variabel pecahkan 1 = bulan
     // variabel pecahkan 2 = tahun

     return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . '<br/>pkl. ' . date('H:i:s', strtotime($tanggal));
}

function tgl_indo($tanggal)
{
     $bulan = array(
          1 =>   'Jan',
          'Feb',
          'Mar',
          'Apr',
          'Mei',
          'Jun',
          'Jul',
          'Agt',
          'Sep',
          'Okt',
          'Nov',
          'Des'
     );
     $pecahkan = explode('-', $tanggal);

     // variabel pecahkan 0 = tanggal
     // variabel pecahkan 1 = bulan
     // variabel pecahkan 2 = tahun

     return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function jam_indo($tanggal)
{
     return date('H:i', strtotime($tanggal)) . ' WIB';
}
