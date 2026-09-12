<?php
// ==================================================
// index.php — главная страница магазина TechShop.
// Раньше это был catalog.html — теперь .php:
// подключаем script.php и выводим список товаров из БД через foreach.
// ==================================================
require 'script.php';

$products  = getProducts();
$feedbacks = getFeedbacks();

// иконка-заглушка для товара по категории
function productIcon(string $category): string
{
    $map = [
        'Процессоры'          => '💻',
        'Видеокарты'          => '🎮',
        'Оперативная память'  => '🧠',
        'Накопители'          => '💽',
        'Ноутбуки'            => '💻',
        'Мониторы'            => '🖥️',
        'Клавиатуры'          => '⌨️',
        'Мыши'                => '🖱️',
    ];
    return $map[$category] ?? '📦';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TechShop — Компьютеры и комплектующие</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ===== ШАПКА ===== -->
<header class="topbar">
    <div class="container topbar__inner">
        <span>🚚 Бесплатная доставка при заказе от 5 000 ₽</span>
        <span>📞 8-800-555-01-01</span>
    </div>
</header>

<header class="header">
    <div class="container header__inner">
        <a href="index.php" class="logo">🛒 TechShop</a>
        <form class="search" action="index.php" method="get">
            <input type="text" name="q" placeholder="Поиск товаров...">
            <button type="submit" class="btn btn--primary">Найти</button>
        </form>
        <a href="#" class="btn btn--primary">🛍️ Корзина</a>
    </div>
</header>

<nav class="nav">
    <div class="container nav__inner">
        <a href="#" class="btn btn--primary">☰ Каталог</a>
        <a href="#products">Процессоры</a>
        <a href="#products">Видеокарты</a>
        <a href="#products">Ноутбуки</a>
        <a href="#products">Мониторы</a>
        <a href="#feedback">Обратная связь</a>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="hero">
    <div class="container">
        <span class="badge">⭐ Более 10 000 товаров в наличии</span>
        <h1>Компьютеры и комплектующие</h1>
        <p>Лучшие цены на топовые процессоры, видеокарты, ноутбуки и периферию.<br>Гарантия от производителя.</p>
        <div class="hero__actions">
            <a href="#products" class="btn btn--primary">Весь каталог →</a>
            <a href="#products" class="btn btn--ghost">Ноутбуки</a>
            <a href="#products" class="btn btn--ghost">Процессоры</a>
        </div>
    </div>
</section>

<!-- ===== ПРЕИМУЩЕСТВА ===== -->
<section class="container perks">
    <div class="perk"><span class="perk__icon">🚚</span><div><b>Быстрая доставка</b><br>Доставка по всей России от 1 дня</div></div>
    <div class="perk"><span class="perk__icon">🛡️</span><div><b>Гарантия качества</b><br>Только оригинальные товары</div></div>
    <div class="perk"><span class="perk__icon">💳</span><div><b>Удобная оплата</b><br>Карта, наличные, рассрочка 0%</div></div>
    <div class="perk"><span class="perk__icon">🎧</span><div><b>Поддержка 24/7</b><br>Поможем с выбором и решим вопросы</div></div>
</section>

<!-- ===== ТОВАРЫ ИЗ БАЗЫ ДАННЫХ (foreach) ===== -->
<section class="container" id="products">
    <div class="section-head">
        <h2>Каталог товаров</h2>
        <span>Все категории →</span>
    </div>

    <div class="grid">
        <?php foreach ($products as $product): ?>
            <article class="card">
                <div class="card__img"><?= productIcon($product['category']) ?></div>
                <span class="card__cat"><?= htmlspecialchars($product['category']) ?></span>
                <h3 class="card__name"><?= htmlspecialchars($product['name']) ?></h3>
                <p class="card__desc"><?= htmlspecialchars($product['description']) ?></p>
                <div class="card__price">
                    <?php if ($product['old_price']): ?>
                        <span class="card__old"><?= number_format($product['old_price'], 0, '', ' ') ?> ₽</span>
                    <?php endif; ?>
                    <span class="card__now"><?= number_format($product['price'], 0, '', ' ') ?> ₽</span>
                </div>
                <button class="btn btn--primary card__btn">В корзину</button>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- ===== ФОРМА ОБРАТНОЙ СВЯЗИ ===== -->
<section class="container" id="feedback">
    <div class="section-head"><h2>Обратная связь</h2></div>

    <?php if (!empty($_SESSION['flash'])): ?>
        <p class="flash"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></p>
    <?php endif; ?>

    <form class="feedback-form" action="feedback.php" method="post">
        <input type="text" name="name" placeholder="Ваше имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Сообщение" rows="4" required></textarea>
        <button type="submit" class="btn btn--primary">Отправить</button>
    </form>

    <h3 class="feedback-title">Сообщения пользователей (из базы данных):</h3>
    <div class="feedback-list">
        <?php if (count($feedbacks) === 0): ?>
            <p>Пока нет сообщений — будьте первым!</p>
        <?php endif; ?>
        <?php foreach ($feedbacks as $fb): ?>
            <div class="feedback-item">
                <b><?= htmlspecialchars($fb['name']) ?></b>
                <span class="feedback-item__meta">&lt;<?= htmlspecialchars($fb['email']) ?>&gt; · <?= $fb['created_at'] ?></span>
                <p><?= nl2br(htmlspecialchars($fb['message'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<footer class="footer">
    <div class="container">© <?= date('Y') ?> TechShop — интернет-магазин компьютеров. Лабораторная работа №4.</div>
</footer>

</body>
</html>
