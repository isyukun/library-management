
-- Database: perpustakaan

CREATE DATABASE IF NOT EXISTS perpustakaan;
USE perpustakaan;

-- Tabel: buku
CREATE TABLE IF NOT EXISTS buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL,
    penerbit VARCHAR(255) NOT NULL,
    tahun_terbit YEAR NOT NULL,
    jumlah INT NOT NULL
);

-- Tabel: anggota
CREATE TABLE IF NOT EXISTS anggota (
    id_anggota INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    no_hp VARCHAR(15) NOT NULL
);

-- Tabel: transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    id_anggota INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE DEFAULT NULL,
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku),
    FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
);
