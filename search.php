<?php
require_once "config.php";

$blood_group = trim($_GET["blood_group"] ?? "");
$city = trim($_GET["city"] ?? "");
$results = null;

$valid_groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

if ($blood_group !== "" && !in_array($blood_group, $valid_groups, true)) {
    $blood_group = "";
}
if ($city !== "" && !preg_match("/^[A-Za-z .'-]{1,50}$/", $city)) {
    $city = "";
}

if ($blood_group !== "" && $city !== "") {
    $stmt = mysqli_prepare($conn, "SELECT id, donor_name, blood_group, city, contact, availability FROM donors WHERE blood_group = ? AND city LIKE ? ORDER BY id DESC");
    $city_param = "%" . $city . "%";
    mysqli_stmt_bind_param($stmt, "ss", $blood_group, $city_param);
} elseif ($blood_group !== "") {
    $stmt = mysqli_prepare($conn, "SELECT id, donor_name, blood_group, city, contact, availability FROM donors WHERE blood_group = ? ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt, "s", $blood_group);
} elseif ($city !== "") {
    $stmt = mysqli_prepare($conn, "SELECT id, donor_name, blood_group, city, contact, availability FROM donors WHERE city LIKE ? ORDER BY id DESC");
    $city_param = "%" . $city . "%";
    mysqli_stmt_bind_param($stmt, "s", $city_param);
} else {
    $stmt = mysqli_prepare($conn, "SELECT id, donor_name, blood_group, city, contact, availability FROM donors ORDER BY id DESC");
}

mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Donor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php"><span class="brand-icon">♥</span> Blood Donor Directory</a>
        <nav><a href="index.php">Home</a><a href="index.php#register">Register</a><a href="view.php">Donors</a><a class="active" href="search.php">Find Donor</a></nav>
    </div>
</header>

<main class="section">
<div class="container">
    <div class="section-heading left">
        <span class="eyebrow">SEARCH / FILTER</span>
        <h1>Find a Donor</h1>
        <p>Search demo records by blood group and city.</p>
    </div>

    <form class="card search-card" method="get" action="search.php">
        <div class="form-grid search-grid">
            <div class="field">
                <label for="blood_group">Blood Group</label>
                <select id="blood_group" name="blood_group">
                    <option value="">All groups</option>
                    <?php foreach ($valid_groups as $group): ?>
                        <option value="<?= htmlspecialchars($group) ?>" <?= $blood_group === $group ? "selected" : "" ?>><?= htmlspecialchars($group) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="city">City</label>
                <input id="city" name="city" type="text" maxlength="50" pattern="[A-Za-z .'-]{1,50}" value="<?= htmlspecialchars($city, ENT_QUOTES, "UTF-8") ?>" placeholder="e.g. Pune">
            </div>
            <div class="field search-button"><label>&nbsp;</label><button class="btn btn-primary" type="submit">Search Donors</button></div>
        </div>
    </form>

    <div class="table-card">
        <div class="table-wrap">
        <table>
            <thead><tr><th>Name</th><th>Blood Group</th><th>City</th><th>Contact</th><th>Availability</th></tr></thead>
            <tbody>
            <?php $count = 0; while ($row = mysqli_fetch_assoc($results)): $count++; ?>
                <tr>
                    <td><?= htmlspecialchars($row["donor_name"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><span class="blood"><?= htmlspecialchars($row["blood_group"], ENT_QUOTES, "UTF-8") ?></span></td>
                    <td><?= htmlspecialchars($row["city"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($row["contact"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><span class="status <?= $row["availability"] === "Available" ? "available" : "unavailable" ?>"><?= htmlspecialchars($row["availability"], ENT_QUOTES, "UTF-8") ?></span></td>
                </tr>
            <?php endwhile; ?>
            <?php if ($count === 0): ?><tr><td colspan="5" class="empty">No matching donor records found.</td></tr><?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
</main>
<footer><div class="container">Blood Donor Directory • Academic Mini Project</div></footer>
</body>
</html>