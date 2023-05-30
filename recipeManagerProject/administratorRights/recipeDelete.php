<?php
session_start();

if( isset($_SESSION['validUser'] )) {
  
}
else {
 // echo "Invalid User"; 
  header('Location: login.php'); 
}

$recipeID = $_GET['recipeID']; 


require '../../dbConnect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "DELETE FROM wdv341_recipes WHERE id=:recipeID";  

$stmt = $conn->prepare($sql);

$stmt->bindParam(':recipeID', $recipeID);

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

$numberOfRows = $stmt->rowCount(); 



//when finished return to the eventList to display the updated list of events

header('Location: recipeViewAll.php');
?>