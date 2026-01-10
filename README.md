# UAS PEMROGRAMAN WEB 1 

NAMA:ADINDA AULIA NABILA PUTRI 

NIM:312410309

KELAS:TI.24.A.4


# DESKRIPSI 

Aplikasi ini adalah sistem manajemen inventaris berbasis WEB OOP DAN MODULAR yang dirancang untuk mengelola data alat tulis secara efesien. Menggunakan sistem Routing(.htaccess) untuk navigasi yang rapi. Sistem ini dilengkapi dengan Login Multi-role (Admin & User) serta fitur utama berupa pengelolaan data CRUD, Pencarian, Pagination untuk memudahkan pengaturan stok dan katalog barang.

# STRUKTUR DIREKTORY
<img width="175" height="498" alt="Screenshot 2026-01-10 220413" src="https://github.com/user-attachments/assets/b19f9fe8-aac3-45ec-b05d-8d5b158b244d" />

# MEMBUAT DATABASE: APLIKASI TOKO ALAT TULIS 

Membuat database di ```CREATE DATABASE``` toko_alattulis. 

# MEMBUAT TABEL BARANG 
```
CREATE TABLE barang (
  id_barang INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(20),
  gambar VARCHAR(255),
  nama_barang VARCHAR(100),
  kategori VARCHAR(50),
  stok INT,
  harga INT,
  satuan VARCHAR(20)
);
```

# MENAMBAHKAN DATA 
```
INSERT INTO barang (kode_barang, gambar, nama_barang, kategori, stok, harga, satuan) VALUES
('AT002', 'pensil.jpg', 'Pensil 2B', 'Alat Tulis', 100, 2000, 'pcs'),
('AT003', 'pulpen.jpg', 'Pulpen Hitam', 'Alat Tulis', 150, 3000, 'pcs'),
('AT004', 'penghapus.jpg', 'Penghapus', 'Alat Tulis', 200, 1500, 'pcs'),
('AT005', 'penggaris.jpg', 'Penggaris 30cm', 'Alat Tulis', 80, 5000, 'pcs'),
('AT005', 'spidol.jpg', 'Spidol Warna', 'Alat Tulis', 60, 7000, 'pcs');
```
Berikut hasil dari phpMyAdmin 
<img width="1001" height="201" alt="Screenshot 2026-01-10 204449" src="https://github.com/user-attachments/assets/9313bcf1-90cd-405f-8c09-66b4a514cd5b" />


# MEMBUAT FOLDER .htaccess
```
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Sesuaikan dengan nama folder project kamu di htdocs
    RewriteBase /toko_alattulis/

    # Abaikan jika file atau folder asli memang ada
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f

    # Arahkan semua request ke index.php
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```
Membuat folder dengan nama ```toko_alattulis``` di dalamnya terdapat file ```.htaccess```. File ini digunakan untuk mengaktifkan fitur URL Rewrite pada Apache agar aplikasi dapat menggunakan alamat URL yang mudah dibaca.

# MEMBUAT FOLDER CONFIG 
```
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "toko_alattulis";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi database gagal");
}
```
Membuat folder ```config``` di VSCode dengan file didalamnya ```koneksi.php``` berfungsi untuk menghubungkan aplikasi PHP dengan database MySQL. Di dalam file ini mengatur server seperti host, username, password, dan nama database yang digunakan, yaitu toko_alattulis. Proses koneksi dilakukan menggunakan fungsi ```mysql_connect()```, dan jika koneksi gagal maa program akan menampilkan pesan "koneksi ke server gagal" lalu menghentikan proses. Dengan adanya baik dan terhubung secara langsung ke MySQL. 

# MEMBUAT FILE INDEX UTAMA
```
<?php
include "config/koneksi.php";
$dataBarang = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">

    <h1>Toko Alat Tulis</h1>
    <p style="text-align:center;">Selamat datang di Toko Alat Tulis Online</p>

    <!-- NAVIGASI -->
    <nav style="text-align:center; margin: 15px 0;">
        <a href="index.php" class="btn">Home</a>
        <a href="users/event.php" class="btn">Event</a>
        <a href="auth/login.php" class="btn">Login</a>
    </nav>

    <hr>

    <!-- DAFTAR PRODUK -->
    <div class="produk" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:20px;">

        <?php while ($row = mysqli_fetch_assoc($dataBarang)) : ?>
        <div class="card" style="background:#fff; padding:15px; border-radius:10px; box-shadow:0 5px 10px rgba(0,0,0,0.1); text-align:center;">

            <img src="assets/img/barang/<?= htmlspecialchars($row['gambar']) ?>"
                 alt="<?= htmlspecialchars($row['nama_barang']) ?>"
                 style="width:120px; height:120px; object-fit:cover; margin-bottom:10px;">

            <h3><?= htmlspecialchars($row['nama_barang']) ?></h3>
            <p>Kategori: <?= htmlspecialchars($row['kategori']) ?></p>
            <p><b>Rp <?= number_format($row['harga']) ?></b></p>
            <p>Stok: <?= $row['stok'] ?> <?= htmlspecialchars($row['satuan']) ?></p>

        </div>
        <?php endwhile; ?>

    </div>

</div>

</body>
</html>
```
Membuat Folder ```toko_alattulis``` di VSCode dengan file didalamnya ```index.php```. Code ini dibuat dengan menggabungkan PHP dan HTML yang berfungsi untuk menmapilkan katalog produk dari database secara dinamis ke dalam halaman web. Di dalam struktur HTML, terdapat navigasi utama yang memberikan akses ke halaman home, event, dan login. Bagian intinya terletak pada mekanisme perulangan (looping) menggunakan ```while```, dimana setiap data produk yang ditemukan di database akan secara otomatis ke dalam elemen visual berbentuk tabel. Setiap tabel gambar, nama, kategori, harga, dan stok yang diambil langsung dari database. 

Berikut hasil dari Browser 

<img width="898" height="636" alt="Screenshot 2026-01-10 153339" src="https://github.com/user-attachments/assets/be22e855-eaea-42c1-ac32-8812bc35221e" />

# MEMBUAT FOLDER AUTH 
Membuat folder baru di VSCode, dengan file yang berada didalamnya sebagai berikut: 

# 1. Membuat File Login 
```
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <form action="proses_login.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
```

Pada file ini dibagian ```<head>``` terdapat ```<title>``` untuk judul tab browser yaitu "login", dan ```<link>``` yang menghubungkan ke file CSS eksternal ```(style.css)``` agar tampilan halaman rapi. Di ```<body>``` seluruh konten login berada didalam ```<div class="login-box">```. Di dalamnya ada ```<h2>``` sebagai judul form "login" dan ```<form>``` yang mengirim data ke file ```proses_login.php``` menggunakan metode POST. 

Form ini memiliki dua input, satu untuk email dan satu untuk password, keduanya wajib diisi. dibawah input ada button login yang saat diklik akan mengirimkan data ke ```proses_login.php``` untuk proses. 

Berikut hasil dari Browser

<img width="451" height="418" alt="Screenshot 2026-01-10 161456" src="https://github.com/user-attachments/assets/228a879c-241d-4ad1-8f2d-4194145c620d" />

# 2. MEMBUAT FILE LOGOUT
```
<?php
session_start();

// Hapus semua session
$_SESSION = array();

// Hapus cookie session jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Redirect ke login
header("Location: login.php");
exit;
```
Pada file ini terdapat ```session_start();``` memlalui session agar bisa diakses dan dimanipulasi. Kemudian ```$_session = array();``` menghapus semua data session saat ini, sehingga informasi login tidak tersisa di server. Selantunya, kode memeriksa apakah session menggunakan cookie ```(ini_get("session.use_cookies"))```. Jika iya, cookie session di hapus dengan ```setcookie()```dengan waktu kadaluwarsa di masa lalu, sehingga browser juga tidak lagi menyimpan session. Pada bagian ```session_destory();``` menghancurkan session sepenuhnya di server. dan pada bagian ```header("Location: login.php);``` mengarah pengguna kembali ke halaman login, dan ```exit``` menghentikan eksekusi script agar redirect langsung terjadi. 

# 3. MEMBUAT FILE PROSES_LOGIN
```
<?php
session_start();
include "../config/koneksi.php";

$email    = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users 
     WHERE email='$email' AND password='$password'"
);

$user = mysqli_fetch_assoc($query);

if ($user) {
    $_SESSION['login']   = true;
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama']    = $user['nama'];
    $_SESSION['role']    = $user['role'];

    // ARAH BERDASARKAN ROLE
    if ($user['role'] == 'admin') {
        header("Location: ../barang/index.php");
    } else {
        header("Location: ../users/beli.php");
    }
    exit;
} else {
    echo "<script>
        alert('Email atau Password salah');
        window.location='login.php';
    </script>";
}
```
Kode iu=ni berfungsi untuk memproses login pengguna. Data email dan password diambil dari form, lalu dicek ke database. Jika cocok, sistem membuat session login dan menyimpan data useer serta rolenya. Setelah itu, pengguna diarahkan ke halaman sesuai role (admin ke halaman barang, user ke halaman beli). Jika data tidak cocok, muncul pesan bahwa email atau password salah dan kembali ke halaman login. 

# MEMBUAT FOLDER BARANG
Membuat folder baru di VSCode, dengan file yang berada didalamnya sebagai berikut: 

# 1. MEMBUAT FILE INDEX 
```
<?php
session_start();
include "../config/koneksi.php";

// ambil keyword pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

// amankan keyword dari SQL Injection
$keyword_safe = mysqli_real_escape_string($koneksi, $keyword);

// Pagination setup
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Query data dengan filter pencarian + limit untuk pagination
$sql = "SELECT * FROM barang";
if (!empty($keyword_safe)) {
    $sql .= " WHERE nama_barang LIKE '%$keyword_safe%'";
}
$sql .= " LIMIT $start, $limit"; // PENTING: pakai LIMIT untuk pagination

// eksekusi query
$dataBarang = mysqli_query($koneksi, $sql);

// Hitung total data untuk pagination
$sqlTotal = "SELECT COUNT(*) AS total FROM barang";
if (!empty($keyword_safe)) {
    $sqlTotal .= " WHERE nama_barang LIKE '%$keyword_safe%'";
}
$resultTotal = mysqli_query($koneksi, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalPages = ceil($rowTotal['total'] / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h1>Data Barang</h1>

    <!-- Tombol tambah data -->
    <a href="tambah.php" class="btn">+ Tambah Barang</a>

    <!-- FORM PENCARIAN -->
    <form method="GET" style="margin:15px 0;">
        <input type="text" name="keyword" 
               placeholder="Cari nama barang..."
               value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit" class="btn">Cari</button>
    </form>

    <!-- TABEL DATA -->
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>

        <?php $no = $start + 1; ?>
        <?php while($row = mysqli_fetch_assoc($dataBarang)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>
                <img src="../assets/img/barang/<?= $row['gambar'] ?>" width="60">
            </td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td><?= htmlspecialchars($row['kategori']) ?></td>
            <td><?= $row['stok'] ?></td>
            <td>Rp <?= number_format($row['harga']) ?></td>
            <td><?= htmlspecialchars($row['satuan']) ?></td>
            <td>
               <a href="edit.php?id=<?= $row['id_barang']; ?>" class="btn-edit">Edit</a>
               <a href="hapus.php?id=<?= $row['id_barang']; ?>" class="btn-hapus"
                  onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- PAGINATION -->
<div class="pagination">
    <?php if($page > 1): ?>
        <a href="?page=<?= $page-1 ?>&keyword=<?= urlencode($keyword) ?>">Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if($page < $totalPages): ?>
        <a href="?page=<?= $page+1 ?>&keyword=<?= urlencode($keyword) ?>">Next</a>
    <?php endif; ?>
</div>



    <br>
    <!-- Tombol Logout -->
    <a href="../auth/logout.php" class="btn">Logout</a>

</div>

</body>
</html>
```
Kode ini membuat halaman data barang dengan fitur Pencarian dan Pagination. PHP mengambil keyword dari form, membersihkannya dari ```SQL Injection```, lalu menghitung galaman dan data perhalaman. ```Query``` di jalankan untuk menampilkan data barang sesuai keyword dan halaman saat ini, serta menghitung total halaman untuk pagination. Pada bagian HTML, ada tombol "Tambah Barang", form pencarian, dan tabel yang menampilkan nomor, gambar, nama, kategori, stok, harga, satuan serta button edit dan hapus untuk tiap barang. Di bawah tabel ada navigasi pagination untuk berpindah halaman, dan ada button Logout untuk keluar dari sistem. 

Berikut hasil dari Browser 
1. halaman pertama
   <img width="787" height="613" alt="Screenshot 2026-01-10 153506" src="https://github.com/user-attachments/assets/5d8049e4-13cc-44d7-bba9-02c502555c2d" />

2. halaman kedua
   <img width="772" height="614" alt="Screenshot 2026-01-10 153521" src="https://github.com/user-attachments/assets/711555ab-2d79-4287-b773-11952e59d040" />

# 2. MEMBUAT FILE TAMBAH 
```
<?php
include "../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $stok     = $_POST['stok'];
    $harga    = $_POST['harga'];
    $satuan   = $_POST['satuan'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../assets/img/barang/" . $gambar);

    mysqli_query(
        $koneksi,
        "INSERT INTO barang 
        (gambar, nama_barang, kategori, stok, harga, satuan)
        VALUES
        ('$gambar','$nama','$kategori','$stok','$harga','$satuan')"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Tambah Data Barang</h2>

    <form method="post" enctype="multipart/form-data">

        <input type="file" name="gambar" required>

        <input type="text" name="nama"
               placeholder="Nama Barang" required>

        <input type="text" name="kategori"
               placeholder="Kategori" required>

        <input type="number" name="stok"
               placeholder="Stok" required>

        <input type="number" name="harga"
               placeholder="Harga" required>

        <input type="text" name="satuan"
               placeholder="PCS / Box" required>

        <button type="submit" name="simpan" class="btn">Simpan</button>
        <a href="index.php" class="btn">Kembali</a>

    </form>
</div>

</body>
</html>
```
Kode ini adalah halaman untuk menambahkan data barang baru ke database. Di bagian PHP, pertama di include file koneksi agar bisa mengakses database. Kemudian di cek dengan menekan tombol simpan. Jika iya, data dari form seperti nama barang. Kategori, stok, harga, dan satuan di ambil dari ```$_post```. Untuk gambar digunakan ```$_files['gambar']``` nama file  gambar disimpan di ```$gambar```  dan file sementara di ```$tmp```. Fungsi ```move_uploaded_file($tmp,"../assests/img/barang/".$gambar) memindahkan file dari folder sementara ke folder ```assets/img/barang/. Setelah semua selesai, dijalankan query ```insert into``` untuk menyimpan informasi barang beserta nama file gambarnya ke tabel ```barang```. Jika berhasil, halaman akan diarahkan kembali ke daftar barang ```(index.php)```.  

Pada bagian HTML, terdapat form dengan ```enctype="multipart/form-data" agar bisa mengunggah file gambar. Form ini memiliki input untuk gambar, nama, kategori, stok, harga, dan satuan. Terdapat button "simpan" untuk mengirim data ke server dan button "kembali" untuk kembali ke halaman daftar barang. 

Berikut hasil pada Browser 
<img width="1352" height="434" alt="Screenshot 2026-01-10 153846" src="https://github.com/user-attachments/assets/68473c90-f932-4cad-8f58-139d60d976cf" />

# 3. MEMBUAT FILE EDIT 
```
<?php
session_start();
include "../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM barang WHERE id_barang='$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan");
}

if (isset($_POST['update'])) {
    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $stok     = $_POST['stok'];
    $harga    = $_POST['harga'];
    $satuan   = $_POST['satuan'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../assets/img/barang/" . $gambar);
    } else {
        $gambar = $data['gambar'];
    }

    mysqli_query(
        $koneksi,
        "UPDATE barang SET
            gambar='$gambar',
            nama_barang='$nama',
            kategori='$kategori',
            stok='$stok',
            harga='$harga',
            satuan='$satuan'
        WHERE id_barang='$id'"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Edit Data Barang</h2>

   <form method="post" enctype="multipart/form-data">

    <div class="form-edit">

        <!-- KIRI: FOTO -->
        <div class="foto">
            <img src="../assets/img/barang/<?= $data['gambar'] ?>">
            <input type="file" name="gambar">
        </div>

        <!-- KANAN: DATA -->
        <div class="input-group">

            <input type="text" name="kategori"
                   value="<?= htmlspecialchars($data['kategori']) ?>"
                   placeholder="Kategori" required>

            <input type="text" name="nama"
                   value="<?= htmlspecialchars($data['nama_barang']) ?>"
                   placeholder="Nama Barang" required>

            <input type="number" name="stok"
                   value="<?= $data['stok'] ?>"
                   placeholder="Stok" required>

            <input type="number" name="harga"
                   value="<?= $data['harga'] ?>"
                   placeholder="Harga" required>

            <input type="text" name="satuan"
                   value="<?= htmlspecialchars($data['satuan']) ?>"
                   placeholder="PCS / Satuan" required>

            <div class="actions">
                <button type="submit" name="update" class="btn">Update</button>
                <a href="index.php" class="btn">Kembali</a>
            </div>

        </div>

    </div>

</form>

</div>

</body>
</html>
```
Kode ini membuat halam untuk mengedit data barang yang sudah ada di database. Jika pengguna mengunggah gambar baru, file akan dipindahkan ke folder ```assets/img/barang/``` jika tidak, gambar lama akan tetap digunakan. Kemudian dijalankan query ```update``` untuk memperbarui data barang di database sesuai ID. Setelah update, halaman diarahkan kembali ke daftar barang ```(index.php)```. 

Berikut hasil dari Browser

<img width="1048" height="466" alt="Screenshot 2026-01-10 153920" src="https://github.com/user-attachments/assets/b5f36f51-fac2-48e6-ad55-92b68bab14e0" />

# 4. MEMBUAT FILE HAPUS 
```
<?php
include "../config/koneksi.php";

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = $_GET['id'];

/* Ambil data gambar */
$query = mysqli_query(
    $koneksi,
    "SELECT gambar FROM barang WHERE id_barang='$id'"
);

$data = mysqli_fetch_assoc($query);

/* Hapus file gambar jika ada */
if ($data && !empty($data['gambar'])) {
    $file = "../assets/img/barang/" . $data['gambar'];
    if (file_exists($file)) {
        unlink($file);
    }
}

/* Hapus data dari database */
mysqli_query(
    $koneksi,
    "DELETE FROM barang WHERE id_barang='$id'"
);

header("Location: index.php");
exit;
```
Kode ini adalah menghapus data barang beserta gambarnya dari sistem. Jika ada gambar yang terkait, script memeriksa apakah file tersebut ada di folder ```assets/img/barang/. Jika ada, file dihapus menggunakan ```unlink()```. Setelah itu, data barang dihapus dari database dengan query ```delete```. 

Berikut hasil Browser 
<img width="992" height="539" alt="Screenshot 2026-01-10 153937" src="https://github.com/user-attachments/assets/f95b1e25-784b-4d3b-a584-5c30c4c85cf7" />


# MEMBUAT FOLDER USERS
Membuat folder baru di VSCode, dengan file yang berada didalamnya sebagai berikut:

# 1. MEMBUAT FILE BELI 
```
<?php
session_start();
include "../config/koneksi.php";

$dataBarang = mysqli_query($koneksi, "SELECT * FROM barang");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Beli Barang</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
<h2>Daftar Barang</h2>

<table>
<tr>
    <th>Gambar</th>
    <th>Nama</th>
    <th>Kategori</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Satuan</th>
    <th>Beli</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($dataBarang)) : ?>
<tr>
    <td>
        <img src="../assets/img/barang/<?= $row['gambar'] ?>" width="60">
    </td>
    <td><?= $row['nama_barang'] ?></td>
    <td><?= $row['kategori'] ?></td>
    <td>Rp <?= number_format($row['harga']) ?></td>
    <td><?= $row['stok'] ?></td>
    <td><?= $row['satuan'] ?></td>
    <td>
    <form action="transaksi.php" method="post">
        <input type="hidden" name="id_barang" value="<?= $row['id_barang'] ?>">
        <input type="number" name="jumlah"
               min="1" max="<?= $row['stok'] ?>" required>
        <button type="submit" class="btn">Beli</button>
    </form>
</td>

</tr>
<?php endwhile; ?>
</table>

<br>
    <!-- Tombol Logout -->
    <a href="../auth/logout.php" class="btn">Logout</a>

</body>
</html>
```
Kode ini menampilkan daftar barang yang bisa dibeli. Pada bagian HTML, tabel menampilkan tiap barang dengan kolom gambar, nama, kategori, harga, stok, satuan dan button beli. Untuk setiap barang, ada form kecil yang memungkinkan pengguna memilih jumlah barang yang ingin dibeli ```(<input type="number">)``` dengan bataas maksimal sesuai stok. Form ini mengirim data ```id_barang``` dan ```jumlah``` ke ```transaksi.php```saat tombol beli pencet. 

Berikut hasil pada Browser
<img width="1049" height="544" alt="Screenshot 2026-01-10 154035" src="https://github.com/user-attachments/assets/ebebb41c-23c7-4317-b8c7-e035b2293eaf" />

# 2. MEMBUAT LINK EVENT 
```
<!DOCTYPE html>
<html>
<head>
    <title>Event Promo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Event Promo</h2>

    <ul style="margin-top:20px; font-size:16px; line-height:1.8;">
        <li>🎉 Diskon 10% pembelian di atas Rp100.000</li>
        <li>🎁 Gratis pulpen untuk pembelian buku tulis</li>
        <li>🔥 Promo akhir bulan</li>
    </ul>

    <br>
    <a href="beli.php" class="btn">Kembali</a>
</div>

</body>
</html>
```
Kode ini membuat halaman Event Promo yang menampilkan daftar promo atau penawaran khusus. Halaman menampilkan judul "Event Promo" dan beberapa item promo dalam bentuk daftra, seperti diskon, hadiah gratis, atau promo akhir bulan. Di bagian bawah ada button kembali yang mengarahkan pengguna kembali ke halaman beli barang. 

Berikut Hasil Browsernya 
<img width="1163" height="430" alt="Screenshot 2026-01-10 153359" src="https://github.com/user-attachments/assets/ec7bd49a-c7f7-43f4-8a36-7938c35650fb" />

# 3. MEMBUAT FILE TRANSAKSI 
```
<?php
session_start();
include "../config/koneksi.php";

if (!isset($_POST['id_barang']) || !isset($_POST['jumlah'])) {
    die("Data transaksi tidak lengkap");
}

$idBarang = $_POST['id_barang'];
$jumlah   = $_POST['jumlah'];

/* Ambil data barang */
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM barang WHERE id_barang='$idBarang'"
);

$barang = mysqli_fetch_assoc($query);

if (!$barang) {
    die("Barang tidak ditemukan");
}

/* Cek stok */
if ($jumlah > $barang['stok']) {
    die("Stok tidak mencukupi");
}

/* Hitung total */
$total = $barang['harga'] * $jumlah;

/* Simpan transaksi */
mysqli_query(
    $koneksi,
    "INSERT INTO transaksi 
    (nama_barang, jumlah, harga, total)
    VALUES
    ('{$barang['nama_barang']}', '$jumlah', '{$barang['harga']}', '$total')"
);

/* Update stok */
$stokBaru = $barang['stok'] - $jumlah;
mysqli_query(
    $koneksi,
    "UPDATE barang SET stok='$stokBaru' WHERE id_barang='$idBarang'"
);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Transaksi Berhasil</h2>

    <p><b>Nama Barang:</b> <?= $barang['nama_barang'] ?></p>
    <p><b>Jumlah:</b> <?= $jumlah ?> <?= $barang['satuan'] ?></p>
    <p><b>Total Bayar:</b> Rp <?= number_format($total) ?></p>

    <a href="beli.php" class="btn">Kembali Belanja</a>
</div>

</body>
</html>
```
Kode ini memproses pembelian barang. PHP mengecek data barang dan jumlah, memastikan stok cukup, lalu menghitung total, menyiapkan transaksi ke database, dan mengurangi stok barang. Halaman menampilkan konfirmasi transaksi dengan nama barang, jumlah, satuan, dan total barang, serta button kembali belanja. 

Berikut hasil pada browser
<img width="1222" height="370" alt="Screenshot 2026-01-10 154119" src="https://github.com/user-attachments/assets/51f6eb68-136c-438e-9ed4-ef28f969e4d2" />




