-- creacion de la base de datos
CREATE DATABASE ola_ke_hace_xela;

-- uso de la base de datos creada
USE ola_ke_hace_xela;

-- Tabla de roles de usuario
CREATE TABLE user_role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

-- Tabla de usuarios
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    cui VARCHAR(13) UNIQUE NOT NULL,
    name VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    automatically_post BOOLEAN DEFAULT FALSE,
    updated_at timestamp,
    created_at timestamp,
    FOREIGN KEY (role_id) REFERENCES user_role(id)
);

-- Tabla de categorías de publicaciones
CREATE TABLE post_category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

-- Tabla de publicaciones
CREATE TABLE post (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title TEXT NOT NULL,
    place TEXT NOT NULL,
    description TEXT NOT NULL,
    start_date_time DATETIME NOT NULL,
    end_date_time DATETIME NOT NULL,
    capacity_limit INT NOT NULL,
    category_id INT NOT NULL,
    post_strike_count INT DEFAULT 0,
    approved BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (category_id) REFERENCES post_category(id)
);

-- Tabla de reportes
CREATE TABLE report (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Tabla de notificaciones
CREATE TABLE notification (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    already_read BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Tabla de asistencias
CREATE TABLE attendance (
    user_id INT,
    post_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, post_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (post_id) REFERENCES post(id)
);

-- Tabla de publicaciones aprobadas
CREATE TABLE approved_post (
    post_id INT NOT NULL,
    approved_by INT NOT NULL,
    approved_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (approved_by, post_id),
    FOREIGN KEY (post_id) REFERENCES post(id),
    FOREIGN KEY (approved_by) REFERENCES user(id)
);
