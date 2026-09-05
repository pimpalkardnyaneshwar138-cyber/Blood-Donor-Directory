<?php
require_once "config.php";

$result = mysqli_query($conn, "SELECT id, donor_name, blood_group, city, contact, availability FROM donors ORDER BY id DESC");
$status = $_GET["status"] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php"><span class="brand-icon">♥</span> Blood Donor Directory</a>
        <nav><a href="index.php">Home</a><a href="index.php#register">Register</a><a class="active" href="view.php">Donors</a><a href="search.php">Find Donor</a></nav>
    </div>
</header>

<main class="section">
<div class="container">
    <div class="page-title">
        <div><span class="eyebrow">DATABASE RECORDS</span><h1>Donor Directory</h1><p>Registered demo/sample donor records.</p></div>
        <a class="btn btn-primary" href="index.php#register">+ Register Donor</a>
    </div>

    <?php if ($status === "added"): ?><div class="alert success">Donor record added successfully.</div><?php endif; ?>
    <?php if ($status === "updated"): ?><div class="alert success">Donor record updated successfully.</div><?php endif; ?>
    <?php if ($status === "deleted"): ?><div class="alert success">Donor record deleted successfully.</div><?php endif; ?>

    <div class="table-card">
        <div class="table-wrap">
        <table>
            <thead><tr><th>ID</th><th>Name</th><th>Blood Group</th><th>City</th><th>Contact</th><th>Availability</th><th>Actions</th></tr></thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= (int)$row["id"] ?></td>
                    <td><?= htmlspecialchars($row["donor_name"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><span class="blood"><?= htmlspecialchars($row["blood_group"], ENT_QUOTES, "UTF-8") ?></span></td>
                    <td><?= htmlspecialchars($row["city"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><?= htmlspecialchars($row["contact"], ENT_QUOTES, "UTF-8") ?></td>
                    <td><span class="status <?= $row["availability"] === "Available" ? "available" : "unavailable" ?>"><?= htmlspecialchars($row["availability"], ENT_QUOTES, "UTF-8") ?></span></td>
                    <td class="actions">
                        <a href="update.php?id=<?= (int)$row["id"] ?>">Edit</a>
                        <a class="danger-link" href="delete.php?id=<?= (int)$row["id"] ?>" onclick="return confirm('Delete this demo record?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
</main>
<footer><div class="container">Blood Donor Directory • Academic Mini Project</div></footer>
</body>
</html>