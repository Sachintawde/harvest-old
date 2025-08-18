<?php $this->load->view('common/header'); ?>
<style>
    .datepicker-days tr td:first-child {
        visibility: hidden;
    }

    .datepicker table tr td.disabled,
    .datepicker table tr td.disabled:hover {
        color: #F93005 !important;
    }

    .form-check-input {
        margin-left: 0 !important;
    }

    .flex-container {
        display: flex;
        align-items: center;
        gap: 25px;
        flex-wrap: wrap;
    }

    .imp {
        color: red;
    }
</style>
<!-- datapicker CSS ============================================ -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/datapicker/datepicker3.css">

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container py-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Schedule A Tour</h1>
                    <nav class="bradcaump-inner">
                        <a class="breadcrumb-item" href="index.html">Home</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb-item active">Schedule A Tour</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Class Details -->
<!-- Start Welcame Area -->
<?php
$timeout = 60; // 1 minute = 60 seconds
$timestamp = $this->session->flashdata('timestamp');
$current_time = time();

if ($timestamp && ($current_time - $timestamp) > $timeout) {
    // Flash data has expired, so unset it
    $this->session->unset_userdata('success');
    $this->session->unset_userdata('error');
    $this->session->unset_userdata('timestamp');
} else {
    // Show flash data if it's not expired
    if ($this->session->flashdata('success')) {
        echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
    }

    if ($this->session->flashdata('error')) {
        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
    }
}
?>

<section class="junior__welcome__area pb-5">
    <div class="container">
        <div class="row jn__welcome__wrapper align-items-center">
            <div class="col-md-12 col-lg-7 col-sm-12">
                <div class="welcome__juniro__inner">
                    <h3 class="text-center">Schedule A Tour</h3>
                    <p class="wow flipInX"><b>We are happy to meet with you!</b></p>
                    <p class="wow flipInX mt-3">Are you wondering if Harvest Green Montessori is right for your child? We would love to give you a tour around our school so that you can meet our certified and experienced staff. The tour will also help you to learn about Montessori philosophy and how we will help nurture your child.</p>
                    <p class="wow flipInX mt-3">We are offering these tours while making sure to maintain social distancing guidelines. Tours will be available after business hours. To book a slot, please select a time. You will be asked for some details to confirm your appointment, and we will be in touch with you to coordinate details.</p>
                </div>
            </div>
            <div class="col-md-12 col-lg-5 col-sm-12 md-mt-40 sm-mt-40">
                <div class="jnr__Welcome__thumb wow fadeInRight">
                    <img src="<?= base_url(); ?>assets/home/images/others/book.png" alt="images" class="video_border w-100">
                    <a class="play__btn" href="https://www.youtube.com/watch?v=AHCybo_rhcY&t=7s"><i class="fa fa-play"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Welcame Area -->
<section class="contact__box py-40 bg-image--27">
    <div class="container mt-4">
        <form action="<?= base_url() ?>schedule_a_tour/add_tour" method="post" id="Tour-form">
            <h5 class="bg-success text-white p-2">Child 1 information</h5>
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Child First Name:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_child_name_1" value="<?= isset($post_data['t_child_name_1']) ? $post_data['t_child_name_1'] : '' ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Child Last Name:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_child_lname_1" value="<?= isset($post_data['t_child_lname_1']) ? $post_data['t_child_lname_1'] : '' ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Gender:<spna class="imp">*</spna></label>
                    <select class="form-control no-links" name="t_gender_1" required>
                        <option value="">Select Gender</option>
                        <option value="Male" <?= isset($post_data['t_gender_1']) && $post_data['t_gender_1'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= isset($post_data['t_gender_1']) && $post_data['t_gender_1'] == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= isset($post_data['t_gender_1']) && $post_data['t_gender_1'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Date of Birth:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_dob_1" id="t_dob_1" placeholder="Select Date of Birth" value="<?= isset($post_data['t_dob_1']) ? $post_data['t_dob_1'] : '' ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Class:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_class_1" value="<?= isset($post_data['t_class_1']) ? $post_data['t_class_1'] : '' ?>" required>
                </div>
            </div>
            <h5 class="bg-success text-white p-2 mt-2">Child 2 information</h5>
            <div class="row mt-2">

                <div class="col-md-3">
                    <label class="form-label">Child First Name:</label>
                    <input type="text" class="form-control no-links" name="t_child_name_2" value="<?= isset($post_data['t_child_name_2']) ? $post_data['t_child_name_2'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Child Last Name:</label>
                    <input type="text" class="form-control no-links" name="t_child_lname_2" value="<?= isset($post_data['t_child_lname_2']) ? $post_data['t_child_lname_2'] : '' ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Gender:</label>
                    <select class="form-control no-links" name="t_gender_2">
                        <option value="">Select Gender</option>
                        <option value="Male" <?= isset($post_data['t_gender_2']) && $post_data['t_gender_2'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= isset($post_data['t_gender_2']) && $post_data['t_gender_2'] == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= isset($post_data['t_gender_2']) && $post_data['t_gender_2'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Date of Birth:</label>
                    <input type="text" class="form-control no-links" name="t_dob_2" id="t_dob_2" placeholder="Select Date of Birth" value="<?= isset($post_data['t_dob_2']) ? $post_data['t_dob_2'] : '' ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Class:</label>
                    <input type="text" class="form-control no-links" name="t_class_2" value="<?= isset($post_data['t_class_2']) ? $post_data['t_class_2'] : '' ?>">
                </div>
            </div>
            <h5 class="bg-success text-white p-2 mt-2">Family Info</h5>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label">Address:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_address" value="<?= isset($post_data['t_address']) ? $post_data['t_address'] : '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">City:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_city" value="<?= isset($post_data['t_city']) ? $post_data['t_city'] : '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">State:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_state" value="<?= isset($post_data['t_state']) ? $post_data['t_state'] : '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Zip Code:<spna class="imp">*</spna></label>
                    <input type="number" class="form-control no-links" name="t_zip_code" value="<?= isset($post_data['t_zip_code']) ? $post_data['t_zip_code'] : '' ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Mother First & Last Name:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_mother_name" value="<?= isset($post_data['t_mother_name']) ? $post_data['t_mother_name'] : '' ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Phone:<spna class="imp">*</spna></label>
                    <input type="number" class="form-control no-links" name="t_mother_phone" value="<?= isset($post_data['t_mother_phone']) ? $post_data['t_mother_phone'] : '' ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Email:<spna class="imp">*</spna></label>
                    <input type="email" class="form-control no-links email" name="t_mother_email" value="<?= isset($post_data['t_mother_email']) ? $post_data['t_mother_email'] : '' ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Father First & Last Name:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_father_name" value="<?= isset($post_data['t_father_name']) ? $post_data['t_father_name'] : '' ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Phone:<spna class="imp">*</spna></label>
                    <input type="number" class="form-control no-links" name="t_father_phone" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Email:<spna class="imp">*</spna></label>
                    <input type="email" class="form-control no-links" name="t_father_email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Preferred Method of Communication:<spna class="imp">*</spna></label>
                    <select class="form-control no-links" name="t_communication_method" required>
                        <option value="" selected disabled>Method of Communication</option>
                        <option value="phone">Phone</option>
                        <option value="email">Email</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Requested Tour Date:<spna class="imp">*</spna></label>
                    <input type="text" class="form-control no-links" name="t_start_date_field" id="t_start_date_field" placeholder="Select Date" value="<?= isset($post_data['t_start_date_field']) ? $post_data['t_start_date_field'] : '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Select Time Slot:<spna class="imp">*</spna></label>
                    <select class="form-control no-links" name="t_time_slot" required>
                        <option value="" selected disabled>Select Time Slot</option>
                        <option value="10:00AM-10:30AM" id="week2">09:30AM-10:00AM</option>
                        <option value="10:00AM-10:30AM" id="week2">10:00AM-10:30AM</option>
                        <option value="10:30AM-11:00AM" id="week4">10:30AM-11:00AM</option>
                        <option value="11:00AM-11:30AM" id="week5">11:00AM-11:30AM</option>
                        <option value="11:30AM-12:00PM" id="week6">11:30AM-12:00PM</option>
                        <option value="2:30PM-3:00PM" id="week7">2:30PM-3:00PM</option>
                        <option value="3:00PM-3:30PM" id="week8">3:00PM-3:30PM</option>
                        <option value="3:30PM-4:00PM" id="week9">3:30PM-4:00PM</option>
                        <option value="4:00PM-4:30PM" id="week10">4:00PM-4:30PM</option>
                    </select>
                </div>
            </div>

            <h5 class="bg-success text-white p-2 mt-3">Tell me more about your child and your needs:</h5>
            <div class="mb-3">
                <label class="form-label">Has your child been in a Montessori school or childcare before?</label>
                <input type="text" class="form-control no-links" name="t_previous_school">
            </div>
            <div class="mb-3">
                <label class="form-label">What is most important to you when looking for a Montessori School?</label>
                <textarea class="form-control no-links" name="t_important_factors"></textarea>
            </div>

            <h5 class="bg-success text-white p-2">How did you hear about Harvest Green Montessori School?<spna class="imp">*</spna>
            </h5>
            <div class="flex-container" id="source-container">
                <div class="form-check">
                    <input class="form-check-input source-radio" type="radio" name="t_source" id="internet" value="Internet">
                    <label class="form-check-label" for="internet">Internet</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input source-radio" type="radio" name="t_source" id="advertising" value="Advertising">
                    <label class="form-check-label" for="advertising">Advertising</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input source-radio" type="radio" name="t_source" id="other" value="Other">
                    <label class="form-check-label" for="other">Other</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input source-radio" type="radio" name="t_source" id="event" value="Event">
                    <label class="form-check-label" for="event">Event</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input source-radio" type="radio" name="t_source" id="drive-By" value="Drive-By">
                    <label class="form-check-label" for="drive-By">Drive-By</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input source-radio" type="radio" name="t_source" id="referral" value="Referral">
                    <label class="form-check-label" for="referral">Referral Name-</label>
                </div>
            </div>
            <p id="source-error" style="color: red; display: none;">Please select how you heard about us.</p>
            <!-- Referral Name Input (Hidden by Default) -->
            <div id="referralNameContainer" style="display: none; margin-top: 10px;">
                <label for="referralName">Enter Referral Name:</label>
                <input type="text" name="t_referral_name" id="referralName" class="form-control no-links">
            </div>

            <h5 class="bg-success text-white p-2 mt-3">Program Interested:<spna class="imp">*</spna>
            </h5>
            <div class="flex-container" id="program-container">
                <div class="form-check">
                    <input class="form-check-input program-radio" type="radio" name="t_program" id="halfday" value="halfday">
                    <label class="form-check-label" for="halfday">Half Day (8:30am -12:00pm)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input program-radio" type="radio" name="t_program" id="schoolday" value="schoolday">
                    <label class="form-check-label" for="schoolday">School Day (8:30am -3:00pm)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input program-radio" type="radio" name="t_program" id="fullday" value="fullday">
                    <label class="form-check-label" for="fullday">Full Day (6:30am – 6:30pm)</label>
                </div>
            </div>
            <p id="program-error" style="color: red; display: none;">Please select program.</p>
            <div class="flex-container" id="agegroup-container">
                <h5 class="w-100 bg-success text-white p-2 mt-2">Our Program (Age Group)</h5>
                <div class="form-check">
                    <input class="form-check-input agegroup-checkbox" type="checkbox" id="infant" name="t_agegroup[]" value="Infant">
                    <label class="form-check-label" for="infant">Infant (3 months -16 months)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input agegroup-checkbox" type="checkbox" id="toddler" name="t_agegroup[]" value="Toddler">
                    <label class="form-check-label" for="toddler">Toddler (17 months – 23 months)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input agegroup-checkbox" type="checkbox" id="transition" name="t_agegroup[]" value="Transition">
                    <label class="form-check-label" for="transition">Transition (24 months – 36 months)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input agegroup-checkbox" type="checkbox" id="primary" name="t_agegroup[]" value="Primary">
                    <label class="form-check-label" for="primary">Primary (3 years – 5 years)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input agegroup-checkbox" type="checkbox" id="kindergarten" name="t_agegroup[]" value="Kindergarten">
                    <label class="form-check-label" for="kindergarten">Kindergarten/First Grade (5 years – 7years)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input agegroup-checkbox" type="checkbox" id="after-school" name="t_agegroup[]" value="After School">
                    <label class="form-check-label" for="after-school">After School (5 years – 12 years)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input agegroup-checkbox" type="checkbox" id="before-school" name="t_agegroup[]" value="Before & After School">
                    <label class="form-check-label" for="before-school">Before & After School (5 years – 12 years)</label>
                </div>
            </div>
            <p id="agegroup-error" style="color: red; display: none;">Please select at least one Age group.</p>

            <div class="row mb-3 mt-3">
                <div class="col-md-6">
                    <label class="form-label">Other Notes:</label>
                    <textarea class="form-control no-links" name="t_other_notes"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date:<span class="imp">*</span></label>
                    <input type="text" class="form-control no-links" name="t_signature_date" id="t_signature_date" placeholder="Select Date" value="<?= isset($post_data['t_signature_date']) ? $post_data['t_signature_date'] : '' ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Le72CQqAAAAAHW4TQ6RZSTX-Jmni63nSUOWqcpk"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    <p id="error-message" style="color: red; display: none;">Links are not allowed!</p>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Class Details -->
<!-- animation section  -->
<section class="home-content" style="background-color: #ffc000;padding-top: 30px">
    <marquee behavior="" direction="">
        <img src="<?= base_url(); ?>assets/home/images/others/bus.png">
    </marquee>
</section>
<!-- ---------End Home gallery------- -->

<?php $this->load->view('common/footer'); ?>

<!-- datapicker JS		============================================ -->
<script src="<?= base_url(); ?>assets/admin/js/datapicker/bootstrap-datepicker.js"></script>
<!-- <script src="<?= base_url(); ?>assets/admin/js/datapicker/datepicker-active.js"></script> -->
<!-- Add this script tag to include moment.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let referralRadio = document.getElementById("referral");
        let referralNameContainer = document.getElementById("referralNameContainer");
        let referralNameInput = document.getElementById("referralName");

        // Show input field only when "Referral" is selected
        document.querySelectorAll("input[name='t_source']").forEach(function(radio) {
            radio.addEventListener("change", function() {
                if (referralRadio.checked) {
                    referralNameContainer.style.display = "block";
                    referralNameInput.setAttribute("required", "true");
                } else {
                    referralNameContainer.style.display = "none";
                    referralNameInput.removeAttribute("required");
                    referralNameInput.value = ""; // Clear input when deselected
                }
            });
        });
    });
</script>

<script>
    var datesForDisable = [];

    // Helper function to generate all dates between two given dates
    function getDatesInRange(startDate, endDate) {
        var dateArray = [];
        var currentDate = moment(startDate, "DD/MM/YYYY");
        var stopDate = moment(endDate, "DD/MM/YYYY");

        while (currentDate <= stopDate) {
            dateArray.push(currentDate.format("DD/MM/YYYY"));
            currentDate = currentDate.add(1, 'days');
        }
        return dateArray;
    }

    $.ajax({
        url: base_url + 'Schedule_a_tour/get_school_closed_events', // Updated endpoint
        type: 'get',
        dataType: 'json',
        success: function(response) {
            // Loop through the events to generate dates to disable
            datesForDisable = [];
            response.forEach(function(event) {
                var startDate = event.event_start;
                var endDate = event.event_end;
                var rangeDates = getDatesInRange(startDate, endDate);
                datesForDisable = datesForDisable.concat(rangeDates); // Combine dates
            });

            // Initialize datepicker for #t_start_date_field and #t_dob
            $("#t_start_date_field").datepicker({
                format: 'mm/dd/yyyy',
                daysOfWeekDisabled: [0, 6], // Disable weekends
                autoclose: true,
                weekStart: 0,
                calendarWeeks: true,
                todayHighlight: true,
                beforeShowDay: function(currentDate) {
                    var dateNr = moment(currentDate).format("DD/MM/YYYY");
                    if (datesForDisable.length > 0) {
                        for (var i = 0; i < datesForDisable.length; i++) {
                            if (moment(currentDate).unix() === moment(datesForDisable[i], 'DD/MM/YYYY').unix()) {
                                return false; // Disable the date
                            }
                        }
                    }
                    return true; // Enable the date
                }
            });
        }
    });
</script>
<script>
    $("#t_dob_1,#t_dob_2,#t_signature_date").datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        weekStart: 0,
        calendarWeeks: true,
        todayHighlight: true
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("form").addEventListener("submit", function(event) {
            let isValid = true;

            // Validate age group checkboxes
            let checkboxes = document.querySelectorAll(".agegroup-checkbox");
            let isAgeGroupChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            if (!isAgeGroupChecked) {
                document.getElementById("agegroup-error").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("agegroup-error").style.display = "none";
            }

            // Validate source radio buttons
            let sourceRadios = document.querySelectorAll(".source-radio");
            let isSourceChecked = Array.from(sourceRadios).some(radio => radio.checked);
            if (!isSourceChecked) {
                document.getElementById("source-error").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("source-error").style.display = "none";
            }

            // Validate program radio buttons
            let programRadios = document.querySelectorAll(".program-radio");
            let isProgramChecked = Array.from(programRadios).some(radio => radio.checked);
            if (!isProgramChecked) {
                document.getElementById("program-error").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("program-error").style.display = "none";
            }

            // Prevent form submission if any validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>
<script>
    document.getElementById("Tour-form").addEventListener("submit", function(event) {
        var inputs = document.querySelectorAll(".no-links");
        var errorMessage = document.getElementById("error-message");
        var urlPattern = /(https?:\/\/|www\.)\S+/gi; // Regex to detect links

        for (var input of inputs) {
            if (urlPattern.test(input.value)) {
                errorMessage.style.display = "block"; // Show error message
                event.preventDefault(); // Prevent form submission
                return; // Stop checking further
            }
        }
        errorMessage.style.display = "none"; // Hide error message if no links found
    });
</script>