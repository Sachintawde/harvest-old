<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Tour Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 620px; margin: 0 auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background-color: #16a34a; color: #fff; padding: 24px 28px; text-align: center; }
        .header h2 { margin: 0 0 4px; font-size: 22px; }
        .header p { margin: 0; font-size: 13px; opacity: .85; }
        .highlight-box { background: #f0fdf4; border-left: 4px solid #16a34a; margin: 20px 24px 0; padding: 14px 16px; border-radius: 4px; }
        .highlight-box p { margin: 4px 0; font-size: 15px; }
        .highlight-box strong { color: #15803d; }
        .content { padding: 20px 28px 24px; }
        .section-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: #16a34a; border-bottom: 1px solid #d1fae5; padding-bottom: 6px; margin: 22px 0 12px; }
        .row { display: flex; gap: 0; margin-bottom: 8px; }
        .field { flex: 1; padding: 0; }
        .label { font-size: 12px; color: #6b7280; margin-bottom: 1px; }
        .value { font-size: 14px; color: #111; font-weight: 500; }
        .full { margin-bottom: 8px; }
        .note-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; padding: 10px 14px; font-size: 14px; color: #374151; margin-top: 4px; }
        .ref { font-size: 12px; color: #9ca3af; text-align: right; margin-top: 16px; }
        .footer { background-color: #16a34a; color: #fff; padding: 12px 20px; text-align: center; font-size: 12px; }
        .footer a { color: #d1fae5; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h2>New Tour Request</h2>
            <p>Harvest Green Montessori School — Admin Notification</p>
        </div>

        <!-- Tour Date/Time highlight -->
        <div class="highlight-box">
            <p>&#128197; <strong>Tour Date:</strong> <?php echo isset($t_start_date_field) ? htmlspecialchars($t_start_date_field) : 'N/A'; ?></p>
            <p>&#128336; <strong>Time Slot:</strong> <?php echo isset($t_time_slot) ? htmlspecialchars($t_time_slot) : 'N/A'; ?></p>
            <p>&#127979; <strong>Program:</strong> <?php echo isset($t_program) ? htmlspecialchars($t_program) : 'N/A'; ?></p>
        </div>

        <div class="content">

            <!-- Guardian -->
            <div class="section-title">Guardian / Parent</div>
            <div class="row">
                <div class="field">
                    <div class="label">Full Name</div>
                    <div class="value"><?php echo isset($t_mother_name) ? htmlspecialchars($t_mother_name) : 'N/A'; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="field">
                    <div class="label">Email</div>
                    <div class="value"><?php echo isset($t_mother_email) ? htmlspecialchars($t_mother_email) : 'N/A'; ?></div>
                </div>
                <div class="field">
                    <div class="label">Phone</div>
                    <div class="value"><?php echo isset($t_mother_phone) ? htmlspecialchars($t_mother_phone) : 'N/A'; ?></div>
                </div>
            </div>
            <?php if (!empty($t_source)): ?>
            <div class="full">
                <div class="label">How did they hear about us</div>
                <div class="value"><?php echo htmlspecialchars($t_source); ?></div>
            </div>
            <?php endif; ?>

            <!-- Child 1 -->
            <div class="section-title">Child 1</div>
            <div class="row">
                <div class="field">
                    <div class="label">First Name</div>
                    <div class="value"><?php echo !empty($t_child_name_1) ? htmlspecialchars($t_child_name_1) : '—'; ?></div>
                </div>
                <div class="field">
                    <div class="label">Last Name</div>
                    <div class="value"><?php echo !empty($t_child_lname_1) ? htmlspecialchars($t_child_lname_1) : '—'; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="field">
                    <div class="label">Date of Birth</div>
                    <div class="value"><?php echo !empty($t_dob_1) ? htmlspecialchars($t_dob_1) : '—'; ?></div>
                </div>
                <div class="field">
                    <div class="label">Expected Start Date</div>
                    <div class="value"><?php echo !empty($t_signature_date) ? htmlspecialchars($t_signature_date) : '—'; ?></div>
                </div>
            </div>

            <?php
            $has_child2 = !empty($t_child_name_2) || !empty($t_child_lname_2) || !empty($t_dob_2);
            if ($has_child2):
            ?>
            <!-- Child 2 -->
            <div class="section-title">Child 2</div>
            <div class="row">
                <div class="field">
                    <div class="label">First Name</div>
                    <div class="value"><?php echo !empty($t_child_name_2) ? htmlspecialchars($t_child_name_2) : '—'; ?></div>
                </div>
                <div class="field">
                    <div class="label">Last Name</div>
                    <div class="value"><?php echo !empty($t_child_lname_2) ? htmlspecialchars($t_child_lname_2) : '—'; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="field">
                    <div class="label">Date of Birth</div>
                    <div class="value"><?php echo !empty($t_dob_2) ? htmlspecialchars($t_dob_2) : '—'; ?></div>
                </div>
                <?php if (!empty($t_class_2)): ?>
                <div class="field">
                    <div class="label">Program</div>
                    <div class="value"><?php echo htmlspecialchars($t_class_2); ?></div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($t_other_notes)): ?>
            <!-- Notes -->
            <div class="section-title">Additional Notes</div>
            <div class="note-box"><?php echo nl2br(htmlspecialchars($t_other_notes)); ?></div>
            <?php endif; ?>

            <div class="ref">Tour ID: #<?php echo isset($tour_id) ? (int)$tour_id : 'N/A'; ?></div>
        </div>

        <div class="footer">
            <p>Harvest Green Montessori School &bull; 4100 Harvest Corner Drive, Richmond TX 77406</p>
            <p><a href="tel:2818197529">281-819-7529</a> &bull; <a href="https://www.harvestgreenmontessori.com">www.harvestgreenmontessori.com</a></p>
        </div>
    </div>
</body>
</html>