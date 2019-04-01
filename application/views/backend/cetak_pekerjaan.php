   <?php
   //ob_start();
   date_default_timezone_set('CET');
  $pdf = new Pdf('L', 'px', 'A4', true, 'UTF-8', false);
  $pdf->SetTitle('Daftar Pekerjaan');
  $pdf->SetTopMargin(20);
  $pdf->setFooterMargin(20);
  $pdf->SetAutoPageBreak(true);
  $pdf->SetAuthor('Author');
  $pdf->SetDisplayMode('real', 'default');
  $pdf->setPrintHeader(false);
  $pdf->AddPage('L');


  $html .='<h3 style = "width : 100%" align = "center">Daftar Pekerjaan</h3>
          <table id="table_id" border="1" class="table table-bordered table-striped">
            <tr bgcolor="#ffffff">
              <th width="5%" align="center">No</th>
              <th width="15%" align="center">Deskripsi</th>
              <th width="10%" align="center">Pekerja</th>
              <th width="10%" align="center">Aset</th>
              <th width="10%" align="center">Brand</th>
              <th width="10%" align="center">Departemen</th>
              <th width="10%" align="center">Lokasi</th>
              <th width="10%" align="center">Mulai</th>
              <th width="10%" align="center">Selesai</th>
              <th width="10%" align="center">Status</th>
            </tr>';
            $i = 0;
      $html.='</table>';
      $pdf->writeHTML($html, true, false, true, false, '');
  ob_end_clean();
  $pdf->Output('daftar pekerjaan.pdf', 'I');
?>

