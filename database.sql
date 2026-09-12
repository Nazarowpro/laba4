-- ============================================
-- База данных интернет-магазина TechShop
-- Лабораторная работа №4
-- ============================================

CREATE DATABASE IF NOT EXISTS techshop
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE techshop;

-- Таблица товаров, которые отображаются на сайте
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    old_price DECIMAL(10,2) DEFAULT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Таблица данных из формы обратной связи
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Начальные данные
INSERT INTO products (name, category, price, old_price, description) VALUES
('Процессор AMD Ryzen 7 7800X3D', 'Процессоры', 45990, 52990, '8 ядер / 16 потоков, до 5.0 ГГц, 96 МБ L3'),
('Процессор Intel Core i5-14600KF', 'Процессоры', 32990, NULL, '14 ядер / 20 потоков, до 5.3 ГГц, LGA1700'),
('Видеокарта NVIDIA RTX 4070 12GB', 'Видеокарты', 69990, 78990, '12 ГБ GDDR6X, DLSS 3, трассировка лучей'),
('Видеокарта AMD RX 7800 XT 16GB', 'Видеокарты', 54990, NULL, '16 ГБ GDDR6, RDNA 3, 1440p Ultra'),
('Оперативная память Kingston Fury 32GB DDR5', 'Оперативная память', 12990, 15490, '2x16 ГБ, 6000 МГц, CL36, RGB'),
('SSD Samsung 990 Pro 1TB', 'Накопители', 9990, NULL, 'NVMe M.2, PCIe 4.0, до 7450 МБ/с'),
('Ноутбук ASUS TUF Gaming A15', 'Ноутбуки', 89990, 99990, 'Ryzen 7 7735HS, RTX 4060, 16 ГБ, 512 ГБ'),
('Ноутбук Lenovo IdeaPad Slim 3', 'Ноутбуки', 44990, NULL, 'Ryzen 5 7520U, 16 ГБ, 512 ГБ SSD'),
('Монитор Xiaomi 27" 165Hz IPS', 'Мониторы', 18990, 21990, '2560x1440, 165 Гц, 1 мс, HDR'),
('Клавиатура Logitech G413 SE', 'Клавиатуры', 6990, NULL, 'Механические переключатели, подсветка'),
('Мышь Logitech G502 X', 'Мыши', 5990, 7490, 'HERO 25K, 25600 DPI, 13 кнопок'),
('Корпус Deepcool CC560 ARGB', 'Комплектующие', 5490, NULL, 'ATX, 4 вентилятора ARGB, tempered glass');
