<?php
require_once "config.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header("Location: view.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $donor_name = trim($_POST["donor_name"] ?? "");
    $blood_group = trim($_POST["blood_group"] ?? "");
    $city = trim($_POST["city"] ?? "");
    $contact = trim($_POST["contact"] ?? "");
    $availability = trim($_POST["availability"] ?? "");

    $valid_groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];
    $valid_availability = ["Available", "Unavailable"];

    if (!$id || !preg_match("/^[A-Za-z .'-]{2,100}$/", $donor_name) ||
        !in_array($blood_group, $valid_groups, true) ||
        !preg_match("/^[A-Za-z .'-]{2,50}$/", $city) ||
        !preg_match("/^[0-9]{10,15}$/", $contact) ||
        !in_array($availability, $valid_availability, true)) {
        die("Invalid input.");
    }

    $stmt = mysqli_prepare($conn, "UPDATE donors SET donor_name=?, blood_group=?, city=?, contact=?, availability=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $donor_name, $blood_group, $city, $contact, $availability, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: view.php?status=updated");
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id, donor_name, blood_group, city, contact, availability FROM donors WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    die("Record not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Donor</title><link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar"><div class="container nav-inner">
<a class="brand" href="index.php"><span class="brand-icon">♥</span> Blood Donor Directory</a>
<nav><a href="index.php">Home</a><a href="index.php#register">Register</a><a class="active" href="view.php">Donors</a><a href="search.php">Find Donor</a></nav>
</div></header>

<main class="section"><div class="container narrow">
<div class="section-heading left"><span class="eyebrow">UPDATE RECORD</span><h1>Edit Donor</h1><p>Update the selected demo record.</p></div>
<form class="card form-card" method="post" action="update.php">
<input type="hidden" name="id" value="<?= (int)$row["id"] ?>">
<div class="form-grid">
<div class="field full"><label for="donor_name">Donor Name</label><input id="donor_name" name="donor_name" type="text" maxlength="100" pattern="[A-Za-z .'-]{2,100}" value="<?= htmlspecialchars($row["donor_name"], ENT_QUOTES, "UTF-8") ?>" required></div>
<div class="field"><label for="blood_group">Blood Group</label><select id="blood_group" name="blood_group" required>
<?php foreach (["A+","A-","B+","B-","AB+","AB-","O+","O-"] as $g): ?><option <?= $row["blood_group"] === $g ? "selected" : "" ?>><?= $g ?></option><?php endforeach; ?>
</select></div>
<div class="field"><label for="city">City</label><input id="city" name="city" type="text" maxlength="50" pattern="[A-Za-z .'-]{2,50}" value="<?= htmlspecialchars($row["city"], ENT_QUOTES, "UTF-8") ?>" required></div>
<div class="field"><label for="contact">Contact (Demo)</label><input id="contact" name="contact" type="tel" maxlength="15" pattern="[0-9]{10,15}" value="<?= htmlspecialchars($row["contact"], ENT_QUOTES, "UTF-8") ?>" required></div>
<div class="field"><label for="availability">Availability</label><select id="availability" name="availability" required><option value="Available" <?= $row["availability"] === "Available" ? "selected" : "" ?>>Available</option><option value="Unavailable" <?= $row["availability"] === "Unavailable" ? "selected" : "" ?>>Unavailable</option></select></div>
</div>
<button class="btn btn-primary btn-wide" type="submit">Save Changes</button>
</form>
</div></main>
<footer><div class="container">Blood Donor Directory • Academic Mini Project</div></footer>
</body>
</html>