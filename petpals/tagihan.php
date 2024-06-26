<!DOCTYPE html>
<?php 
include 'koneksi.php';

// untuk menampilkan semua data tagihan
$query = "SELECT * FROM tagihan;";
$sql = mysqli_query($conn, $query);
$no = 0;

// untuk cari data
// jika tombol cari diklik
if (isset($_POST['bcari'])) {
    // tampilkan data yang dicari
    $keyword = $_POST['tcari'];
    $q = "SELECT * FROM tagihan WHERE id_hewan LIKE '%$keyword%' OR nama_hewan LIKE '%$keyword%' OR no_rm LIKE '%$keyword%' ORDER BY id_hewan ASC";
} else {
    $q = "SELECT * FROM tagihan ORDER BY id_hewan ASC";
}

// Reset search
if (isset($_POST['breset'])) {
    $_POST['tcari'] = '';
    $q = "SELECT * FROM tagihan ORDER BY id_hewan ASC";
}

$sql = mysqli_query($conn, $q);
?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tagihan</title>
  <!-- bootstrap 5 css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous"/>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- Fontawesome -->
  <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- Sambungkan file CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Sambungkan file JavaScript -->
  <script src="script.js"></script>
</head>
<body>
  <div>
    <div class="sidebar" id="sidebar">
      <h4 class="mb-5 text-white">Nama Klinik</h4>
      <li><a class="text-white" href="index.php"><i class="bi bi-house mr-2"></i> Dashboard</a></li>
      <li><a class="text-white" href="rekammedis.php"><i class="bi bi-grid-fill mr-2"></i>  Rekam Medis</a></li>
      <li><a class="text-white" href="pasien.php"><i class="fas fa-cat mr-2"></i> Pasien Saya</a></li>
      <li><a class="text-white" href="tracking.php"><i class="bi bi-bell mr-2"></i> Tracking</a></li>
      <li><a class="text-white" href="obat.php"><i class="fas fa-pills mr-2"></i> Obat</a></li>
      <li><a class="text-white" href="tagihan.php"><i class="fas fa-file-invoice mr-2"></i> Tagihan</a></li>
      <li><a class="text-white" href="#"><i class="bi bi-box-arrow-right mr-2"></i> Logout</a></li>
    </div>
  </div>

  <div class="p-4" id="main-content">
    <button class="btn-toggle btn btn-secondary" id="button-toggle"><i class="bi bi-list"></i></button>
    <div class="container-fluid">
      <figure>
        <h1 class="mt-4"> Data Tagihan </h1>
        <blockquote class="blockquote"><p>Kucing Sehat Hanya Dalam Genggaman</p></blockquote>
        <figcaption class="blockquote-footer">Petpals <cite title="Source Title">Source Title</cite></figcaption>
      </figure>
      <a href="tambahtagihan.php" type="button" class="btn btn-primary mb-3">Tambah Tagihan <i class="fa fa-plus"></i></a>
      <form method="POST" action="" class=" mb-3">
        <div class="input-group mb-3">
          <input type="text" name="tcari" id="tcari" value="<?php echo isset($_POST['tcari']) ? $_POST['tcari'] : ''; ?>" class="form-control" placeholder="Cari Data...">
          <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
          <button class="btn btn-danger" name="breset" type="submit" id="reset-button">Reset</button>
        </div>
      </form>
    </div>

    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
          <thead>
            <tr>
              <th> ID Hewan </th>
              <th> No Rekam Medis </th>
              <th> Nama Hewan </th>
              <th> Item </th>
              <th> Harga </th>
              <th> Jumlah </th>
              <th> Total </th>
              <th> Tanggal Transaksi </th>
              <th> Tanggal Jatuh Tempo </th>
              <th> Total </th>
              <th> Status </th>
              <th> Aksi </th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($result = mysqli_fetch_assoc($sql)) {
            ?>
              <tr>
                <td><center><?php echo $result['id_hewan']; ?></center></td>
                <td><center><?php echo $result['no_rm']; ?></center></td>
                <td><center><?php echo $result['nama_hewan']; ?></center></td>
                <td><center><?php echo $result['item']; ?></center></td>
                <td><center><?php echo $result['harga']; ?></center></td>
                <td><center><?php echo $result['jumlah']; ?></center></td>
                <td><center><?php echo $result['total']; ?></center></td>
                <td><center><?php echo $result['tgl_transaksi']; ?></center></td>
                <td><center><?php echo $result['tgl_transaksi']; ?></center></td>
                <td><center><?php echo $result['status_pem']; ?></center></td>
                <td>
                  <a href="prosestagihan.php?hapus=<?php echo $result['id_hewan']; ?>" name="hapus" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Ingin Menghapus Data Tersebut?')"> 
                    <i class="fa fa-trash"></i>
                  </a>
                  <a href="tambahtagihan.php?ubah=<?php echo $result['id_hewan']; ?>" type="button" class="btn btn-success btn-sm"> 
                    <i class="bi bi-pencil"></i>
                  </a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // event will be executed when the toggle-button is clicked
    document.getElementById("button-toggle").addEventListener("click", () => {
      // when the button-toggle is clicked, it will add/remove the active-sidebar class
      document.getElementById("sidebar").classList.toggle("active-sidebar");
      // when the button-toggle is clicked, it will add/remove the active-main-content class
      document.getElementById("main-content").classList.toggle("active-main-content");
    });

    // Clear search input when reset button is clicked
    document.getElementById("reset-button").addEventListener("click", () => {
      document.getElementById("tcari").value = '';
    });
  </script>
</body>
</html>
