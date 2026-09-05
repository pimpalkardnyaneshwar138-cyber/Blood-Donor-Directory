<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$donor_name = trim($_POST["donor_name"] ?? "");
$blood_group = trim($_POST["blood_group"] ?? "");
$city = trim($_POST["city"] ?? "");
$contact = trim($_POST["contact"] ?? "");
$availability = trim($_POST["availability"] ?? "");

$valid_groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];
$valid_availability = ["Available", "Unavailable"];

if (!preg_match("/^[A-Za-z .'-]{2,100}$/", $donor_name) ||
    !in_array($blood_group, $valid_groups, true) ||
    !preg_match("/^[A-Za-z .'-]{2,50}$/", $city) ||
    !preg_match("/^[0-9]{10,15}$/", $contact) ||
    !in_array($availability, $valid_availability, true)) {
    die("Invalid input. Please return to the form and enter valid data.");
}

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO donors (donor_name, blood_group, city, contact, availability)
     VALUES (?, ?, ?, ?, ?)"
);

mysqli_stmt_bind_param($stmt, "sssss", $donor_name, $blood_group, $city, $contact, $availability);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: view.php?status=added");
exit;
?>