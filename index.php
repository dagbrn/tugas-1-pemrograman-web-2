<?php
require 'books.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['namaKategori'])) {

        tambahKategori($_POST['namaKategori']);
    } else {

        $id = $_POST['id'] ?? null;
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $id_kategori = $_POST['id_kategori'] ?: null;

        if ($id) {
            updateBuku($id, $title, $author, $year, $genre, $id_kategori);
        } else {
            tambahBuku($title, $author, $year, $genre, $id_kategori);
        }
    }

    header("Location: index.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    if ($id) {
        deleteBuku($id);
    }

    header("Location: index.php");
    exit;
}



$books = listBuku();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-5">Manajemen Buku</h2>
    <div class="d-flex mb-3">
        <a href="controller.php" class="btn btn-primary me-2">Tambah Buku</a>
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Tambah Kategori</button>
    </div>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"> 
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="namaKategori" name="namaKategori" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Genre</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book['id'] ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= $book['published_year'] ?></td>
                    <td><?= htmlspecialchars($book['genre']) ?></td>
                    <td><?= htmlspecialchars($book['kategori'] ?? 'Tanpa Kategori') ?></td>
                    <td>
                        <a href="controller.php?id=<?= $book['id'] ?>&title=<?= urlencode($book['title']) ?>&author=<?= urlencode($book['author']) ?>&year=<?= $book['published_year'] ?>&genre=<?= urlencode($book['genre']) ?>&id_kategori=<?= $book['id_kategori'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?delete=<?= $book['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                        </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
