   <?php
   //ob_start();
   date_default_timezone_set('CET');
  $pdf = new Pdf('L', 'px', 'A4', true, 'UTF-8', false);
  $pdf->SetTitle('Daftar Transaksi');
  $pdf->SetTopMargin(20);
  $pdf->setFooterMargin(20);
  $pdf->SetAutoPageBreak(true);
  $pdf->SetAuthor('Author');
  $pdf->SetDisplayMode('real', 'default');
  $pdf->setPrintHeader(false);
  $pdf->AddPage('L');


  $html .='<h3 style = "width : 100%" align = "center">Daftar Transaksi</h3>
          <table id="table_id" border="1" class="table table-bordered table-striped">
            <tr bgcolor="#ffffff">
              <th width="15%" align="center">No</th>
              <th width="35%" align="center">Waktu Pemesanan</th>
              <th width="50%" align="center">Jumlah Tagihan</th>
            </tr>';
            $i = 0;
      $html.='</table>';
      $pdf->writeHTML($html, true, false, true, false, '');
  ob_end_clean();
  $pdf->Output('transaksi.pdf', 'I');
?>

