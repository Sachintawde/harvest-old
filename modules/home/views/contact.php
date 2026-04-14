<?php $this->load->view('common/header'); ?>
<style>
    /* ===================================================
       Contact Page — Harvest Green Montessori Theme
    =================================================== */
    /* --- Hero Banner (matches site breadcrumb style) --- */
    .contact-banner {
        background-color: #ffc000;
        padding: 50px 0 44px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .contact-banner .banner-orbs {
        position: absolute;
        top: 10px;
        right: 6%;
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }
    .contact-banner .banner-orbs .orb {
        border-radius: 50%;
    }
    .contact-banner .banner-orbs .orb-1 {
        width: 58px; height: 58px;
        background: radial-gradient(circle at 35% 35%, #7ed6c8, #1a8a7a);
    }
    .contact-banner .banner-orbs .orb-2 {
        width: 44px; height: 44px;
        background: radial-gradient(circle at 35% 35%, #9ab8d8, #3a5a9a);
        margin-bottom: 6px;
    }
    .contact-banner .banner-orbs .orb-3 {
        width: 38px; height: 38px;
        background: radial-gradient(circle at 35% 35%, #c8b0d8, #6a3aaa);
        margin-bottom: 3px;
    }
    .contact-banner h1 {
        font-size: 2.6rem;
        font-weight: 700;
        color: #fff;
        font-family: 'Baloo 2', 'Baloo', cursive;
        margin-bottom: 6px;
    }
    .contact-banner .banner-sub {
        color: #fff;
        font-size: 1rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        opacity: 0.92;
        margin: 0;
        text-align: center;
    }
    /* --- Main Content Section --- */
    .contact-content-section {
        background: #f5f7fa;
        padding: 60px 0 50px;
    }
    /* --- Left: Get In Touch Panel --- */
    .contact-info-panel {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        padding: 40px 34px 36px;
        height: 100%;
    }
    .contact-info-panel h2 {
        font-size: 1.7rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 4px;
        font-family: 'Baloo 2', 'Baloo', cursive;
    }
    .contact-info-panel .panel-divider {
        width: 48px;
        height: 3px;
        background: #5255c5;
        border-radius: 2px;
        margin-bottom: 18px;
    }
    .contact-info-panel p.panel-intro {
        color: #555;
        font-size: 0.94rem;
        line-height: 1.75;
        margin-bottom: 28px;
    }
    /* Contact detail row */
    .ci-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 18px;
    }
    .ci-row .ci-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 50%;
        background: #28a745;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .ci-row .ci-body {
        color: #444;
        font-size: 0.94rem;
        line-height: 1.6;
        padding-top: 8px;
    }
    .ci-row .ci-body a {
        color: #444;
        text-decoration: none;
    }
    .ci-row .ci-body a:hover { color: #5255c5; }
    /* Quick Links */
    .quick-links-block {
        border-top: 2px solid #f0f2f5;
        margin-top: 28px;
        padding-top: 22px;
    }
    .quick-links-block h4 {
        font-size: 0.88rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #222;
        margin-bottom: 14px;
    }
    .quick-links-block ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .quick-links-block ul li {
        margin-bottom: 9px;
    }
    .quick-links-block ul li a {
        color: #444;
        text-decoration: none;
        font-size: 0.94rem;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: color 0.2s;
    }
    .quick-links-block ul li a::before {
        content: '';
        width: 8px;
        height: 8px;
        min-width: 8px;
        border-radius: 50%;
        background: #5dba3b;
        display: inline-block;
    }
    .quick-links-block ul li a:hover { color: #5255c5; }
    /* --- Right: Form Card --- */
    .contact-form-panel {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        padding: 40px 34px 36px;
        height: 100%;
    }
    .contact-form-panel h3 {
        font-size: 1.7rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 4px;
        font-family: 'Baloo 2', 'Baloo', cursive;
    }
    .contact-form-panel .panel-divider {
        width: 48px;
        height: 3px;
        background: #5255c5;
        border-radius: 2px;
        margin-bottom: 22px;
    }
    /* Form controls */
    .contact-form-panel label {
        font-size: 0.855rem;
        font-weight: 600;
        color: #444;
        margin-bottom: 5px;
        display: block;
    }
    .contact-form-panel .form-control {
        border: 1px solid #dde3ea;
        border-radius: 6px;
        padding: 11px 14px;
        font-size: 0.92rem;
        color: #333;
        background: #f8f9fc;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
    }
    .contact-form-panel .form-control:focus {
        border-color: #5255c5;
        box-shadow: 0 0 0 3px rgba(82,85,197,0.12);
        background: #fff;
        outline: none;
    }
    .contact-form-panel .form-group {
        margin-bottom: 16px;
    }
    .contact-form-panel textarea.form-control {
        resize: vertical;
        min-height: 110px;
    }
    /* Send button — matches site's color-1 (indigo) */
    .btn-contact-send {
        background-color: #5255c5;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 13px 28px;
        font-size: 0.97rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: background-color 0.25s;
        width: 100%;
        margin-top: 4px;
        display: block;
    }
    .btn-contact-send:hover {
        background-color: #474aab;
        color: #fff;
    }
    /* --- Map Section --- */
    .contact-map-section {
        line-height: 0;
    }
    .contact-map-section iframe {
        display: block;
        width: 100%;
        height: 420px;
        border: 0;
    }
    /* Alerts */
    .contact-content-section .alert {
        border-radius: 6px;
        margin-bottom: 28px;
    }
    /* Equal-height columns */
    .contact-row-equal {
        display: flex;
        flex-wrap: wrap;
    }
    .contact-row-equal > [class*="col-"] {
        display: flex;
        flex-direction: column;
    }
    @media (max-width: 991px) {
        .contact-info-panel,
        .contact-form-panel {
            height: auto;
        }
        .contact-banner .banner-orbs {
            right: 20px;
            top: 6px;
        }
        .contact-banner .banner-orbs .orb-1 { width: 44px; height: 44px; }
        .contact-banner .banner-orbs .orb-2 { width: 34px; height: 34px; }
        .contact-banner .banner-orbs .orb-3 { width: 30px; height: 30px; }
    }
</style>
<!-- ===== Hero Banner ===== -->
<div class="contact-banner">
    <div class="banner-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    <h1>Contact Us</h1>
    <p class="banner-sub">We&rsquo;d Love To Hear From You</p>
</div>
<!-- ===== Main Section ===== -->
<section class="contact-content-section">
    <div class="container">
        <div id="contact-alert" style="display:none;"></div>
        <div class="row contact-row-equal">
            <!-- Left Column: Get In Touch -->
            <div class="col-lg-5 col-md-12 mb-4 mb-lg-0 pr-lg-3">
                <div class="contact-info-panel">
                    <h2>Get in Touch</h2>
                    <div class="panel-divider"></div>
                    <p class="panel-intro">We&rsquo;d love to hear from you. Reach out to us with any questions about our programs, admissions, or anything else.</p>
                    <div class="ci-row">
                        <div class="ci-icon"><i class="fa fa-phone"></i></div>
                        <div class="ci-body">
                            <a href="tel:2818197529">281-819-PLAY (7529)</a>
                        </div>
                    </div>
                    <div class="ci-row">
                        <div class="ci-icon"><i class="fa fa-envelope"></i></div>
                        <div class="ci-body">
                            <a href="mailto:info@harvestgreenmontessori.com">info@harvestgreenmontessori.com</a>
                        </div>
                    </div>
                    <div class="ci-row">
                        <div class="ci-icon"><i class="fa fa-clock-o"></i></div>
                        <div class="ci-body">
                            Mon &ndash; Fri: 7:00 AM &ndash; 6:30 PM
                        </div>
                    </div>
                    <div class="ci-row">
                        <div class="ci-icon"><i class="fa fa-map-marker"></i></div>
                        <div class="ci-body">
                            <a href="https://maps.google.com/?q=4100+Harvest+Corner+Dr+Richmond+TX+77406" target="_blank" rel="noopener noreferrer">
                                4100 Harvest Corner Dr,<br>Richmond, TX 77406
                            </a>
                        </div>
                    </div>
                    <!-- Quick Links -->
                    <div class="quick-links-block">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="<?= base_url('Schedule_a_tour') ?>">Schedule a Tour</a></li>
                            <li><a href="<?= base_url('Admission') ?>">Admissions Information</a></li>
                            <li><a href="<?= base_url('About') ?>">About The School</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Right Column: Send a Message -->
            <div class="col-lg-7 col-md-12 pl-lg-3">
                <div class="contact-form-panel">
                    <h3>Send us a message</h3>
                    <div class="panel-divider"></div>
                    <form id="contact-form" novalidate>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="c_first_name">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_first_name" name="c_first_name" placeholder="First name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="c_last_name">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_last_name" name="c_last_name" placeholder="Last name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c_email">E-mail <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="c_email" name="c_email" placeholder="Email address" required>
                        </div>
                        <div class="form-group">
                            <label for="c_phone">Phone</label>
                            <input type="tel" class="form-control" id="c_phone" name="c_phone" placeholder="Phone number">
                        </div>
                        <div class="form-group">
                            <label for="c_program">Program of Interest</label>
                            <select class="form-control" id="c_program" name="c_program">
                                <option value="">Select a program ...</option>
                                <option value="Infant">Infant (3 months &ndash; 16 months)</option>
                                <option value="Toddler">Toddler (17 months &ndash; 23 months)</option>
                                <option value="Transition">Transition (24 months &ndash; 36 months)</option>
                                <option value="Primary">Primary (3 years &ndash; 5 years)</option>
                                <option value="Kindergarten">Kindergarten / First Grade (5 &ndash; 7 years)</option>
                                <option value="After School">After School (5 &ndash; 12 years)</option>
                                <option value="Summer Camp">Summer Camp</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="c_message">Message</label>
                            <textarea class="form-control" id="c_message" name="c_message" rows="5" placeholder="Your message..."></textarea>
                        </div>
                        <button type="submit" class="btn-contact-send" id="contact-submit-btn">
                            <span id="contact-btn-text">Send Message</span>
                            <span id="contact-btn-loading" style="display:none;">Sending...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
<!-- ===== Google Map ===== -->
<section class="contact-map-section">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3467.3540472334585!2d-95.72499242556013!3d29.651498937083467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640e01bce257c85%3A0xa3a15a8fc3178066!2sHarvest%20Green%20Montessori%20School!5e0!3m2!1sen!2sin!4v1697008493580!5m2!1sen!2sin"
        height="420"
        frameborder="0"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        title="Harvest Green Montessori School Location">
    </iframe>
</section>
<script>
(function () {
    var form = document.getElementById('contact-form');
    var alertBox = document.getElementById('contact-alert');
    var submitBtn = document.getElementById('contact-submit-btn');
    var btnText = document.getElementById('contact-btn-text');
    var btnLoading = document.getElementById('contact-btn-loading');

    function showAlert(type, message) {
        alertBox.className = 'alert alert-' + type;
        alertBox.innerHTML = message;
        alertBox.style.display = 'block';
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var firstName = document.getElementById('c_first_name').value.trim();
        var lastName  = document.getElementById('c_last_name').value.trim();
        var email     = document.getElementById('c_email').value.trim();
        var phone     = document.getElementById('c_phone').value.trim();
        var program   = document.getElementById('c_program').value;
        var message   = document.getElementById('c_message').value.trim();

        if (!firstName || !lastName || !email) {
            showAlert('danger', 'Please fill in all required fields (First Name, Last Name, Email).');
            return;
        }
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showAlert('danger', 'Please enter a valid email address.');
            return;
        }

        alertBox.style.display = 'none';
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';

        var formData = new FormData();
        formData.append('c_first_name', firstName);
        formData.append('c_last_name',  lastName);
        formData.append('c_email',      email);
        formData.append('c_phone',      phone);
        formData.append('c_program',    program);
        formData.append('c_message',    message);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url("contact/send") ?>', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
                try {
                    var resp = JSON.parse(xhr.responseText);
                    if (resp.status === 'success') {
                        showAlert('success', resp.message);
                        form.reset();
                    } else {
                        showAlert('danger', resp.message);
                    }
                } catch (err) {
                    showAlert('danger', 'Something went wrong. Please try again or call us directly.');
                }
            }
        };
        xhr.send(formData);
    });
})();
</script>
<?php $this->load->view('common/footer'); ?>
