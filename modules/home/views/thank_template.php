<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; line-height: 1.6; color: #333; }
        .container { max-width: 600px; background: #fff; margin: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background-color: #16a34a; color: #fff; padding: 28px 24px; text-align: center; }
        .header h2 { margin: 0 0 4px; font-size: 22px; }
        .header p { margin: 0; font-size: 13px; opacity: .85; }
        .content { padding: 28px 28px 20px; }
        .booking-card { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 16px 20px; margin: 20px 0; }
        .booking-card h3 { margin: 0 0 12px; color: #15803d; font-size: 14px; text-transform: uppercase; letter-spacing: .05em; }
        .booking-row { display: flex; gap: 24px; margin-bottom: 8px; }
        .booking-row:last-child { margin-bottom: 0; }
        .booking-row .bk-label { font-size: 12px; color: #6b7280; min-width: 80px; }
        .booking-row .bk-value { font-size: 14px; font-weight: 600; color: #111; }
        .divider { border: none; border-top: 1px solid #e5e7eb; margin: 20px 0; }
        .footer-sig { font-size: 14px; margin-top: 20px; }
        .email-footer { background: #f9fafb; padding: 16px 24px; text-align: center; font-size: 12px; color: #6b7280; border-top: 1px solid #e5e7eb; }
        .email-footer a { color: #16a34a; text-decoration: none; }
        .view-btn { display: inline-block; background: #16a34a; color: #fff !important; padding: 10px 22px; text-decoration: none; border-radius: 5px; font-weight: 600; font-size: 14px; margin: 8px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Tour Confirmed!</h2>
            <p>Harvest Green Montessori School</p>
        </div>

        <div class="content">
            <p>Dear <strong><?= htmlspecialchars($name) ?></strong>,</p>
            <p>Thank you for scheduling a tour with us! We are excited to show you our school and look forward to meeting you and your family.</p>

            <div class="booking-card">
                <h3>&#128197; Your Tour Details</h3>
                <div class="booking-row">
                    <span class="bk-label">Date</span>
                    <span class="bk-value"><?= htmlspecialchars($tour_date) ?></span>
                </div>
                <div class="booking-row">
                    <span class="bk-label">Time</span>
                    <span class="bk-value"><?= htmlspecialchars($tour_time) ?></span>
                </div>
                <div class="booking-row">
                    <span class="bk-label">Location</span>
                    <span class="bk-value">4100 Harvest Corner Drive, Richmond TX 77406</span>
                </div>
                <?php if (!empty($tour_program)): ?>
                <div class="booking-row">
                    <span class="bk-label">Program</span>
                    <span class="bk-value"><?= htmlspecialchars($tour_program) ?></span>
                </div>
                <?php endif; ?>
            </div>

            <p style="text-align:center">
                <a href="<?= base_url('Schedule_a_tour/tourdetails/') . urlencode($tour_id) ?>" class="view-btn" target="_blank">View Your Tour Details</a>
            </p>

            <hr class="divider">

            <p>A parent or guardian must be present during the tour. Our team will reach out to confirm your appointment within 24 hours. If you need to reschedule, please contact us as soon as possible.</p>

            <p>We can't wait to show you what a difference a Montessori education will make for your child!</p>

            <div class="footer-sig">
                <p><strong>Warm regards,</strong></p>
                <p>
                    <strong>Lorena Corral</strong> — Director<br>
                    Harvest Green Montessori School<br>
                    4100 Harvest Corner Drive, Richmond, Texas 77406<br>
                    Phone: <a href="tel:2818197529">281-819-7529</a><br>
                    <a href="https://www.harvestgreenmontessori.com">www.harvestgreenmontessori.com</a>
                </p>
            </div>
        </div>

        <div class="email-footer">
            <p>"Free the child's potential, and you will transform him into the world." &mdash; Maria Montessori</p>
            <p>We are conveniently located next door to James Neil Elementary School.</p>
        </div>
    </div>
</body>
</html>
