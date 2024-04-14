<?php include 'header.php'; ?>

<section id="video-section">
    <div class="text-container">
        <h2>
            Тут ми можемо створити картинку
        </h2>
    </div>
    <div class="text-container">
        <p>
            На даній сторінці ми можемо зробити картинку, яка випадковим чином буде генеруватись. Ми вказуємо розмір картинки, яка буде генеруватись. Далі в картинці цього розміру будуть генеруватись 3 фігури
        </p>
    </div>
</section>

<form action="script.php" method="post">
    <label for="size">Розмір (в пікселях):</label>
    <input type="text" name="size" id="size" required>
    <input type="submit" value="Створити зображення">
</form>

<div class="site-container">
    <?php
    if (isset($_GET['filename'])) {
        $filename = $_GET['filename'];
        echo "<img src=\"$filename\" alt=\"Згенероване зображення\">";
    }
?>
</div>

<?php include 'footer.php'; ?>