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
