<?php
    include 'koneksi.php';

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){
            
    $id_hewan = $_POST['id_hewan'];
    $no_rm = $_POST['no_rm'];
    $nama_hewan = $_POST['nama_hewan'];
    $item = $_POST['item'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $total = $_POST['total'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $tgl_jatuhtempo = $_POST['tgl_jatuhtempo'];
    $status_pem = $_POST['status_pem'];

            $query = "INSERT INTO tagihan VALUES(null, '$id_hewan', '$no_rm', '$nama_hewan', '$item',
             '$harga', '$jumlah', '$total','$tgl_transaksi','$tgl_jatuhtempo', '$status_pem')";
            $sql =  mysqli_query($conn, $query);

            if($sql){
                header("location: tagihan.php");
                //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
            
                
            } else {
                echo $query;
            }

           // echo $namapem." | ".$namahew." | ".$jk." | ".$notelp." | ".$alamat." | ".$dokterhewan." | ".$tglpendaf." | ".$jenishwn." | ".$berathwn." | ".$namahew." | ".$warnabulu." | ".$umur." | ".$riwobat;
           // echo "<br> Tambah Data <a href='index.php'>[Home]</a> ";
        } elseif ($_POST['aksi'] == "edit") {
            //echo "Edit Data <a href='index.php'>[Home]</a> ";
            $id_hewan = $_POST['id_hewan'];
    $no_rm = $_POST['no_rm'];
    $nama_hewan = $_POST['nama_hewan'];
    $item = $_POST['item'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $total = $_POST['total'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $tgl_jatuhtempo = $_POST['tgl_jatuhtempo'];
    $status_pem = $_POST['status_pem'];
            
            $query = "UPDATE tagihan SET id_hewan='$id_hewan',
                                        no_rm ='$no_rm',
                                        nama_hewan = '$nama_hewan',
                                        item = '$item',
                                        harga = '$harga',
                                        jumlah = '$jumlah',
                                        total = '$total',
                                        tgl_transaksi = '$tgl_transaksi',
                                        tgl_jatuhtempo = '$tgl_jatuhtempo',
                                        status_pem = '$status_pem',
                                        
                WHERE id_hewan = '$id_hewan';";
                $sql = mysqli_query($conn, $query);
                    header("location: tagihan.php");
                    //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
                
        }
    }

    if(isset($_GET['hapus'])){
        $idhewan = $_GET['hapus'];
            $query = "DELETE FROM tagihan WHERE id_hewan = '$id_hewan';";
            $sql = mysqli_query($conn, $query);

            if($sql){
                header("location: tagihan.php");
                //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
            } else {
                echo $query;
            }
            echo "Hapus Data <a href='tagihan.php'>[Home]</a> ";
        } 
?>