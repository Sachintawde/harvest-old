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
        <input type="hidden" name="phone" value="<?= htmlspecialchars($phone) ?>">
        <h2><?= htmlspecialchars($title) ?></h2>
        <p>Greetings <strong><?= htmlspecialchars($name) ?></strong>,</p>
        <p>Thank you for your interest in <?= htmlspecialchars($address) ?>! I am looking forward to meeting you during your visit and providing you with a tour of our facility on <a href="https://harvestgreenmontessori.com/Schedule_a_tour/tourdetails/<?= urlencode($tour_id) ?>" target="_blank">View Your Booked Tour</a>.</p>
        <p>If you need to change the date or time of your tour, please contact us today or visit our website to make any changes.</p>
        <p>You may click on our website link to learn more: <a href="https://harvestgreenmontessori.com/">www.harvestgreenmontessori.com</a>. Please do not hesitate to call if you have any questions! We are conveniently located next door to James Neil Elementary school.</p>
        <p>We can't wait to show you what a difference our Montessori school will be for your child!</p>
        <p><strong>Warm regards,</strong></p>
        <p>
            <strong>Lorena Corral</strong> - Director<br>
            Harvest Green Montessori School<br>
            4100 Harvest Corner Drive<br>
            Richmond, Texas 77406<br>
            Phone: <a href="tel:2818197529">281-819-7529</a><br>
            <a href="https://harvestgreenmontessori.com/">www.harvestgreenmontessori.com</a>
        </p>
        <div class="footer">
            <p>"Free the child's potential, and you will transform him into the world." - Maria Montessori</p>
        </div>
    </div>

        <div class="email-footer">
            <p>"Free the child's potential, and you will transform him into the world." &mdash; Maria Montessori</p>
            <p>We are conveniently located next door to James Neil Elementary School.</p>
        </div>
    </div>
</body>
</html>
