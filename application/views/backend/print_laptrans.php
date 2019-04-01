<html>
<head>
  <title>Cetak PDF</title>
  <style>
    table {
      border-collapse:collapse;
      table-layout:fixed;width: 630px;
    }
    table td {
      word-wrap:break-word;
      width: 20%;
    }
  </style>
</head></html>
<body>
    <b><?php echo $ket; ?></b><br /><br />
    
  <table border="1" cellpadding="8">
  <tr>
    <th>Tanggal</th>
    <th>ID Invoice</th>
    <th>Nama Produk</th>
    <th>Jumlah</th>
    <th>Biaya</th>
  </tr>
    <?php
    if( ! empty($transaksi)){
      $no = 1;
      foreach($transaksi as $data){
            $tgl = date('d-m-Y', strtotime($data->tgl));
        echo "<tr>";
        echo "<td>".$tgl."</td>";
        echo "<td>".$data->id_invoice."</td>";
        echo "<td>".$data->nama_produk."</td>";
        echo "<td>".$data->jumlah."</td>";
        echo "<td>".$data->biaya."</td>";
        echo "</tr>";
        $no++;
      }
    }
    ?>
  </table>

</body>
</html>