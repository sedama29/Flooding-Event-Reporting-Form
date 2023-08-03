<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $latitude = floatval($_POST["latitude"]);
    $longitude = floatval($_POST["longitude"]);
    $county = $_POST["county"];
    $dateFound = $_POST["dateFound"];
    $floodDepth = floatval($_POST["floodDepth"]);
    $floodType = $_POST["floodType"];
    $notes = $_POST["notes"];

    $imageUrls = array();

    for ($i = 0; $i < 3; $i++) {
        if (!empty($_FILES["photos"]["name"][$i])) {
            $targetDir = "uploads/";
            $uniqueId = uniqid(); // Generate a unique identifier
            $fileName = "photo_" . $uniqueId . "_" . date("Ymd") . "_" . $lastName . "." . pathinfo($_FILES["photos"]["name"][$i], PATHINFO_EXTENSION);
            $tmp_name = $_FILES["photos"]["tmp_name"][$i];
            $filePath = $targetDir . $fileName;
            $imageUrls[] = "geored_form/" . $filePath;
            move_uploaded_file($tmp_name, $filePath);
        } else {
            $imageUrls[] = ""; // Empty URL for spaces without uploaded images
        }
    }



    try {
        // Insert data into the database using PDO
        $pdo = new PDO('sqlite:data/geored_form.sqlite');
        if ($pdo) {
            echo "Connected to the database successfully.<br>";
        } else {
            echo "Failed to connect to the database.<br>";
        }

        $insertQuery = "INSERT INTO flood_data (first_name, last_name, email, latitude, longitude, county, flood_occurrence_date, flood_occurrence_depth, flood_occurrence_type, image_url_1, image_url_2, image_url_3, comments) VALUES (:firstName, :lastName, :email, :latitude, :longitude, :county, :dateFound, :floodDepth, :floodType, :imageUrl1, :imageUrl2, :imageUrl3, :notes)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':latitude', $latitude);
        $stmt->bindValue(':longitude', $longitude);
        $stmt->bindValue(':county', $county);
        $stmt->bindValue(':dateFound', $dateFound);
        $stmt->bindValue(':floodDepth', $floodDepth);
        $stmt->bindValue(':floodType', $floodType);
        $stmt->bindValue(':imageUrl1', $imageUrls[0]);
        $stmt->bindValue(':imageUrl2', $imageUrls[1]);
        $stmt->bindValue(':imageUrl3', $imageUrls[2]);
        $stmt->bindValue(':notes', $notes);

        if ($stmt->execute()) {
            echo "Data inserted into the database successfully.<br>";
        } else {
            echo "Error inserting data into the database.<br>";
        }

        // Close the database connection
        $pdo = null;
    } catch (PDOException $e) {
        // Handle any exceptions that occur during the database operations
        echo "Database error: " . $e->getMessage() . "<br>";
    }

    // Redirect back to the form page after successful submission
    header("Location: success_page.php"); // Replace 'success_page.php' with the actual URL of your success page
    exit();
}
?>


