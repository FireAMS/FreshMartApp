<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop</title>
</head>
<body>
    <h1>Welcome to FreshMart Shop</h1>

    <h2>🍎 Fruits</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Name</th><th>Category</th><th>Season</th>
        </tr>
        <?php
            $json = file_get_contents('http://fruit-service');
            $obj = json_decode($json);
            foreach ($obj->fruits as $fruit) {
                echo "<tr>";
                echo "<td>{$fruit->name}</td>";
                echo "<td>{$fruit->category}</td>";
                echo "<td>{$fruit->season}</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <h2>🥦 Vegetables</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Name</th><th>Category</th><th>Season</th>
        </tr>
        <?php
            $json = file_get_contents('http://vegetable-service/vegetables');
            $obj = json_decode($json);
            foreach ($obj->vegetables as $veg) {
                echo "<tr>";
                echo "<td>{$veg->name}</td>";
                echo "<td>{$veg->category}</td>";
                echo "<td>{$veg->season}</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>