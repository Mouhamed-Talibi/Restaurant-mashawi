<?php
    require_once "includes/customerSession.php";
    require_once "includes/nav.php";

    $title = "Mashawi-amar | Contact-Location";
    ob_start();
?>

    <!-- start location & contact -->   
        <section class="location-contact mt-5 py-5 bg-white text-dark" id="location-contact">
            <div class="container">
                <!-- Section Heading -->
                <div class="special-heading text-center mb-5">
                    <h1 class="fw-bold text-dark">Find Us & Contact</h1>
                    <p class="text-dark">Visit us or get in touch anytime</p>
                </div>

                <div class="row">
                    <!-- Location Section -->
                    <div class="col-lg-6 mb-4">
                        <div class="location bg-dark text-light shadow rounded p-4">
                            <h2 class="location fw-bold mb-3 text-center">Our Location</h2>
                            <div class="map mb-3">
                                <!-- Embedded Google Map -->
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d338.1900739!2d-9.2170188!3d30.3903563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3d70a741536ef%3A0xa29b2c9944f7f8da!2sBrothers%20Grill!5e0!3m2!1sen!2sus!4v1697738456945!5m2!1sen!2sus"
                                    width="100%" height="315" style="border:0;" allowfullscreen="" loading="lazy">
                                </iframe>
                            </div>
                            <div class="text-center">
                                <p><i class="fas fa-map-marker-alt me-2  text-warning"></i> Morocco, Ouled Teima, Brothers Grill</p>
                                <p><i class="fas fa-clock me-2 text-warning"></i> Open Daily: 9:00 AM - 00:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="col-lg-6">
                        <div class="contact bg-dark text-light shadow rounded p-4">
                            <h2 class="fw-bold mb-3 text-center">Get in Touch</h2>
                            <form action="routes.php?action=sendMessage" method="POST">
                                <!-- display errors and messages -->
                                <?php
                                    if(!empty($error)) {
                                        ?>
                                            <div class="alert alert-danger text-center" role="alert">
                                                <?= $error ?>
                                            </div>
                                        <?php
                                    }
                                    if(!empty($message)) {
                                        ?>
                                            <div class="alert alert-success text-center" role="alert">
                                                <?= $message ?>
                                            </div>
                                        <?php
                                    }
                                ?>

                                <!-- Name Input -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" id="name" placeholder="Enter your full name">
                                </div>
                                <!-- Email Input -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                                </div>
                                <!-- Message Input -->
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="5" name="message"
                                        placeholder="Write your message here"></textarea>
                                </div>
                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning w-100 fw-bold">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- end location & contact -->

<?php
    $content = ob_get_clean();
    require_once "layout/layout.php";
    require_once "includes/footer.php";
?>