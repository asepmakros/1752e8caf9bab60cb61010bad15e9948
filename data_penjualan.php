<?php
include('../koneksi/koneksi.php');
$jenis = $_GET["jenis"];
$date = pow(date('H'),3);
$date1 = date('d')*3;

?>
<div class="opacity-25" style="font-size:9px;">
<?php
 $date+$date1;
?>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
    <title>Data Invoice</title>
</head>

<body>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link href="DataTables/datatables.min.css" rel="stylesheet">
 
 <!-- <script src="DataTables/datatables.min.js"></script> -->


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <h3 class=" fixed-top  text-center">Data Penjualan Ciwidey Food <?= $jenis ?></h3>

    <div class="container">
        <div class=" mt-4">
            <div class="row">
                <div class="col">
                    <div style="" class="mt-2 opacity-75 text-center">
                       <div>
                        <div class="input-group" style="font-size : 5px;">
                    <a href="https://ciwideyfood.com/app/penjualan/index_klip.php"
                            class="btn btn-dark  form-control ">Invoice Klip</a>
                  
                    <a href=" https://ciwideyfood.com/app/penjualan/order_fix.php"
                            class="btn btn-dark btn-sm form-control">Tabel Orderan Fix</a>
                    </div>
                          <div class="input-group">
                    <a href=" https://ciwideyfood.com/app/penjualan/rekap_harian.php"
                            class="btn btn-dark form-control mt-2">Rekap Packing </a>
                            
                    <a href="https://ciwideyfood.com/app/penjualan/rekap_jual_harian.php"
                            class="btn btn-dark form-control mt-2">Rekap Ekspedisi </a>
                              </div>
                    </div>
                </div>
            </div>
            </div>

            <table id="myTable" class="table table-responsive-sm table-striped display ">
                <thead>

                    <th class="">#</th>
                    <th class="" style="width: 100%;">Orderan</th>

                </thead>
                <tbody>
                    <?php
                    $sql = $koneksi->query("select * from sales 
                         group by no_inv order by id desc limit 150");
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                    ?>

                    <tr style="font-size:14px;" <?php
                            if ($data['approve'] != "") {
                                echo "style='background-color: yellow;'";
                            }
                            ?>>
                        <td><?php echo $no++; ?></td>
                        <td class="text-start fw-bold">
                        
                        
                        <a href="https://ciwideyfood.com/app/penjualan/invoice.php?no_inv=<?php echo $data['no_inv']; ?>">
                        <?php echo $data['no_inv'] ;?>
                        </a>
                        <?php echo  " - " . $data['tgl_kirim']." <a class =\"material-icons\" style=\"font-size:16px;\" href='https://ciwideyfood.com/app/penjualan/edit_transaksi.php?no_inv=" . $data['no_inv'] . "'> edit</a>";
                         ?>
                          --<a class="material-icons" style="font-size:16px;"
                                    onclick="return confirm('Yakin hapus data <?php echo $data['nama']; ?>?');"
                                    href="https://ciwideyfood.com/app/penjualan/hapus.php?no_inv=<?php echo $data['no_inv']; ?>">delete</a>
                        <?php 
                        echo "<br>" .
                        $data['pelanggan'] . " HP : <a style=\"font-size:12px;\" href='https://wa.me/62" . $data['no_hp'] . "'>0". $data['no_hp'] ."</a><br>" . $data['alamat'];

                        // if($data['estimasi']!="" ){
                        // echo "Est. sampai ".$data['estimasi']." hari";} ; 
                        ?>

                            <br>
                            <div class="input-group">
                            <a href="https://ciwideyfood.com/app/penjualan/index_klip.php?no_inv=<?= $data['no_inv'] ?>&pembeli=<?= str_replace('RES ', '', str_replace('PAXEL ', '', str_replace('TF ', '', str_replace('COD ', '', $data['pelanggan'])))) ?>&no_hp=<?= $data['no_hp'] ?>&alamat=<?= $data['alamat'] ?>&estimasi=<?= $data['estimasi'] ?>"
                                class="btn btn-sm btn-warning ">Repeat Order</a>

                                    <?php 
                                    if($data['gudang']!='y'){
                                    ?>
                                    <a href="https://ciwideyfood.com/app/penjualan/pack.php?no_inv=<?= $data['no_inv'] ?>" class="btn btn-sm btn-outline-info ">Packing Hari Ini</a>
                                    <?php }
                                    else {
                                    ?>
                                    <a href="https://ciwideyfood.com/app/penjualan/unpack.php?no_inv=<?= $data['no_inv'] ?>" class="btn btn-sm btn-info ">Sudah Packing</a>
                                    <?php } ?>
                                    </div>
                              

                                <div class="col-md-3 text-end">
                                <a href="https://ciwideyfood.com/app/penjualan/tambah_produk.php?no_inv=<?= $data['no_inv'] ?>" class=" btn-sm btn-primary ">+Produk</a>
                                </div>

                            <?php
                                $invoice = $data['no_inv'];
                                $sqlproduk = $koneksi->query("select * from sales 
                            where no_inv = '$invoice'");

                                $nopro = 1;
                                $total_berat = [];
                                $total_bayar = [];
                                while ($dataproduk = $sqlproduk->fetch_assoc()) {

                                    $barang = $dataproduk['produk'];
                                    $sqlberat = $koneksi->query("select * from tb_barang 
                            where nama_barang = '$barang'");
                                    $databerat = $sqlberat->fetch_assoc();

                                    $berat = array_push($total_berat, ($dataproduk['jumlah'] * $databerat['berat']));
                                    $bayar = array_push($total_bayar, ($dataproduk['jumlah'] * $dataproduk['satuan']));

                                    echo $nopro . ". " . $dataproduk['produk']. " (" . $dataproduk['jumlah'] . " x " . number_format($dataproduk['satuan']) . ") " .

                                        "<a class =\"material-icons\" style=\"font-size:16px;\" href='https://ciwideyfood.com/app/penjualan/edit.php?id=" . $dataproduk['id'] . "'> edit</a>"."--".
                                        "<a class =\"material-icons\" style=\"font-size:16px;\" href='https://ciwideyfood.com/app/penjualan/hapus_produk.php?id=" . $dataproduk['id'] . "'>      delete</a>"
                                        . "<br>";


                                    $nopro++;
                                }
                                ?>
  
                                <?php  
                                $tomas = array_sum($total_berat)+100;
                                ?>
                                
                                
                                <div class="input-group align-middle">

                                    <a href="https://ciwideyfood.com/app/penjualan/wa.php?no_inv=<?= $data['no_inv'] ?>&massa=<?= $tomas ?>"
                                        class="btn btn-sm btn-success ">Kirim Wa</a>
    
                                    <a href="https://ciwideyfood.com/app/penjualan/index_klip.php?no_inv=<?= $data['no_inv'] ?>&pembeli=<?= str_replace('RES ', '', str_replace('PAXEL ', '', str_replace('TF ', '', str_replace('COD ', '', $data['pelanggan'])))) ?>&no_hp=<?= $data['no_hp'] ?>&alamat=<?= $data['alamat'] ?>&estimasi=<?= $data['estimasi'] ?>">
                                    
                                         <?php
                                    if ($data['approve'] == "") {
                                    ?>
                                <a class="btn btn-sm btn-outline-primary "
                                    href="https://ciwideyfood.com/app/penjualan/fix.php?no_inv=<?php echo $data['no_inv']; ?>">Fix
                                    Kirim </a>

                                <?php } ?>

                                <br>
                                    <?php
                                    echo "<div class='bg-dark form-control text-light text-start' style=\"font-size:12px;\">
                                     Massa : " . $tomas . " g<br>" . 
                                    " Total : Rp. " . (number_format(array_sum($total_bayar))) . "</div>";?>
                              
                                </div>


                       


                           

                            </div>
                        </td>

                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
        $('#myTable').DataTable();
        </script>


    </div>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>