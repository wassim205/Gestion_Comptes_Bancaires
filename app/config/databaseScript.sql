
CREATE DATABASE GestionComptesBancaires;
USE GestionComptesBancaires;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client') NOT NULL DEFAULT 'client',
    profile_pic VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    account_type ENUM('courant', 'epargne') NOT NULL,
    balance DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    transaction_type ENUM('depot', 'retrait', 'transfert') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    beneficiary_account_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE,
    FOREIGN KEY (beneficiary_account_id) REFERENCES accounts(id) ON DELETE SET NULL
);


INSERT INTO `users` ( `name`, `email`, `password`, `role`, `created_at` , `updated_at`) VALUES
('admin', 'admin@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'admin',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
('user1', 'user1@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'client',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
('user2', 'user2@gmail.com', '$2y$10$0oT/LEQ1k.knep9Xf5K.S.CiVhShih6jvwDbQFvW4Pzui5AKnzzMS', 'client',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);



