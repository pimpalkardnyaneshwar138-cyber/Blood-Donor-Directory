<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Directory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php"><span class="brand-icon">♥</span> Blood Donor Directory</a>
        <nav>
            <a class="active" href="index.php">Home</a>
            <a href="index.php#register">Register</a>
            <a href="view.php">Donors</a>
            <a href="search.php">Find Donor</a>
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <span class="eyebrow">DONATE • SAVE LIVES</span>
                <h1>Find a blood donor<br><span>when it matters.</span></h1>
                <p class="hero-text">A simple directory to register available blood donors and quickly search by blood group and city.</p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="index.php#register">Register as Donor</a>
                    <a class="btn btn-outline" href="search.php">Find a Donor</a>
                </div>
            </div>
            <div class="hero-card">
                <div class="drop">♥</div>
                <h3>Every donor can make a difference.</h3>
                <p>Use sample/demo information for this academic project. Do not enter real sensitive personal information.</p>
            </div>
        </div>
    </section>

    <section id="register" class="section">
        <div class="container">
            <div class="section-heading">
                <span class="eyebrow">GET STARTED</span>
                <h2>Register a Donor</h2>
                <p>Enter dummy/sample donor details for demonstration.</p>
            </div>

            <form class="card form-card" action="save.php" method="post">
                <div class="form-grid">
                    <div class="field full">
                        <label for="donor_name">Donor Name</label>
                        <input id="donor_name" name="donor_name" type="text"
                               maxlength="100" pattern="[A-Za-z .'-]{2,100}"
                               placeholder="e.g. Rahul Sharma" required>
                    </div>

                    <div class="field">
                        <label for="blood_group">Blood Group</label>
                        <select id="blood_group" name="blood_group" required>
                            <option value="">Select blood group</option>
                            <option>A+</option><option>A-</option>
                            <option>B+</option><option>B-</option>
                            <option>AB+</option><option>AB-</option>
                            <option>O+</option><option>O-</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="city">City</label>
                        <input id="city" name="city" type="text" maxlength="50"
                               pattern="[A-Za-z .'-]{2,50}"
                               placeholder="e.g. Pune" required>
                    </div>

                    <div class="field">
                        <label for="contact">Contact (Demo)</label>
                        <input id="contact" name="contact" type="tel"
                               maxlength="15" pattern="[0-9]{10,15}"
                               placeholder="10–15 digit demo number" required>
                    </div>

                    <div class="field">
                        <label for="availability">Availability</label>
                        <select id="availability" name="availability" required>
                            <option value="">Select availability</option>
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary btn-wide" type="submit">Register Donor</button>
            </form>
        </div>
    </section>

    <section class="section section-muted">
        <div class="container feature-grid">
            <div class="feature"><b>01</b><h3>Register</h3><p>Add donor information through a validated PHP form.</p></div>
            <div class="feature"><b>02</b><h3>Search</h3><p>Filter donors by blood group and city.</p></div>
            <div class="feature"><b>03</b><h3>Manage</h3><p>View, update and delete demo records securely.</p></div>
        </div>
    </section>
</main>

<footer><div class="container">Blood Donor Directory • Academic Mini Project</div></footer>
</body>
</html>