<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Product Cards</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Add the CSS from the earlier example here */
        .slider_img {
            width: 100%;
        }

        .slider_img > img {
            width: 450px;
            margin-left: 120px;
        }

        .product-card-container {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            background-color: #fff;
            border-radius: 4px;
            width: 234px;
            margin: 20px auto;
            padding: 16px;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .product-details-container {
            display: flex;
            flex-direction: column;
            row-gap: 4px;
        }

        .product-card-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .img-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .product-details-container .product {
            font-size: 1rem;
            font-weight: bold;
            color: #555;
            text-transform: capitalize;
        }

        .product-details-container .description {
            font-size: 12px;
            color: #000;
            max-height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .ratings {
            display: inline-flex;
            align-items: center;
            line-height: normal;
            color: #fff;
        }

        .star {
            background-color: #388e3c;
            padding: 2px 4px 2px 6px;
            border-radius: 3px;
            font-weight: 500;
            font-size: 12px;
            width: fit-content;
            gap: 4px;
        }

        .ratings i {
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            border: none;
            outline: none;
        }

        .peoples-rated {
            padding-left: 8px;
            font-weight: bold;
            color: #878787;
        }

        .price {
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            color: #212121;
        }

        .buy-now-button {
            display: inline-block;
            margin-top: 12px;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            background-color: #388e3c;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .buy-now-button:hover {
            background-color: #2e7d32;
        }

        .buy-now-button:active {
            background-color: #256a27;
        }

        @media (max-width: 600px) {
            .product-card-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="product-cards">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ecommerce"; // Replace with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch products from database
        $sql = "SELECT name, description, image, rating, reviews, price FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card-container">';
                echo '    <div class="img-container">';
                echo '        <img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '    </div>';
                echo '    <div class="product-details-container">';
                echo '        <div class="product">' . $row['name'] . '</div>';
                echo '        <div class="description">' . $row['description'] . '</div>';
                echo '        <div class="ratings">';
                echo '            <div class="star">';
                echo '                <span>' . $row['rating'] . '</span> <i class="far fa-star"></i>';
                echo '            </div>';
                echo '            <div><span class="peoples-rated">(' . $row['reviews'] . ')</span></div>';
                echo '        </div>';
                echo '        <div class="price">' . $row['price'] . '</div>';
                echo '        <button class="buy-now-button">Buy Now</button>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }

        // Close connection
        $conn->close();
        ?>
    </div>
</body>
</html>
