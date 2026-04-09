<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            color: red;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
        .social-icons img {
            width: 40px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <input type="hidden" name="phone" value="<?= htmlspecialchars($phone) ?>">
        <h2><?= htmlspecialchars($title) ?></h2>
        <p>Greetings <strong><?= htmlspecialchars($name) ?></strong>,</p>
        <p>Thank you for your interest in <?= htmlspecialchars($address) ?>! I am looking forward to meeting you during your visit and providing you with a tour of our facility on <a href="<?= base_url('Schedule_a_tour/tourdetails/') . urlencode($tour_id) ?>" target="_blank">View Your Booked Tour</a>.</p>
        <p>If you need to change the date or time of your tour, please contact us today or visit our website to make any changes.</p>
        <p>You may click on our website link to learn more: <a href="<?= base_url() ?>">www.harvestgreenmontessori.com</a>. Please do not hesitate to call if you have any questions! We are conveniently located next door to James Neil Elementary school.</p>
        <p>We can't wait to show you what a difference our Montessori school will be for your child!</p>
        <p><strong>Warm regards,</strong></p>
        <p>
            <strong>Lorena Corral</strong> - Director<br>
            Harvest Green Montessori School<br>
            4100 Harvest Corner Drive<br>
            Richmond, Texas 77406<br>
            Phone: <a href="tel:2818197529">281-819-7529</a><br>
            <a href="<?= base_url() ?>">www.harvestgreenmontessori.com</a>
        </p>
        <div class="footer">
            <p>"Free the child's potential, and you will transform him into the world." - Maria Montessori</p>
        </div>
    </div>
</body>
</html>
