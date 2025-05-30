<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: ../../index.php");
    exit();
}

$root = $_SERVER['DOCUMENT_ROOT'];

include_once $root . "/includes/config/variables.php";
include_once $includesConfig . "config.php";
include_once $includesConfig . "functions.php";

$user = getUser($pdo, $_SESSION['user_id']);

include_once $includesPublic . "header.php";
include_once $assetsShared . 'icons/icons.php';
include_once "navbar/header.php";
?>

<div class="d-flex">
    <?php include_once "navbar/navbar.php"; ?>

    <div class="container-fluid px-0" id="content">

        <!-- Hero Section -->
        <section class="text-white py-5" style="background-color: #3a3a3a;">
            <div class="text-center">
                <h2 class="fw-bold">Create or Join a Match</h2>
                <p class="mb-4">Connect with others and enjoy a match made for you!</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="btn btn-outline-light px-4">Join Match</a>
                    <a href="#" class="btn btn-light text-dark px-4">Create Match</a>
                </div>
            </div>
        </section>

        <!-- Available Matches Section -->
        <section class="py-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold">Available Matches to Join</h3>
                <p>Browse through matches you can join.</p>
                <button class="btn btn-dark px-4 mt-2">Join Now</button>
            </div>

            <div class="d-flex justify-content-center">
                <div class="card w-75 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Basketball Tournament</h5>
                        <p class="card-text">Show your skills on the court.<br>
                            <strong>8 players needed</strong>. Location: Community Gym. Time: Sunday, 11 AM.
                        </p>
                        <span class="badge bg-secondary me-1">Basketball</span>
                        <span class="badge bg-secondary">Tournament</span>
                        <div class="mt-3 text-muted"><i class="bi bi-person-circle"></i> Jane Smith</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Your Matches Section -->
        <section class="bg-light py-5">
            <div class="container">
                <h4 class="fw-bold mb-4">Your Matches</h4>
                <p>Manage your created and joined matches.</p>
                <div class="d-flex align-items-center gap-4 mt-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/732/732219.png" alt="Basketball Icon" width="60" height="60">
                    <div>
                        <h5 class="mb-1">Basketball Tournament</h5>
                        <p class="mb-1 text-muted">Community Gym, Sunday, 11 AM</p>
                        <strong>8 players needed</strong>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center py-4 small text-muted border-top">
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                <a href="#" class="text-muted text-decoration-none">Contact Us</a>
            </div>
        </footer>

    </div>
</div>

<?php include_once $includesGlobal . "footer.php"; ?>
