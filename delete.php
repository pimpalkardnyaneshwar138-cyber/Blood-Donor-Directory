<?php
require_once "config.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header("Location: view.php");
    exit;
}

$stmt = mysqli_prepare($conn, "DELETE FROM donors WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: view.php?status=deleted");
exit;
?>