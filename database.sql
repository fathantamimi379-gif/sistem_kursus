CREATE DATABASE sistem_kursus;
USE sistem_kursus;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'Dosen',
    status ENUM('PENDING', 'AKTIF') DEFAULT 'PENDING',
    token VARCHAR(255) NULL,
    token_expiry DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_
        TIMESTAMP
);

CREATE TABLE mata_kuliah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_makul VARCHAR(20) NOT NULL UNIQUE,
    nama_makul VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    sks INT NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);