<?php 
include('../koneksi/koneksi.php');


$sqlinvoice = $koneksi->query("
select * from tb_barang
");


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Harga CF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class="" style="line-height: 1;">
            <div class="text-center mt-2">
                <a href="" onclick=window.print()>
                <img  src="https://ciwideyfood.com/wp/wp-content/uploads/2021/10/logo-CF-PNG-300x160.png" width="70" alt=""></a>
                <b><p class=" mt-1">Daftar Harga CV Ciwidey Food</p></b>
            </div>
            <b ></b>
            <!-- <form action="" method="post">
                <input type="submit" value="Hitung" name="hitung" class="btn btn-sm btn-success">
            </form> -->

            <!-- <?php 
            if(isset($_POST['hitung'])){
                $qty = $_POST['qty'];
                for($x=1;$x<13;$x++){
                echo $qty.$x;
                }
            }
            ?> -->
            <!--<form>-->
            <!--    <input type="submit" name="tot" Value="hitung">-->
            <!--</form>-->
            <!--<hr>-->
            
        <div class="text-start">
            <table class="table table-sm table-striped">
                <thead>
               <tr>
                   <th>No</th>
                   <th style="width: 20%;">produk</th>
                    <!--<th>Jumlah</th>-->
                   <th>Harga Ecer</th>
                   <th>Harga Reseller</th>
                   <th>Harga Distributor</th>
               </tr>
               </thead>
               <tbody>
            <?php 
            $no=1;
            
                    $sqlharga = $koneksi->query("
                    select * from tb_barang where nama_barang NOT in (' Diskon','Box',' Ongkir','Banpres Dapur Solo','Kardus','Bubble','Ice Gel')
                    order by nama_barang asc
                    "); 
                    $array_qty = [];
                     $harga_ecer = [];
                    $harga_res = []; 
                    $harga_db = [];

                    while($harga = $sqlharga->fetch_assoc()){
                        array_push($array_qty,$harga['harga_jual']*1)
                 ?>
                <tr>
                    <td><?= $no?></td>
                    <td class="form-control">
                    <div class="input-group">   
                    <?= $harga['nama_barang']; ?>
                    <!-- <form action="" method="post">
                    <input class="form-control form-control-sm text-center" type="number" name="qty<?= $no ?>" placeholder="Qty"
                    >
                    </form> -->
                  
                    </div> 
                </td>
                <!--<td>-->
                <!--    <form>-->
                <!--    <input type="number" name="jml">-->
                <!--    </form>-->
                <!--</td>-->
                    <td><?php echo number_format($harga['harga_ecer']);
                    $jumlah_ecer = array_push($harga_ecer,$harga['harga_ecer']);
                    $jumlah_res = array_push($harga_res,$harga['h_reseller']);
                    $jumlah_db = array_push($harga_db,$harga['harga_jual']);

                    ?></td>
                    <td><?= number_format($harga['h_reseller']); ?></td>
                    <td><?= number_format($harga['harga_jual']); ?></td>
                </tr>
                    
                    
                    <?php 
                    
                    
            $no++;
            }
            ?>
            </tbody>
            </table>
        </div>
     
        </div>
    </div>
    
    
    
    <?php
    
    if(isset($_POST['tot'])){
        
        
        
    }
    
    
    ?>


<div class="text-center">
    <button class="btn btn-light">Download Invoice</button></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
  const srcElement = document.querySelector("body"),
  btns = document.querySelectorAll("button");

  btns.forEach(btn => { // looping through each btn
    // adding click event to each btn
    btn.addEventListener("click", () => {
      // creating canvas of element using html2canvas
      html2canvas(srcElement).then(canvas => {
        // adding canvas/screenshot to the body
        if(btn.id === "take-src-only") {
          return document.body.appendChild(canvas);
        }

        // downloading canvas/screenshot
        const a = document.createElement("a");
        a.href = canvas.toDataURL();
        a.download = "Invoice <?= $datainvoice['pelanggan']. $datainvoice['tgl_kirim']; ?>";
        a.click();
        // window.location='whatsapp://send?text='+encodeURIComponent(a+a.download);
      });
    });
  });
</script>
<!-- ss -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>