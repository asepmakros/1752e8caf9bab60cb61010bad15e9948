<?php 
include('../koneksi/koneksi.php');

$no_inv = $_GET['no_inv'];
$approve = "Y";
$date = date('Y-m-d');

$sqlfix = $koneksi->query("
    update sales set
    approve = '$approve',
    tgl_kirim_fix = '$date'
 

    where no_inv = '$no_inv'
    ");

    if($sqlfix){
        ?> 
        
        <script>
            alert("Penjualan sudah Fix akan dikirim!");
            window.location.href = "https://ciwideyfood.com/app/penjualan/order_fix.php";

        </script>
        
        <?php 


    }

    
    ?>

