<?php include 'header.php'; ?>

<div class="site-container">
    <img src="cache/favicon.svg" alt="Картинка" width="2%">
    <h2>Піца </h2>
    <p class="small-text">   Наші піци для справжніх гурманів, де зібрані кращі рецепти. Це саме та страва де сяє креативність наших піцамейкерів.</p>
</div>
<section class="pizza-section">
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pizzalab";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
	    die("Помилка з'єднання з базою даних: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM pizzas";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        echo '<div class="pizza">';
	        echo '<img src="' . $row["image_url"] . '" alt="' . $row["name"] . '">';
	        echo '<div class="pizza-details">';
	        echo '<h2>' . $row["name"] . '</h2>';
	        echo '<p class="small-text">' . $row["description"] . '</p>';
	        echo '<p class="price">від ' . $row["price"] . ' грн</p>';
	        echo '<button class="order-btn">Обрати</button>';
	        echo '</div>';
	        echo '</div>';
	    }
	} else {
	    echo "Немає результатів";
	}
	
	$conn->close();
	?>
</section>

<?php include 'footer.php'; ?>