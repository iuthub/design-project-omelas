<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array();
$newresponse = array();
$lastresponse = array();


    // receiving the post params


    // get the user by userID and password
    $products = $db->getProducts();


    if ($products != false) {
        // use is found
        while ($prod = $products->fetch_assoc()) {
          $response["error"] = FALSE;
          $response["id"] = $prod["id"];
          $response["name"] = $prod["name"];
          $response["description"] = $prod["description"];
          $response["size"] = $prod["size"];
          $response["price"] = $prod["price"];
          $response["old_price"] = $prod["old_price"];
          $response["category_id"] = $prod["category_id"];
          $response["created_at"] = $prod["created_at"];
          $response["updated_at"] = $prod["updated_at"];

          array_push($newresponse, $response);

        }

        array_push($lastresponse, $newresponse);
        echo json_encode($lastresponse);
    } else {

        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }

?>
