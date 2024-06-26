<!DOCTYPE html>
<?php 
include 'koneksi.php';

// Fetch all animal names for filtering
$query = "SELECT DISTINCT namahewan FROM pasien";
$result = mysqli_query($conn, $query);
$animal_names = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Initialize variables
$q = "SELECT * FROM pasien ORDER BY idhewan ASC";
if (isset($_POST['bcari'])) {
    $keyword = $_POST['tcari'];
    $q = "SELECT * FROM pasien WHERE idhewan LIKE '%$keyword%' OR namahewan LIKE '%$keyword%' ORDER BY idhewan ASC";
} elseif (isset($_POST['breset'])) {
    $_POST['tcari'] = '';
    $q = "SELECT * FROM pasien ORDER BY idhewan ASC";
} elseif (isset($_POST['filter_hewan'])) {
    $selected_hewan = $_POST['filter_hewan'];
    $q = "SELECT * FROM pasien WHERE namahewan = '$selected_hewan' ORDER BY idhewan ASC";
}

$sql = mysqli_query($conn, $q);
?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tracking</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" crossorigin="anonymous"/>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="tracking.css">
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- Fontawesome -->
  <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Custom JS -->
  <script src="script.js"></script>
</head>
<body>
  <div>
    <div class="sidebar" id="sidebar">
      <h4 class="mb-5 text-white">Nama Klinik</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link text-white" href="index.php"><i class="bi bi-house mr-2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="rekammedis.php"><i class="bi bi-grid-fill mr-2"></i> Rekam Medis</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="pasien.php"><i class="fas fa-cat mr-2"></i> Pasien Saya</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="tracking.php"><i class="bi bi-bell mr-2"></i> Tracking</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="obat.php"><i class="fas fa-pills mr-2"></i> Obat</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="tagihan.php"><i class="fas fa-file-invoice mr-2"></i> Tagihan</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#"><i class="bi bi-box-arrow-right mr-2"></i> Logout</a></li>
      </ul>
    </div>
  </div>
  
  <div class="p-4" id="main-content">
    <button class="btn-toggle btn btn-secondary" id="button-toggle"><i class="bi bi-list"></i></button>
    <div class="container">
      <div class="row">
        <!-- Column for Patient Data Table -->
        <div class="col-md-6">
          <div class="col-md-10 col-md-offset-1">
            <h3>Tracking</h3>
            <p>Pantau Kesehatan Hewan Peliharaan</p>
            <!-- Filter by Animal Name -->
            <form action="" method="post" class="mb-3">
              <div class="input-group">
                <select class="form-select" name="filter_hewan" onchange="this.form.submit()">
                  <option value="">Pilih Nama Hewan</option>
                  <?php foreach ($animal_names as $animal) { ?>
                    <option value="<?php echo $animal['namahewan']; ?>"><?php echo $animal['namahewan']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </form>
            
            <?php 
            // Display tracking items only if a filter option is selected
            if (isset($_POST['filter_hewan']) && !empty($sql)) {
              while ($result = mysqli_fetch_assoc($sql)) { ?>
                <div class="tracking-item">
                <br>
                  <div><strong>Id Hewan:</strong> <?php echo $result['idhewan']; ?></div>
                  <br>
                  <div><strong>Nama Pemilik:</strong> <?php echo $result['namapem']; ?></div>
                  <br>
                  <div><strong>Nama Hewan:</strong> <?php echo $result['namahewan']; ?></div>
                  <br>
                  <div><strong>Jenis Kelamin:</strong> <?php echo $result['jk']; ?></div>
                  <br>
                  <div><strong>No Telp:</strong> <?php echo $result['notelp']; ?></div>
                  <br>
                  <div><strong>Alamat:</strong> <?php echo $result['alamat']; ?></div>
                  <br>
                  <div><strong>Dokter Hewan:</strong> <?php echo $result['dokterhewan']; ?></div>
                  <br>
                  <div><strong>Tanggal Pendaftaran:</strong> <?php echo $result['tglpendaf']; ?></div>
                  <br>
                  <div><strong>Jenis Hewan:</strong> <?php echo $result['jenishwn']; ?></div>
                  <br>
                  <div><strong>Berat Hewan:</strong> <?php echo $result['berathwn']; ?></div><br>
                  <div><strong>Warna Bulu:</strong> <?php echo $result['warnabulu']; ?></div><br>
                  <div><strong>Umur:</strong> <?php echo $result['umur']; ?></div>
                  <br>
                  <div><strong>Riwayat Obat:</strong> <?php echo $result['riwobat']; ?></div>
                  <br>
                </div>
              <?php }
            } ?>
          </div>
        </div>

        <!-- Column for Nomor Rekam Medis -->
        <div class="col-md-6">
          <div class="col-md-10 col-md-offset-1">
            <form action="" method="post" class="f1">
              <h3>Nomor Rekam Medis</h3>
              <p>Pantau Kesehatan Hewan Peliharaan</p>
              <div class="f1-steps">
  <div class="f1-progress">
    <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4" style="width: 25%;"></div>
  </div>
  <div class="f1-step active">
    <div class="f1-step-icon-wrapper">
      <div class="f1-step-icon"><i class="fa fa-user"></i></div>
    </div>
    <p>Pendaftaran</p>
    <a href="kelolapendaftaran.php" class="edit-btn">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
  </div>
  <div class="f1-step">
    <div class="f1-step-icon-wrapper">
      <div class="f1-step-icon"><i class="fa fa-home"></i></div>
    </div>
    <p>Penanganan</p>
    <a href="#" class="edit-btn">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
  </div>
  <div class="f1-step">
    <div class="f1-step-icon-wrapper">
      <div class="f1-step-icon"><i class="fa fa-key"></i></div>
    </div>
    <p>Perawatan</p>
    <a href="#" class="edit-btn">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
  </div>
  <div class="f1-step">
    <div class="f1-step-icon-wrapper">
      <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
    </div>
    <p>Selesai</p>
    <a href="#" class="edit-btn">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
  </div>
</div>                      
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    // Toggle sidebar
    document.getElementById("button-toggle").addEventListener("click", () => {
      document.getElementById("sidebar").classList.toggle("active-sidebar");
      document.getElementById("main-content").classList.toggle("active-main-content");
    });
  </script>
</body>
</html>
