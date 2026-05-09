<?php
require_once VIEW_PATH . 'header.php';
?>

<div class="card">
    <h2>Welcome to the Animal Kingdom</h2>
    <p>Explore the wonderful world of animals. Discover amazing species, share beautiful images, and connect with other animal lovers.</p>
</div>

<div class="grid">
    <div class="card">
        <h3>Local Video</h3>
        <p>A short video from our own library.</p>
        <div class="video-container">
            <video controls>
                <source src="assets/videos/sample.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <div class="card">
        <h3>YouTube Video</h3>
        <p>A beautiful wildlife video from YouTube.</p>
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/JkaxUblCGz0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="card">
    <h2>Our Location</h2>
    <p>Find us at our main wildlife reserve.</p>
    <div class="video-container" style="padding-bottom: 40%;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2696.0645607065363!2d19.039912!3d47.4925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc30c0062b25%3A0xc3c65e8a715f5c36!2sBuda%20Castle!5e0!3m2!1sen!2shu!4v1620000000000!5m2!1sen!2shu" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>

<?php
require_once VIEW_PATH . 'footer.php';
?>
