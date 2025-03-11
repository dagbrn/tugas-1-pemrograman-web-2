<?php
require 'db.php';

function listBuku() {
    global $pdo;
    $query = $pdo->query("SELECT books.*, categories.name AS kategori FROM books LEFT JOIN categories ON books.id_kategori = categories.id ORDER BY books.id ASC");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getKategori() {
    global $pdo;
    $query = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function tambahKategori($nama) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$nama]);
}

function tambahBuku($title, $author, $year, $genre, $id_kategori) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO books (title, author, published_year, genre, id_kategori) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $year, $genre, $id_kategori]);
}

function updateBuku($id, $title, $author, $year, $genre, $id_kategori) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE books SET title=?, author=?, published_year=?, genre=?, id_kategori=? WHERE id=?");
    $stmt->execute([$title, $author, $year, $genre, $id_kategori, $id]);
}

function deleteBuku($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$id]);
}
?>