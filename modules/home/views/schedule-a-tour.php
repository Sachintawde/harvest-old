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
    .tour-country-code { height: 40px; padding: 0 8px 0 10px; border: 1px solid #d1d5db; border-right: none; border-radius: 4px 0 0 4px; background: #f9fafb; font-size: 13px; color: #374151; cursor: pointer; outline: none; appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7280' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 8px center; padding-right: 26px; min-width: 90px; }
    .tour-country-code:focus { border-color: #4a90d9; box-shadow: 0 0 0 2px rgba(74,144,217,.15); }
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
    .field-error { display: block; color: #dc2626; font-size: 12px; margin-top: 4px; min-height: 16px; }
    input.is-invalid, select.is-invalid { border-color: #dc2626 !important; box-shadow: 0 0 0 2px rgba(220,38,38,.15) !important; }
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

                <?php /* Anti-spam: one-time form token */ ?>
                <input type="hidden" name="_tour_token" value="<?= htmlspecialchars($this->session->userdata('tour_form_token') ?? '', ENT_QUOTES, 'UTF-8') ?>">

                <?php /* Anti-spam: honeypot – invisible to real users; bots fill every field */ ?>
                <div style="position:absolute;left:-9999px;top:-9999px;width:0;height:0;overflow:hidden;" aria-hidden="true">
                    <label for="hp_website">Website (leave blank)</label>
                    <input type="text" id="hp_website" name="website" value="" tabindex="-1" autocomplete="off">
                </div>

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
                    <input type="email" name="t_mother_email" id="t_mother_email" class="tour-form-control" placeholder="email@example.com" value="<?= htmlspecialchars($fd['t_mother_email'] ?? '') ?>" required>
                    <span class="field-error" id="err_duplicate"></span>
                </div>

                <!-- Phone -->
                <div class="tour-field">
                    <label class="tour-form-label">Phone <span class="imp">*</span></label>
                    <div class="tour-phone-group">
                        <span class="tour-phone-prefix">&#127470;&#127475; +91</span>
                        <input type="hidden" name="t_country_code" id="t_country_code_val" value="+91">
                        <input type="tel" name="t_mother_phone" id="t_mother_phone" class="tour-form-control"
                               placeholder="10-digit mobile number (starts with 6-9)"
                               value="<?= htmlspecialchars($fd['t_mother_phone'] ?? '') ?>"
                               maxlength="10" inputmode="numeric"
                               autocomplete="tel" required>
                    </div>
                    <span class="field-error" id="err_phone"></span>
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
                        <?php
                            // Prefill: accept YYYY-MM-DD (new) or mm/dd/yyyy (legacy flashdata)
                            $prefill_dob1 = '';
                            if (!empty($fd['t_dob_1'])) {
                                $v = $fd['t_dob_1'];
                                // Already YYYY-MM-DD?
                                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $v)) {
                                    $prefill_dob1 = $v;
                                } else {
                                    $dt = DateTime::createFromFormat('!m/d/Y', $v);
                                    $prefill_dob1 = $dt ? $dt->format('Y-m-d') : '';
                                }
                            }
                        ?>
                        <input type="date" name="t_dob_1" id="t_dob_1_picker" class="tour-form-control"
                               min="1900-01-01" max="<?= date('Y-m-d') ?>"
                               value="<?= htmlspecialchars($prefill_dob1) ?>" required>
                        <span class="field-error" id="err_dob1"></span>
                    </div>
                    <div class="tour-field">
                        <label class="tour-form-label">Expected Start Date <span class="imp">*</span></label>
                        <?php
                            $prefill_sig = '';
                            if (!empty($fd['t_signature_date'])) {
                                $v = $fd['t_signature_date'];
                                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $v)) {
                                    $prefill_sig = $v;
                                } else {
                                    $dt = DateTime::createFromFormat('!m/d/Y', $v);
                                    $prefill_sig = $dt ? $dt->format('Y-m-d') : '';
                                }
                            }
                        ?>
                        <input type="date" name="t_signature_date" id="t_signature_date_picker" class="tour-form-control"
                               min="<?= date('Y-m-d') ?>"
                               value="<?= htmlspecialchars($prefill_sig) ?>" required>
                        <span class="field-error" id="err_sig_date"></span>
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
                            <?php $prefill_dob2_iso = !empty($fd['t_dob_2']) ? date('Y-m-d', strtotime($fd['t_dob_2'])) : ''; ?>
                            <input type="date" id="t_dob_2_picker" class="tour-form-control"
                                   min="<?= $dob_min ?>" max="<?= $dob_max ?>"
                                   value="<?= htmlspecialchars($prefill_dob2_iso) ?>">
                            <input type="hidden" name="t_dob_2" id="t_dob_2" value="<?= htmlspecialchars($fd['t_dob_2'] ?? '') ?>">
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
                        <?php
                            // Convert stored mm/dd/yyyy → YYYY-MM-DD for the native date input
                            $prefill_iso = !empty($fd['t_start_date_field'])
                                ? date('Y-m-d', strtotime($fd['t_start_date_field']))
                                : '';
                        ?>
                        <!-- Visible native date picker (no name – value is converted to mm/dd/yyyy in hidden field below) -->
                        <input type="date" id="t_start_date_picker" class="tour-form-control"
                               min="<?= date('Y-m-d') ?>"
                               value="<?= htmlspecialchars($prefill_iso) ?>"
                               required>
                        <!-- Hidden field carries the mm/dd/yyyy value the server expects -->
                        <input type="hidden" name="t_start_date_field" id="t_start_date_field"
                               value="<?= htmlspecialchars($fd['t_start_date_field'] ?? '') ?>">
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

                <!-- Comment -->
                <div class="tour-field" style="margin-top:18px;">
                    <label class="tour-form-label">Your Comment (Optional)</label>
                    <textarea name="t_other_notes" class="tour-form-control" placeholder="Anything else we should know?"><?= htmlspecialchars($fd['t_other_notes'] ?? '') ?></textarea>
                </div>


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
$(function () {

    // â”€â”€ Add a child toggle â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    document.getElementById('addChildBtn').addEventListener('click', function () {
        var sec = document.getElementById('child2Section');
        var visible = sec.classList.toggle('visible');
        this.textContent = visible ? 'âœ• Remove second child' : '+ Add a child';
    });

    // â”€â”€ Disable school-closed dates from calendar â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
    var closedDatesISO = []; // 'YYYY-MM-DD' strings for school-closed days
    function getDatesInRange(start, end) {
        // start/end arrive as DD/MM/YYYY from the server
        var arr = [], cur = moment(start, 'DD/MM/YYYY'), stop = moment(end, 'DD/MM/YYYY');
        while (cur <= stop) { arr.push(cur.format('YYYY-MM-DD')); cur = cur.add(1, 'days'); }
        return arr;
    }
    // ── Preferred Tour Date picker: registered after AJAX (needs school-closed dates) ───
    $.ajax({
        url: base_url + 'Schedule_a_tour/get_school_closed_events',
        type: 'get', dataType: 'json',
        success: function (response) {
            response.forEach(function (ev) {
                closedDatesISO = closedDatesISO.concat(getDatesInRange(ev.event_start, ev.event_end));
            });
            initDatepickers();
        },
        error: function () { initDatepickers(); }
    });
    function initDatepickers() {
        var $picker = $('#t_start_date_picker');
        var $hidden = $('#t_start_date_field');
        $picker.on('change', function () {
            var iso = this.value; // YYYY-MM-DD
            if (!iso) { $hidden.val(''); return; }
            var d   = new Date(iso + 'T00:00:00');
            var dow = d.getDay();
            if (dow === 0 || dow === 6) {
                this.value = ''; $hidden.val('');
                alert('We are closed on weekends. Please choose a weekday.');
                return;
            }
            if (closedDatesISO.indexOf(iso) !== -1) {
                this.value = ''; $hidden.val('');
                alert('The school is closed on that date. Please select another day.');
                return;
            }
            var parts    = iso.split('-');
            var mmddyyyy = parts[1] + '/' + parts[2] + '/' + parts[0];
            $hidden.val(mmddyyyy);
            fetchBookedSlots(mmddyyyy);
            checkDuplicate();
        });
        // If tour date is already pre-filled (form re-display after error)
        var prefilledDate = $hidden.val();
        if (prefilledDate) { fetchBookedSlots(prefilledDate); }
    }

    function fetchBookedSlots(date) {
        $.ajax({
            url: base_url + 'Schedule_a_tour/get_booked_slots',
            type: 'get',
            data: { date: date },
            dataType: 'json',
            success: function (bookedSlots) {
                var $select = $('select[name="t_time_slot"]');
                var currentVal = $select.val();
                $select.find('option').each(function () {
                    var val = $(this).val();
                    if (val === '') return; // skip placeholder
                    if (bookedSlots.indexOf(val) !== -1) {
                        $(this).attr('disabled', 'disabled').text($(this).text().replace(' (Booked)', '') + ' (Booked)');
                        if (currentVal === val) { $select.val(''); } // unselect if now booked
                    } else {
                        $(this).removeAttr('disabled').text($(this).text().replace(' (Booked)', ''));
                    }
                });
            }
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

    // ── Phone: digits only (no length/start-digit restriction) ─────────────────
    var $phone = $('#t_mother_phone');
    $phone.on('keypress', function (e) {
        if (e.which !== 0 && e.which !== 8 && e.which !== 9 && e.which !== 46 &&
            (e.which < 48 || e.which > 57)) {
            e.preventDefault();
        }
    });
    $phone.on('input', function () {
        this.value = this.value.replace(/\D/g, '').substring(0, 15);
    });
    $phone.on('paste', function (e) {
        e.preventDefault();
        var pasted = (e.originalEvent.clipboardData || window.clipboardData).getData('text');
        this.value = pasted.replace(/\D/g, '').substring(0, 15);
    });

    // ── Duplicate booking check (AJAX) ──────────────────────────────────────
    var duplicateBlocked = false;

    function checkDuplicate() {
        var dateIso  = $('#t_start_date_picker').val();
        var phone    = $('#t_mother_phone').val().replace(/\D/g, '');
        var email    = $.trim($('#t_mother_email').val()).toLowerCase();

        if (!dateIso || (!phone && !email)) {
            showErr('err_duplicate', '');
            duplicateBlocked = false;
            return;
        }

        $.ajax({
            url: base_url + 'Schedule_a_tour/check_duplicate',
            type: 'GET',
            data: { date: dateIso, phone: phone, email: email },
            dataType: 'json',
            success: function (res) {
                if (res.duplicate) {
                    showErr('err_duplicate', res.message);
                    duplicateBlocked = true;
                } else {
                    showErr('err_duplicate', '');
                    duplicateBlocked = false;
                }
            },
            error: function () {
                // On network error, allow submission — server will re-check
                duplicateBlocked = false;
            }
        });
    }

    $('#t_mother_phone').on('blur', checkDuplicate);
    $('#t_mother_email').on('blur', checkDuplicate);

    // ── Form submit: client-side gate ────────────────────────────────────────
    $('#Tour-form').on('submit', function (e) {
        var ok = true;

        // Sync tour date hidden field from picker if change event was missed
        var tourIso = $('#t_start_date_picker').val();
        if (tourIso && !$('#t_start_date_field').val()) {
            var td = new Date(tourIso + 'T00:00:00'), dow = td.getDay();
            if (dow !== 0 && dow !== 6 && closedDatesISO.indexOf(tourIso) === -1) {
                var tp = tourIso.split('-');
                $('#t_start_date_field').val(tp[1] + '/' + tp[2] + '/' + tp[0]);
            }
        }

        // Tour date must be selected
        if (!$('#t_start_date_field').val()) {
            ok = false;
        }

        // Block if duplicate detected
        if (duplicateBlocked) {
            ok = false;
        }

        if (!ok) {
            e.preventDefault();
            var $first = $('.field-error').filter(function () {
                return this.textContent.trim() !== '';
            }).first();
            if ($first.length) {
                $('html,body').animate({ scrollTop: $first.offset().top - 120 }, 300);
            }
        }
    });

    function showErr(id, msg) {
        var el = document.getElementById(id);
        if (el) el.textContent = msg;
    }
});
</script>
