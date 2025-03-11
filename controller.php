<?php
require 'books.php';

$categories = getKategori();

$book = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $books = listBuku();
    
    foreach ($books as $b) {
        if ($b['id'] == $id) {
            $book = $b;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-5"><?= $book ? "Edit Buku" : "Tambah Buku" ?></h2>
        <form method="post" action="index.php">
            <input type="hidden" name="id" value="<?= $book['id'] ?? '' ?>">

            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($book['title'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($book['author'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label>Tahun Terbit</label>
                <input type="number" name="year" class="form-control" value="<?= $book['published_year'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label>Genre</label>
                <input type="text" name="genre" class="form-control" value="<?= htmlspecialchars($book['genre'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= ($book && $book['id_kategori'] == $category['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success"><?= $book ? "Simpan Perubahan" : "Tambah Buku" ?></button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
