<?php
include '../koneksi/koneksi.php';

$sqlinvoice = $koneksi->query("select * from sales order by id desc");
$re_pembeli1 = explode("-",$_GET['pembeli']);
$re_pembeli = $re_pembeli1[0];
$re_no_hp = $_GET['no_hp'];
$re_alamat = $_GET['alamat'];
$re_estimasi = $_GET['estimasi'];
$re_kurir = $re_pembeli1[1];


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Klip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-2 sticky-top">
        <div class="row text-center">
            <h1 class="sticky-top ">Invoice Ciwidey Food</h1>
            <textarea class="fixed-top opacity-50 card mb-1 text-center" name="" id="tempat" cols="30" rows="7"
                style="background-color: black;color:#fff;"><?= $re_pembeli . " " . $re_alamat; ?><?= "\n" ?></textarea>

        </div>
        <div class=" bg-light" style="padding-bottom: 50px;">
            <form action="" method="post" style="padding-top: 140px;" class="" id="form1">

               

                <div class="input-group">
                    <select class="bg-light" name="jen" id="">
                        <option value="COD ">COD</option>
                        <option value="TF ">TF</option>
                        <option value="">Lainnya</option>
                    </select>
                    <input type="text" name="pembeli" id="paste-pembeli" required placeholder="Nama"
                        value="<?= $re_pembeli ?>" class="form-control text-center">
                    <button class="btn btn-sm border" id="pastepembeli">Paste</button>
                </div>

                <div class="input-group">
                    <input type="text" name="kurir" id="kur" required placeholder="kurir" value="<?= $re_kurir ?>"
                        class="form-control text-center">
                    <input type="text" name="no_hp" required placeholder="No Hp" value="<?= $re_no_hp ?>"
                        class="form-control text-center">
                        
                        <input type="text" hidden>

                    <button class="btn btn-sm border" id="pasteno_hp" onclick="pasteno_hp()">Paste</button>
                </div>



                <div class="input-group">
                    <textarea style="font-size: 9px;" name="alamat" type="text" class="form-control" id="pastealamat" ><?= $re_alamat ?></textarea>
                    <!-- <input type="text" name="alamat" required placeholder="Alamat" value="<?= $re_alamat ?>"class="form-control text-center"> -->
                    <button class="btn btn-sm border" id="pastealamat">Paste</button>
                </div>




                <div class="input-group input-group-sm mb-1">
                    <select name="jenis" id="j_pembeli" class="form-control text-center" required>
                        <!-- <option value="" selected disabled>Pilih Jenis</option> -->
                        <option value="ecer">Ecer</option>
                        <option value="reseller">Reseller</option>
                        <option value="distributor">Distributor</option>
                    </select>
                    <input type="date" name="tgl_kirim" required placeholder="tgl_kirim"
                        class="form-control text-center" value="<?= date('Y-m-d'); ?>">
                    <input type="numbers" name="estimasi" id="estimasi" value="<?= $re_estimasi ?>" required
                        placeholder="Estimasi Hari" class="form-control text-center">

                </div>
                <div class="input-group  mb-1">
                    <a href="https://ciwideyfood.com/app/penjualan/data_penjualan.php"
                        class="btn  btn-primary form-control">Invoice</a>
                    <input type="submit" name="cek" value="Cek" class="btn btn-warning form-control ">
                    <input type="submit" name="upload" value="Upload" class="btn btn-success form-control ">
                </div>

                <textarea class="form-control mt-3" name="pesanan" id="list_produk" cols="100%" rows="23"><?php
                
                $no = 1;
                $sqlproduk = $koneksi->query("select * from tb_barang order by nama_barang asc");

                while ($dataproduk = $sqlproduk->fetch_assoc()) {
                    echo "#" . $no . "#" . $dataproduk['nama_barang'] . "#0" . "\n";
                    $no++;
                } ?>
        </textarea>

         <!-- tombol baru -->
         <div class="input-group text-center mb-3">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-sm btn-danger border " style="width: 80px;" id="idbutton">ID</button>
                            <button class="btn btn-sm btn-warning border" style="width: 80px;"
                                id="paxelbutton">POS</button>
                            <button class="btn btn-sm btn-success border" style="width: 80px;"
                                id="lionbutton">LION</button>
                            <button class="btn btn-sm btn-primary border" style="width: 80px;" id="coba">Coba</button>

                            <button class="btn btn-sm btn-outline-dark border" style="width: 80px;"
                                id="komplit">Komplit</button>

                            <button class="btn btn-sm btn-outline-dark border" style="width: 80px;"
                                id="hemat">Hemat</button>

                            <button class="btn btn-sm btn-outline-dark border" style="width: 80px;"
                                id="best">Best</button>

                            <button class="btn btn-sm btn-info border" style="width: 80px;" id="cek">ISI CEK</button>


                        </div>
                    </div>
                </div>
                <!-- tombol baru -->

                <!-- <div class="opacity-50">
        <div style="padding-bottom: 200px; width:10%;" class=" fixed-bottom  " >
        <div class="">
                <a href="https://ciwideyfood.com/app/penjualan/data_penjualan.php" class="btn  btn-primary">Invoice</a>
            </div>
        </div>
        <div style="padding-bottom: 250px; width:10%;" class=" fixed-bottom  " >
        <div class="">
                <input type="submit" class="btn  btn-warning" name="cek" value="Cek Harga" id="">
            </div>
        </div>

        <div style="padding-bottom: 300px; width:10%;" class=" fixed-bottom  " >
           

            <div class="">
                <input type="submit" name="upload" value="Upload" class="btn btn-success ">
            </div>
        </div> -->

            </form>
        </div>
        <?php

$date = pow(date('H'),3);
$date1 = date('d')*3;

?>
<div class="opacity-25" style="font-size:12px;">
<?php
echo $date+$date1;
?>
</div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $pembeli = str_replace("'", " ", htmlspecialchars($_POST['jen'] . $_POST['pembeli'] . " - " . $_POST['kurir']));
        $no_hp = htmlspecialchars(preg_replace('/[^0-9]/', '', ltrim($_POST['no_hp'], '0')));
        $alamat = str_replace("'", " ", htmlspecialchars($_POST['alamat']));


        $jenis = $_POST['jenis'];
        $tgl_kirim = $_POST['tgl_kirim'];
        $estimasi = $_POST['estimasi'];
        

        $pesanan = $_POST['pesanan'];

        $array = explode("#", $pesanan);

        $jumlaharray = count(explode("#", $pesanan));
        for ($x = 2; $x <= $jumlaharray; $x += 3) {

            if (explode("#", $pesanan)[$x + 1] != 0) {
                $prod = explode("#", $pesanan)[$x];

                echo explode("#", $pesanan)[$x];
                echo " = ";
                echo explode("#", $pesanan)[$x + 1];
                echo "<br>";
            }
        }
    }
    ?>


    <?php
    if (isset($_POST['upload'])) {
        $tgl_kirim = $_POST['tgl_kirim'];
        $estimasi = $_POST['estimasi'];
        $datainvoice = $sqlinvoice->fetch_assoc();
        $akhirinvoice = mysqli_num_rows($sqlinvoice) + 1;
        $no_inv = $akhirinvoice . $datainvoice['id'];
        


        // $tgl_kirim = date('Y-m-d');

        $pembeli = str_replace("'", " ", htmlspecialchars($_POST['jen'] . $_POST['pembeli'] . " - " . $_POST['kurir']));
        $no_hp = htmlspecialchars(preg_replace('/[^0-9]/', '', str_replace('+62', '', ltrim($_POST['no_hp'], '0'))));
        $alamat = str_replace("'", " ", htmlspecialchars($_POST['alamat']));
        $jenis = $_POST['jenis'];

        $pesanan = $_POST['pesanan'];

        $array = explode("#", $pesanan);

        $jumlaharray = count(explode("#", $pesanan));

        for ($x = 2; $x <= $jumlaharray; $x += 3) {
            if (explode("#", $pesanan)[$x + 1] != 0) {
                $produk = explode("#", $pesanan)[$x];
                $jumlah = explode("#", $pesanan)[$x + 1];

                if ($jenis == "ecer") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_ecer'];


                    $sql12 = $koneksi->query("
            insert into sales (
                no_inv,
                tgl_kirim,
                pelanggan,
                produk,
                status_bayar,
                jumlah,
                j_harga,
                satuan,
                packing,
                akun,
                request_packing,
                estimasi,
                no_hp,
                alamat
                
                )values(
                '$no_inv',
                '$tgl_kirim',
                upper('$pembeli'),
                '$produk',
                'LUNAS',
                '$jumlah',
                '$jenis',
                '$satuan',
                '123',
                '123',
                'N',
                '$estimasi',
                '$no_hp',
                '$alamat'
                    
                    )");

                    //         // FEE COD
                    //         $sql12 .= $koneksi->query("
                    // insert into sales (
                    //     no_inv,
                    //     tgl_kirim,
                    //     pelanggan,
                    //     produk,
                    //     status_bayar,
                    //     jumlah,
                    //     j_harga,
                    //     satuan,
                    //     packing,
                    //     akun,
                    //     request_packing,
                    //     estimasi,
                    //     no_hp,
                    //     alamat

                    //     )values(
                    //     '$no_inv',
                    //     '$tgl_kirim',
                    //     upper('$pembeli'),
                    //     'Fee COD',
                    //     'LUNAS',
                    //     '1',
                    //     '$jenis',
                    //     '$satuan*0.02',
                    //     '123',
                    //     '123',
                    //     'N',
                    //     '$estimasi',
                    //     '$no_hp',
                    //     '$alamat'

                    //         )");
                    //         // FEE COD

                } elseif ($jenis == "reseller") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['h_reseller'];
                    



                    $sql12 = $koneksi->query("
                insert into sales (
                    no_inv,
                    tgl_kirim,
                    pelanggan,
                    produk,
                    status_bayar,
                    jumlah,
                    j_harga,
                    satuan,
                    packing,
                    akun,
                    request_packing,
                    estimasi,
                    no_hp,
                    alamat
                    
                    )values(
                    '$no_inv',
                    '$tgl_kirim',
                    upper('$pembeli'),
                    '$produk',
                    'LUNAS',
                    '$jumlah',
                    '$jenis',
                    '$satuan',
                    '123',
                    '123',
                    'N',
                    '$estimasi',
                    '$no_hp',
                    '$alamat'
                        
                        )");

                    // // FEE COD
                    // $sql12 .= $koneksi->query("
                    // insert into sales (
                    //     no_inv,
                    //     tgl_kirim,
                    //     pelanggan,
                    //     produk,
                    //     status_bayar,
                    //     jumlah,
                    //     j_harga,
                    //     satuan,
                    //     packing,
                    //     akun,
                    //     request_packing,
                    //     estimasi,
                    //     no_hp,
                    //     alamat

                    //     )values(
                    //     '$no_inv',
                    //     '$tgl_kirim',
                    //     upper('$pembeli'),
                    //     'Fee COD',
                    //     'LUNAS',
                    //     '1',
                    //     '$jenis',
                    //     '$satuan*0.02',
                    //     '123',
                    //     '123',
                    //     'N',
                    //     '$estimasi',
                    //     '$no_hp',
                    //     '$alamat'

                    //         )");
                    //         // FEE COD

                } else {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_jual'];
                    



                    $sql12 = $koneksi->query("
                    insert into sales (
                        no_inv,
                        tgl_kirim,
                        pelanggan,
                        produk,
                        status_bayar,
                        jumlah,
                        j_harga,
                        satuan,
                        packing,
                        akun,
                        request_packing,
                        estimasi,
                        no_hp,
                        alamat
                        
                        )values(
                        '$no_inv',
                        '$tgl_kirim',
                        upper('$pembeli'),
                        '$produk',
                        'LUNAS',
                        '$jumlah',
                        '$jenis',
                        '$satuan',
                        '123',
                        '123',
                        'N',
                        '$estimasi',
                        '$no_hp',
                        '$alamat'
                            
                            )");

                    //          // FEE COD
                    // $sql12 .= $koneksi->query("
                    // insert into sales (
                    //     no_inv,
                    //     tgl_kirim,
                    //     pelanggan,
                    //     produk,
                    //     status_bayar,
                    //     jumlah,
                    //     j_harga,
                    //     satuan,
                    //     packing,
                    //     akun,
                    //     request_packing,
                    //     estimasi,
                    //     no_hp,
                    //     alamat

                    //     )values(
                    //     '$no_inv',
                    //     '$tgl_kirim',
                    //     upper('$pembeli'),
                    //     'Fee COD',
                    //     'LUNAS',
                    //     '1',
                    //     '$jenis',
                    //     '$satuan*0.02',
                    //     '123',
                    //     '123',
                    //     'N',
                    //     '$estimasi',
                    //     '$no_hp',
                    //     '$alamat'

                    //         )");
                    //         // FEE COD

                }
                echo explode("#", $pesanan)[$x];
                echo " = ";
                echo explode("#", $pesanan)[$x + 1];
                echo "<br>";
            } ?>
    <script>
    alert("Data berhasil diupload!");
    window.location.href = "https://ciwideyfood.com/app/penjualan/data_penjualan.php";
    </script>
    <?php
        }
    }
    ?>

    <!-- for($x=2;$x<=$jumlah;$x+=3){
        
        if(explode("#",$pesanan)[$x+1] != 0){
            echo explode("#",$pesanan)[$x];
            echo " = ";
            echo explode("#",$pesanan)[$x+1];
            echo "<br>";
        }
     } -->



    </div>

    <!-- CEK HARGA -->
    <?php
    if (isset($_POST['cek'])) {
        $tgl_kirim = $_POST['tgl_kirim'];
        $estimasi = $_POST['estimasi'];
        $datainvoice = $sqlinvoice->fetch_assoc();
        $akhirinvoice = mysqli_num_rows($sqlinvoice) + 1;
        $no_inv = $akhirinvoice . $datainvoice['id'];

        $pembeli = str_replace("'", " ", htmlspecialchars($_POST['jen'] . $_POST['pembeli'] . " - " . $_POST['kurir']));
        $no_hp = htmlspecialchars(preg_replace('/[^0-9]/', '', str_replace('+62', '', ltrim($_POST['no_hp'], '0'))));
        $alamat = str_replace("'", " ", htmlspecialchars($_POST['alamat']));
        $jenis = htmlspecialchars($_POST['jenis']);

        $pesanan = $_POST['pesanan'];

        $array = explode("#", $pesanan);

        $jumlaharray = count(explode("#", $pesanan));

        $cekharga = [];
        $cektotal = [];


        $cekjumlah = [];
        $ceksatuan = [];

        for ($x = 2; $x <= $jumlaharray; $x += 3) {
            if (explode("#", $pesanan)[$x + 1] != 0) {
                $produk = explode("#", $pesanan)[$x];
                $jumlah = explode("#", $pesanan)[($x + 1)];


                if ($jenis == "ecer") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_ecer'];

                    array_push($cekharga, $produk);
                    array_push($ceksatuan, $satuan);
                    array_push($cekjumlah, ($jumlah * $satuan) / $satuan);
                    array_push($cektotal, $satuan * $jumlah);
                } elseif ($jenis == "reseller") {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['h_reseller'];

                    array_push($cekharga, $produk);
                    array_push($ceksatuan, $satuan);
                    array_push($cekjumlah, ($jumlah * $satuan) / $satuan);
                    array_push($cektotal, $satuan * $jumlah);
                } else {
                    $sqlsatuan = $koneksi->query("select * from tb_barang where nama_barang='$produk'");
                    $datasatuan = $sqlsatuan->fetch_assoc();
                    $satuan = $datasatuan['harga_jual'];

                    array_push($cekharga, $produk);
                    array_push($ceksatuan, $satuan);
                    array_push($cekjumlah, ($jumlah * $satuan) / $satuan);
                    array_push($cektotal, $satuan * $jumlah);


                    echo explode("#", $pesanan)[$x];
                    echo " = ";
                    echo explode("#", $pesanan)[$x + 1];
                    echo "<br>";
                }
            }
        }
        $arrlength = count($cekharga);
        $total = array_sum($cektotal);
    ?>
    <script>
    window.location =
        "https://wa.me/62<?= $no_hp ?>?text=Cek%20Harga%20<?= $jenis ?>%20untuk%20<?= $no_hp ?>%0A%0A<?php for ($y = 0; $y < $arrlength; $y++) {
         echo ($y + 1) . '. ' . ' ' . $cekharga[$y] . ' ' . number_format($ceksatuan[$y]) . ' x ' . $cekjumlah[$y] . ' = ' . number_format($cekjumlah[$y] * $ceksatuan[$y]) . '%0a';
        } ?><?= '%0a*Total%20=%20Rp.' . number_format($total) . '*' ?>"
    </script>
    <?php
    }
    ?>
    <!-- CEK HARGA -->



    <script>
                const coba = document.querySelector("button[id='coba']");
                coba.addEventListener('click', async () => {
                    try {
                        const text1 = await navigator.clipboard.readText()
                        document.querySelector("input[name='pembeli']").value += text1;
                        document.querySelector("input[name='no_hp']").value += text1;
                        document.querySelector("input[name='alamat']").value += text1;
                        document.querySelector("input[name='estimasi']").value += text1;
                        document.querySelector("input[name='kurir']").value += text1;
                        const select = document.getElementById('j_pembeli');
                        select.value = 'reseller';


                        const text = '#1# Ongkir#0' +
                            '\n' + '#2#Bandeng Presto#01' +
                            '\n' + '#3#BIC  Single ORI#01' +
                            '\n' + '#4#BIC Couple ORI#01' +
                            '\n' + '#5#BIC Single Ayam Suwir#01' +
                            '\n' + '#6#BIC SINGLE JUMBO#01' +
                            '\n' + '#7#BIC Single Mozarella#01' +
                            '\n' + '#8#BIC Single Seblak#01' +
                            '\n' + '#9#BIC Single Spicy#01' +
                            '\n' + '#10#Box#0' +
                            '\n' + '#11#Bubble#0' +
                            '\n' + '#12#Cuanki#01' +
                            '\n' + '#13#Extra Sambal#0' +
                            '\n' + '#14#Ice Gel#0' +
                            '\n' + '#15#Kardus#0' +
                            '\n' + '#16#Paket 4 Varian#0' +
                            '\n' + '#17#Paket Bandeng Group#0' +
                            '\n' + '#18#Sate Tuna#01' +
                            '\n' + '#19#SBC Family#01' +
                            '\n' + '#20#SBC Jumbo#01' +
                            '\n' + '#21#SBC Mini Couple#01' +
                            '\n' + '#22#Solo Banpres Dapur #0' +
                            '\n' + '#23#Z-DISKON#0'


                        document.querySelector("textarea[id='list_produk']").value = text;
                        
                        var field = document.createElement('input');
                        field.setAttribute('type', 'text');
                        document.body.appendChild(field);
                        
                        setTimeout(function() {
                            field.focus();
                            setTimeout(function() {
                                field.setAttribute('style', 'display:none;');
                            }, 50);
                        }, 50);
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });

                //awal komplit
                const komplit = document.querySelector("button[id='komplit']");
                komplit.addEventListener('click', async () => {
                    try {
                        const text1 = await navigator.clipboard.readText()
                        const select = document.getElementById('j_pembeli');
                        select.value = 'reseller';

                        const text = '#1# Ongkir#0' +
                            '\n' + '#2#Bandeng Presto#01' +
                            '\n' + '#3#BIC  Single ORI#01' +
                            '\n' + '#4#BIC Couple ORI#01' +
                            '\n' + '#5#BIC Single Ayam Suwir#01' +
                            '\n' + '#6#BIC SINGLE JUMBO#01' +
                            '\n' + '#7#BIC Single Mozarella#01' +
                            '\n' + '#8#BIC Single Seblak#01' +
                            '\n' + '#9#BIC Single Spicy#01' +
                            '\n' + '#10#Box#0' +
                            '\n' + '#11#Bubble#0' +
                            '\n' + '#12#Cuanki#01' +
                            '\n' + '#13#Extra Sambal#0' +
                            '\n' + '#14#Ice Gel#0' +
                            '\n' + '#15#Kardus#0' +
                            '\n' + '#16#Paket 4 Varian#0' +
                            '\n' + '#17#Paket Bandeng Group#0' +
                            '\n' + '#18#Sate Tuna#01' +
                            '\n' + '#19#SBC Family#01' +
                            '\n' + '#20#SBC Jumbo#01' +
                            '\n' + '#21#SBC Mini Couple#01' +
                            '\n' + '#22#Solo Banpres Dapur #0' +
                            '\n' + '#23#Z-DISKON#0'


                        document.querySelector("textarea[id='list_produk']").value = text;
                        var field = document.createElement('input');
                        field.setAttribute('type', 'text');
                        document.body.appendChild(field);
                        
                        setTimeout(function() {
                            field.focus();
                            setTimeout(function() {
                                field.setAttribute('style', 'display:none;');
                            }, 50);
                        }, 50);
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });
                //akhir komplit

                //awal best
                const best = document.querySelector("button[id='best']");
                best.addEventListener('click', async () => {
                    try {
                        const text1 = await navigator.clipboard.readText()
                        const select = document.getElementById('j_pembeli');
                        select.value = 'reseller';

                        const text = '#1# Ongkir#0' +
                            '\n' + '#2#Bandeng Presto#05' +
                            '\n' + '#3#BIC  Single ORI#05' +
                            '\n' + '#4#BIC Couple ORI#0' +
                            '\n' + '#5#BIC Single Ayam Suwir#0' +
                            '\n' + '#6#BIC SINGLE JUMBO#0' +
                            '\n' + '#7#BIC Single Mozarella#0' +
                            '\n' + '#8#BIC Single Seblak#0' +
                            '\n' + '#9#BIC Single Spicy#0' +
                            '\n' + '#10#Box#0' +
                            '\n' + '#11#Bubble#0' +
                            '\n' + '#12#Cuanki#0' +
                            '\n' + '#13#Extra Sambal#0' +
                            '\n' + '#14#Ice Gel#0' +
                            '\n' + '#15#Kardus#0' +
                            '\n' + '#16#Paket 4 Varian#0' +
                            '\n' + '#17#Paket Bandeng Group#0' +
                            '\n' + '#18#Sate Tuna#0' +
                            '\n' + '#19#SBC Family#0' +
                            '\n' + '#20#SBC Jumbo#0' +
                            '\n' + '#21#SBC Mini Couple#0' +
                            '\n' + '#22#Solo Banpres Dapur #0' +
                            '\n' + '#23#Z-DISKON#0'


                        document.querySelector("textarea[id='list_produk']").value = text;
                        var field = document.createElement('input');
                        field.setAttribute('type', 'text');
                        document.body.appendChild(field);
                        
                        setTimeout(function() {
                            field.focus();
                            setTimeout(function() {
                                field.setAttribute('style', 'display:none;');
                            }, 50);
                        }, 50);
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });
                //akhir best

                //awal hemat
                const hemat = document.querySelector("button[id='hemat']");
                hemat.addEventListener('click', async () => {
                    try {
                        const text1 = await navigator.clipboard.readText()
                        const select = document.getElementById('j_pembeli');
                        select.value = 'reseller';
                        const text = '#1# Ongkir#0' +
                            '\n' + '#2#Bandeng Presto#02' +
                            '\n' + '#3#BIC  Single ORI#05' +
                            '\n' + '#4#BIC Couple ORI#0' +
                            '\n' + '#5#BIC Single Ayam Suwir#0' +
                            '\n' + '#6#BIC SINGLE JUMBO#0' +
                            '\n' + '#7#BIC Single Mozarella#0' +
                            '\n' + '#8#BIC Single Seblak#0' +
                            '\n' + '#9#BIC Single Spicy#0' +
                            '\n' + '#10#Box#0' +
                            '\n' + '#11#Bubble#0' +
                            '\n' + '#12#Cuanki#0' +
                            '\n' + '#13#Extra Sambal#0' +
                            '\n' + '#14#Ice Gel#0' +
                            '\n' + '#15#Kardus#0' +
                            '\n' + '#16#Paket 4 Varian#0' +
                            '\n' + '#17#Paket Bandeng Group#0' +
                            '\n' + '#18#Sate Tuna#0' +
                            '\n' + '#19#SBC Family#0' +
                            '\n' + '#20#SBC Jumbo#0' +
                            '\n' + '#21#SBC Mini Couple#03' +
                            '\n' + '#22#Solo Banpres Dapur #0' +
                            '\n' + '#23#Z-DISKON#0'


                        document.querySelector("textarea[id='list_produk']").value = text;
                        var field = document.createElement('input');
                        field.setAttribute('type', 'text');
                        document.body.appendChild(field);
                        
                        setTimeout(function() {
                            field.focus();
                            setTimeout(function() {
                                field.setAttribute('style', 'display:none;');
                            }, 50);
                        }, 50);
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });
                //akhir hemat




                const cek = document.querySelector("button[id='cek']");
                cek.addEventListener('click', async () => {
                    try {
                        const text1 = await navigator.clipboard.readText()
                        document.querySelector("input[name='pembeli']").value += text1;
                        document.querySelector("input[name='no_hp']").value += text1;
                        document.querySelector("input[name='alamat']").value += "tes";
                        document.querySelector("input[name='estimasi']").value += "tes";
                        document.querySelector("input[name='kurir']").value += "tes";
                        var field = document.createElement('input');
                        field.setAttribute('type', 'text');
                        document.body.appendChild(field);
                        
                        setTimeout(function() {
                            field.focus();
                            setTimeout(function() {
                                field.setAttribute('style', 'display:none;');
                            }, 50);
                        }, 50);

                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });






                const idbutton1 = document.querySelector("button[id='idbutton']");
                idbutton1.addEventListener('click', async () => {
                    try {
                        const text = 'ID'
                        document.querySelector("input[id='kur']").value = text;
                        
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });

                const idbutton2 = document.querySelector("button[id='paxelbutton']");
                idbutton2.addEventListener('click', async () => {
                    try {
                        const text = 'POS'
                        document.querySelector("input[id='kur']").value = text;
                       
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });

                const idbutton3 = document.querySelector("button[id='lionbutton']");
                idbutton3.addEventListener('click', async () => {
                    try {
                        const text = 'LION'
                        document.querySelector("input[id='kur']").value = text;
                        
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });



                const pasteButton1 = document.querySelector("button[id='pastepembeli']");

                pasteButton1.addEventListener('click', async () => {
                    try {
                        const text = await navigator.clipboard.readText()
                        document.querySelector("input[name='pembeli']").value += text;
                        
                        console.log('Text pasted.');
                    } catch (error) {
                        alert('Harus nomor');
                    }
                });

                const pasteButton2 = document.querySelector("button[id='pasteno_hp']");

                pasteButton2.addEventListener('click', async () => {
                    try {
                        const text = await navigator.clipboard.readText()
                        document.querySelector("input[name='no_hp']").value += text;
                        
                        console.log('Text pasted.');
                    } catch (error) {
                        alert("Harus nomor aja!");
                    }
                });

                const pasteButton3 = document.querySelector("button[id='pastealamat']");

                pasteButton3.addEventListener('click', async () => {
                    try {
                        const text = await navigator.clipboard.readText()
                        document.querySelector("textarea[name='alamat']").value += text;
                       
                        console.log('Text pasted.');
                    } catch (error) {
                        console.log('Failed to read clipboard');
                    }
                });
                </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>

