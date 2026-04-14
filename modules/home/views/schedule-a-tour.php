<?php $this->load->view('common/header'); ?>
<style>
    .imp { color: red; }

    /* â”€â”€ Tour form card â”€â”€ */
    .tour-card {
        background: #fff;
        border: 1px solid #dce1e7;
        border-radius: 6px;
        padding: 36px 40px 40px;
        max-width: 720px;
        margin: 0 auto;
    }
    .tour-card h4 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 28px;
        color: #1a1a2e;
    }
    .tour-form-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #6b7280;
        margin-bottom: 5px;
    }
    .tour-form-control {
        display: block;
        width: 100%;
        height: 40px;
        padding: 0 12px;
        font-size: 14px;
        color: #374151;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        transition: border-color .15s;
        outline: none;
    }
    .tour-form-control:focus { border-color: #4a90d9; box-shadow: 0 0 0 2px rgba(74,144,217,.15); }
    textarea.tour-form-control { height: 100px; padding-top: 10px; resize: vertical; }
    select.tour-form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; }
    .tour-phone-group { display: flex; gap: 0; }
    .tour-phone-prefix { display: flex; align-items: center; gap: 6px; height: 40px; padding: 0 10px; border: 1px solid #d1d5db; border-right: none; border-radius: 4px 0 0 4px; background: #f9fafb; font-size: 13px; color: #374151; white-space: nowrap; }
    .tour-phone-group .tour-form-control { border-radius: 0 4px 4px 0; }
    .add-child-btn { background: none; border: none; color: #2563eb; font-size: 13px; font-weight: 600; cursor: pointer; padding: 0; display: inline-flex; align-items: center; gap: 4px; margin: 4px 0 16px; }
    .add-child-btn:hover { text-decoration: underline; }
    .child2-section { display: none; border-top: 1px solid #e5e7eb; padding-top: 18px; margin-top: 4px; }
    .child2-section.visible { display: block; }
    .section-label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #374151; margin: 18px 0 10px; }
    .tour-submit-btn { display: block; width: 100%; padding: 12px; background: #16a34a; color: #fff; font-size: 15px; font-weight: 600; border: none; border-radius: 4px; cursor: pointer; margin-top: 24px; letter-spacing: .01em; transition: background .2s; }
    .tour-submit-btn:hover { background: #15803d; }
    .tour-form-row { display: flex; gap: 20px; margin-bottom: 18px; }
    .tour-form-row > .tour-field { flex: 1; min-width: 0; }
    .tour-field { margin-bottom: 18px; }
    .tour-disclaimer { font-size: 12px; color: #6b7280; margin-top: 6px; line-height: 1.5; }
    @media (max-width:600px) {
        .tour-form-row { flex-direction: column; gap: 0; }
        .tour-card { padding: 24px 16px 28px; }
    }
</style>
<!-- datapicker CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/datapicker/datepicker3.css">

<!-- Breadcrumb -->
<div class="ht__bradcaump__area">
    <div class="ht__bradcaump__container py-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Schedule A Tour</h1>
                    <nav class="bradcaump-inner">
                        <a class="breadcrumb-item" href="<?= base_url() ?>">Home</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb-item active">Schedule A Tour</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($this->session->flashdata('success')) {
    echo '<div class="container mt-3"><div class="alert alert-success alert-dismissible fade show" role="alert">' . $this->session->flashdata('success') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
}
if ($this->session->flashdata('error')) {
    echo '<div class="container mt-3"><div class="alert alert-danger alert-dismissible fade show" role="alert">' . $this->session->flashdata('error') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
}
?>

<section class="contact__box py-50">
    <div class="container">
        <div class="tour-card">
            <h4>Enter details</h4>
            <?php $fd = $this->session->flashdata('post_data') ?: []; ?>
            <form action="<?= base_url() ?>schedule_a_tour/add_tour" method="post" id="Tour-form">

                <!-- First Name / Last Name -->
                <div class="tour-form-row">
                    <div class="tour-field">
                        <label class="tour-form-label">First Name <span class="imp">*</span></label>
                        <input type="text" name="t_guardian_first" class="tour-form-control" placeholder="First name" value="<?= htmlspecialchars($fd['t_guardian_first'] ?? '') ?>" required>
                    </div>
                    <div class="tour-field">
                        <label class="tour-form-label">Last Name <span class="imp">*</span></label>
                        <input type="text" name="t_guardian_last" class="tour-form-control" placeholder="Last name" value="<?= htmlspecialchars($fd['t_guardian_last'] ?? '') ?>" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="tour-field">
                    <label class="tour-form-label">Email <span class="imp">*</span></label>
                    <input type="email" name="t_mother_email" class="tour-form-control" placeholder="email@example.com" value="<?= htmlspecialchars($fd['t_mother_email'] ?? '') ?>" required>
                </div>

                <!-- Phone -->
                <div class="tour-field">
                    <label class="tour-form-label">Phone <span class="imp">*</span></label>
                    <div class="tour-phone-group">
                        <span class="tour-phone-prefix">&#127482;&#127480; US &nbsp;+1</span>
                        <input type="tel" name="t_mother_phone" class="tour-form-control" placeholder="(555) 000-0000" value="<?= htmlspecialchars($fd['t_mother_phone'] ?? '') ?>" required>
                    </div>
                </div>

                <!-- How did you hear -->
                <div class="tour-field">
                    <label class="tour-form-label">How did you hear about us? <span class="imp">*</span></label>
                    <?php $sel_src = $fd['t_source'] ?? ''; ?>
                    <select name="t_source" class="tour-form-control" required>
                        <option value="">Select...</option>
                        <option value="Internet"   <?= $sel_src==='Internet'   ? 'selected':'' ?>>Internet</option>
                        <option value="Advertising"<?= $sel_src==='Advertising'? 'selected':'' ?>>Advertising</option>
                        <option value="Referral"   <?= $sel_src==='Referral'   ? 'selected':'' ?>>Referral</option>
                        <option value="Drive-By"   <?= $sel_src==='Drive-By'   ? 'selected':'' ?>>Drive-By</option>
                        <option value="Event"      <?= $sel_src==='Event'      ? 'selected':'' ?>>Event</option>
                        <option value="Other"      <?= $sel_src==='Other'      ? 'selected':'' ?>>Other</option>
                    </select>
                </div>

                <!-- Child 1 -->
                <div class="section-label">Child information</div>
                <div class="tour-form-row">
                    <div class="tour-field">
                        <label class="tour-form-label">Child First Name <span class="imp">*</span></label>
                        <input type="text" name="t_child_name_1" class="tour-form-control" placeholder="First name" value="<?= htmlspecialchars($fd['t_child_name_1'] ?? '') ?>" required>
                    </div>
                    <div class="tour-field">
                        <label class="tour-form-label">Child Last Name <span class="imp">*</span></label>
                        <input type="text" name="t_child_lname_1" class="tour-form-control" placeholder="Last name" value="<?= htmlspecialchars($fd['t_child_lname_1'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="tour-form-row">
                    <div class="tour-field">
                        <label class="tour-form-label">Date of Birth <span class="imp">*</span></label>
                        <input type="text" name="t_dob_1" id="t_dob_1" class="tour-form-control" placeholder="mm/dd/yyyy" value="<?= htmlspecialchars($fd['t_dob_1'] ?? '') ?>" required>
                    </div>
                    <div class="tour-field">
                        <label class="tour-form-label">Expected Start Date <span class="imp">*</span></label>
                        <input type="text" name="t_signature_date" id="t_signature_date" class="tour-form-control" placeholder="mm/dd/yyyy" value="<?= htmlspecialchars($fd['t_signature_date'] ?? '') ?>" required>
                    </div>
                </div>

                <!-- Program Interest -->
                <div class="tour-field">
                    <label class="tour-form-label">First Child's Program Interest <span class="imp">*</span></label>
                    <?php $sel_p = $fd['t_program'] ?? ''; ?>
                    <select name="t_program" class="tour-form-control" required>
                        <option value="">Select a program</option>
                        <option value="Infant"               <?= $sel_p==='Infant'               ?'selected':''?>>Infant (3 months &ndash; 16 months)</option>
                        <option value="Toddler"              <?= $sel_p==='Toddler'              ?'selected':''?>>Toddler (17 months &ndash; 23 months)</option>
                        <option value="Transition"           <?= $sel_p==='Transition'           ?'selected':''?>>Transition (24 months &ndash; 36 months)</option>
                        <option value="halfday"              <?= $sel_p==='halfday'              ?'selected':''?>>Half Day (8:30am &ndash; 12:00pm)</option>
                        <option value="schoolday"            <?= $sel_p==='schoolday'            ?'selected':''?>>School Day (8:30am &ndash; 3:00pm)</option>
                        <option value="fullday"              <?= $sel_p==='fullday'              ?'selected':''?>>Full Day (6:30am &ndash; 6:30pm)</option>
                        <option value="After School"         <?= $sel_p==='After School'         ?'selected':''?>>After School (5 yrs &ndash; 12 yrs)</option>
                        <option value="Before & After School" <?= $sel_p==='Before & After School'?'selected':''?>>Before &amp; After School (5 yrs &ndash; 12 yrs)</option>
                    </select>
                </div>

                <!-- Add a child toggle -->
                <button type="button" class="add-child-btn" id="addChildBtn">&#43; Add a child</button>

                <!-- Child 2 (hidden by default) -->
                <div class="child2-section" id="child2Section">
                    <div class="section-label">Second Child</div>
                    <div class="tour-form-row">
                        <div class="tour-field">
                            <label class="tour-form-label">Child First Name</label>
                            <input type="text" name="t_child_name_2" class="tour-form-control" placeholder="First name" value="<?= htmlspecialchars($fd['t_child_name_2'] ?? '') ?>">
                        </div>
                        <div class="tour-field">
                            <label class="tour-form-label">Child Last Name</label>
                            <input type="text" name="t_child_lname_2" class="tour-form-control" placeholder="Last name" value="<?= htmlspecialchars($fd['t_child_lname_2'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="tour-form-row">
                        <div class="tour-field">
                            <label class="tour-form-label">Date of Birth</label>
                            <input type="text" name="t_dob_2" id="t_dob_2" class="tour-form-control" placeholder="mm/dd/yyyy" value="<?= htmlspecialchars($fd['t_dob_2'] ?? '') ?>">
                        </div>
                        <div class="tour-field">
                            <label class="tour-form-label">Second Child's Program Interest</label>
                            <?php $sel_p2 = $fd['t_class_2'] ?? ''; ?>
                            <select name="t_class_2" id="t_class_2" class="tour-form-control">
                                <option value="">Select a program</option>
                                <option value="Infant"               <?= $sel_p2==='Infant'               ?'selected':''?>>Infant (3 months &ndash; 16 months)</option>
                                <option value="Toddler"              <?= $sel_p2==='Toddler'              ?'selected':''?>>Toddler (17 months &ndash; 23 months)</option>
                                <option value="Transition"           <?= $sel_p2==='Transition'           ?'selected':''?>>Transition (24 months &ndash; 36 months)</option>
                                <option value="halfday"              <?= $sel_p2==='halfday'              ?'selected':''?>>Half Day (8:30am &ndash; 12:00pm)</option>
                                <option value="schoolday"            <?= $sel_p2==='schoolday'            ?'selected':''?>>School Day (8:30am &ndash; 3:00pm)</option>
                                <option value="fullday"              <?= $sel_p2==='fullday'              ?'selected':''?>>Full Day (6:30am &ndash; 6:30pm)</option>
                                <option value="After School"         <?= $sel_p2==='After School'         ?'selected':''?>>After School (5 yrs &ndash; 12 yrs)</option>
                                <option value="Before & After School" <?= $sel_p2==='Before & After School'?'selected':''?>>Before &amp; After School</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tour Date / Time -->
                <div class="tour-form-row">
                    <div class="tour-field">
                        <label class="tour-form-label">Preferred Tour Date <span class="imp">*</span></label>
                        <input type="text" name="t_start_date_field" id="t_start_date_field" class="tour-form-control" placeholder="Select a date" value="<?= htmlspecialchars($fd['t_start_date_field'] ?? '') ?>" required>
                    </div>
                    <div class="tour-field">
                        <label class="tour-form-label">Preferred Time <span class="imp">*</span></label>
                        <?php $sel_t = $fd['t_time_slot'] ?? ''; ?>
                        <select name="t_time_slot" class="tour-form-control" required>
                            <option value="">Select a time</option>
                            <option value="09:30AM-10:00AM" <?= $sel_t==='09:30AM-10:00AM'?'selected':''?>>09:30 AM &ndash; 10:00 AM</option>
                            <option value="10:00AM-10:30AM" <?= $sel_t==='10:00AM-10:30AM'?'selected':''?>>10:00 AM &ndash; 10:30 AM</option>
                            <option value="10:30AM-11:00AM" <?= $sel_t==='10:30AM-11:00AM'?'selected':''?>>10:30 AM &ndash; 11:00 AM</option>
                            <option value="11:00AM-11:30AM" <?= $sel_t==='11:00AM-11:30AM'?'selected':''?>>11:00 AM &ndash; 11:30 AM</option>
                            <option value="11:30AM-12:00PM" <?= $sel_t==='11:30AM-12:00PM'?'selected':''?>>11:30 AM &ndash; 12:00 PM</option>
                            <option value="2:30PM-3:00PM"   <?= $sel_t==='2:30PM-3:00PM'  ?'selected':''?>>2:30 PM &ndash; 3:00 PM</option>
                            <option value="3:00PM-3:30PM"   <?= $sel_t==='3:00PM-3:30PM'  ?'selected':''?>>3:00 PM &ndash; 3:30 PM</option>
                            <option value="3:30PM-4:00PM"   <?= $sel_t==='3:30PM-4:00PM'  ?'selected':''?>>3:30 PM &ndash; 4:00 PM</option>
                            <option value="4:00PM-4:30PM"   <?= $sel_t==='4:00PM-4:30PM'  ?'selected':''?>>4:00 PM &ndash; 4:30 PM</option>
                        </select>
                    </div>
                </div>

                <p class="tour-disclaimer">A parent or guardian must be present during the tour. Tours are offered on weekdays only. Our team will confirm your appointment within 24 hours.</p>

                <!-- Comment -->
                <div class="tour-field" style="margin-top:18px;">
                    <label class="tour-form-label">Your Comment (Optional)</label>
                    <textarea name="t_other_notes" class="tour-form-control" placeholder="Anything else we should know?"><?= htmlspecialchars($fd['t_other_notes'] ?? '') ?></textarea>
                </div>

                <!-- reCAPTCHA -->
                <div class="g-recaptcha mt-3" data-sitekey="<?= getenv('RECAPTCHA_SITE_KEY_TOUR') ?>"></div>

                <button type="submit" class="tour-submit-btn">Submit tour request</button>
            </form>
        </div>
    </div>
</section>

<!-- animation section -->
<style>
    .marquee-wrapper { overflow: hidden; white-space: nowrap; padding-bottom: 10px; }
    .marquee-track { display: inline-block; animation: marquee-scroll 15s linear infinite; }
    @keyframes marquee-scroll { 0% { transform: translateX(100vw); } 100% { transform: translateX(-100%); } }
</style>
<section class="home-content" style="background-color:#ffc000;padding-top:30px">
    <div class="marquee-wrapper"><div class="marquee-track"><img src="<?= base_url(); ?>assets/home/images/others/bus.png"></div></div>
</section>

<?php $this->load->view('common/footer'); ?>

<!-- datapicker JS -->
<script src="<?= base_url(); ?>assets/admin/js/datapicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    // â”€â”€ Add a child toggle â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    document.getElementById('addChildBtn').addEventListener('click', function () {
        var sec = document.getElementById('child2Section');
        var visible = sec.classList.toggle('visible');
        this.textContent = visible ? 'âœ• Remove second child' : '+ Add a child';
    });

    // â”€â”€ Disable school-closed dates from calendar â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    var datesForDisable = [];

    function getDatesInRange(start, end) {
        var arr = [], cur = moment(start, "DD/MM/YYYY"), stop = moment(end, "DD/MM/YYYY");
        while (cur <= stop) { arr.push(cur.format("DD/MM/YYYY")); cur = cur.add(1, 'days'); }
        return arr;
    }

    $.ajax({
        url: base_url + 'Schedule_a_tour/get_school_closed_events',
        type: 'get', dataType: 'json',
        success: function (response) {
            response.forEach(function (ev) {
                datesForDisable = datesForDisable.concat(getDatesInRange(ev.event_start, ev.event_end));
            });
            initDatepickers();
        },
        error: function () { initDatepickers(); }
    });

    function isDisabled(date) {
        return datesForDisable.indexOf(moment(date).format("DD/MM/YYYY")) !== -1;
    }

    function initDatepickers() {
        $("#t_start_date_field").datepicker({
            format: 'mm/dd/yyyy',
            daysOfWeekDisabled: [0, 6],
            autoclose: true, todayHighlight: true,
            startDate: new Date(),
            beforeShowDay: function (d) { return !isDisabled(d); }
        });

        $("#t_signature_date, #t_dob_1, #t_dob_2").datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true, todayHighlight: true
        });
    }

    // â”€â”€ Block link-injection (spam protection) â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    document.querySelectorAll('.tour-form-control').forEach(function (el) {
        el.addEventListener('input', function () {
            if (/https?:\/\/|www\./i.test(this.value)) {
                this.value = this.value.replace(/https?:\/\/\S*|www\.\S*/gi, '');
            }
        });
    });
});
</script>
