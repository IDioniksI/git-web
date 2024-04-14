<?php include 'header.php'; ?>
<section id="video-section">
    <div class="text-container">
        <h2>
            Адміністрування головної сторінки
        </h2>
    </div>
    <div class="text-container">
        <p>
            На даній сторінці ви можете додавати нові піци, редагувати інформацію про ті, котрі вже існують, а також видаляти існуючі
        </p>
    </div>
</section>

<form action="" method="post">
    <input type="hidden" name="edit_id" value="">
    
    <label for="name">Назва:</label>
    <input type="text" name="name" required>
    
    <label for="description">Опис:</label>
    <textarea name="description" required></textarea>
    
    <label for="price">Ціна:</label>
    <input type="text" name="price" required>
    
    <label for="image_url">URL зображення:</label>
    <input type="text" name="image_url" required>
    
    <button type="submit">Додати/Оновити піцу</button>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzalab";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка з'єднання з базою даних: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit_id"])) {
    $edit_id = $_GET["edit_id"];
    $sql = "SELECT * FROM pizzas WHERE id = $edit_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<script>
            document.querySelector('[name=\"name\"]').value = '{$row["name"]}';
            document.querySelector('[name=\"description\"]').value = '{$row["description"]}';
            document.querySelector('[name=\"price\"]').value = '{$row["price"]}';
            document.querySelector('[name=\"image_url\"]').value = '{$row["image_url"]}';
            document.querySelector('[name=\"edit_id\"]').value = '{$edit_id}';
        </script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];
    $sql = "DELETE FROM pizzas WHERE id = $delete_id";
    $result = $conn->query($sql);

    if ($result) {
        echo "Піца успішно видалена!";
    } else {
        echo "Помилка при видаленні піци: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["edit_id"]) && !empty($_POST["edit_id"])) {
        $edit_id = $_POST["edit_id"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $image_url = $_POST["image_url"];

        $sql = "UPDATE pizzas SET name='$name', description='$description', price='$price', image_url='$image_url' WHERE id=$edit_id";
        $result = $conn->query($sql);

        if ($result) {
            echo "Піца успішно оновлена!";
        } else {
            echo "Помилка при оновленні піци: " . $conn->error;
        }
    } else {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $image_url = $_POST["image_url"];

        $sql = "INSERT INTO pizzas (name, description, price, image_url) VALUES ('$name', '$description', '$price', '$image_url')";
        $result = $conn->query($sql);

        if ($result) {
            echo "Піца успішно додана!";
        } else {
            echo "Помилка при додаванні піци: " . $conn->error;
        }
    }
}

$sql_select_all = "SELECT * FROM pizzas";
$result_all = $conn->query($sql_select_all);

if ($result_all->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Назва</th><th>Опис</th><th>Ціна</th><th>Зображення</th><th>Дії</th></tr>";

    while ($row_all = $result_all->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_all["name"] . "</td>";
        echo "<td>" . $row_all["description"] . "</td>";
        echo "<td>" . $row_all["price"] . "</td>";
        echo "<td><img src='" . $row_all["image_url"] . "' alt='Pizza Image' width='100'></td>";
        echo "<td>
                <a href='?edit_id=" . $row_all["id"] . "'>Редагувати</a> | 
                <a href='?delete_id=" . $row_all["id"] . "' onclick='return confirm(\"Ви впевнені?\")'>Видалити</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Немає записів в базі даних.";
}

$conn->close();
?>

<?php include 'footer.php'; ?>