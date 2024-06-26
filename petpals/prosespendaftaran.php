<?php
include 'koneksi.php';

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "add"){   
        $idhewan = $_POST['idhewan'];     
        $norekam = $_POST['norekam'];
        $tgl_pem= $_POST['tgl_pem'];
        $estimasi_tgl = $_POST['estimasi_tgl'];
        $tahap = $_POST['tahap'];
        $status = $_POST['status'];
        $tgl_tahapan = $_POST['tgl_tahapan'];
        $waktu_tahapan = $_POST['waktu_tahapan'];

        // Check if norekam already exists
        $checkQuery = "SELECT norekam FROM tracking WHERE norekam = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "s", $norekam);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0){
            echo "No Rekam Medis already exists. <a href='tracking.php'>Back</a>";
        } else {
            // Check if idhewan exists in pasien table
            $checkIdhewanQuery = "SELECT idhewan FROM tracking WHERE idhewan = ?";
            $stmt = mysqli_prepare($conn, $checkIdhewanQuery);
            mysqli_stmt_bind_param($stmt, "s", $idhewan);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0){
                $query = "INSERT INTO tracking VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "sssssssssss",  $idhewan, $norekam, $tgl_pem, $estimasi_tgl, $tahap, $status, $tgl_tahapan, $waktu_tahapan);

                if($sql){
                    header("location: tracking.php");
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "ID Hewan not found in Pasien table. <a href='tracking.php'>Back</a>";
            }
        }
    }
}

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "edit"){
        $idhewan = $_POST['idhewan'];     
        $norekam = $_POST['norekam'];
        $tgl_pem= $_POST['tgl_pem'];
        $estimasi_tgl = $_POST['estimasi_tgl'];
        $tahap = $_POST['tahap'];
        $status = $_POST['status'];
        $tgl_tahapan = $_POST['tgl_tahapan'];
        $waktu_tahapan = $_POST['waktu_tahapan'];
        
        $queryShow = "SELECT * FROM tracking WHERE no = ?";
        $stmt = mysqli_prepare($conn, $queryShow);
        mysqli_stmt_bind_param($stmt, "i", $no);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt)->fetch_assoc();

        $query = "UPDATE tracking SET idhewan= ?, norekam = ?, tgl_pem = ?, estimasi_tgl = ?, tahap = ?, status = ?, tgl_tahapan = ?, waktu_tahapan = ? WHERE no = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssssi", $idhewan, $norekam, $tgl_pem, $estimasi_tgl, $tahap, $status, $tgl_tahapan, $waktu_tahapan);
        mysqli_stmt_execute($stmt);
        
        header("location: tracking.php");
    }
}

if(isset($_GET['hapus'])){
    $no = $_GET['hapus'];

    $queryShow = "SELECT * FROM tracking WHERE no = ?";
    $stmt = mysqli_prepare($conn, $queryShow);
    mysqli_stmt_bind_param($stmt, "i", $no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt)->fetch_assoc();

    $query = "DELETE FROM tracking WHERE no = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $no);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0){
        header("location: tracking.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
