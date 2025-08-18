<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Tour Reminder</title>
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
        <h2>Pre-Tour Reminder - Join the Harvest Green Montessori Family!</h2>
        <p>Dear Harvest Green Montessori Prospect Family,</p>
        <p>Thank you again for considering Harvest Green Montessori for your childcare needs. We are excited to have you become a part of our extended family and look forward to providing you with a tour on <a href="https://harvestgreenmontessori.com/Schedule_a_tour/tourdetails/<?= urlencode($t_id) ?>" target="_blank">View Your Booked Tour</a>.</p>
        <p>We provide your child with a well-rounded, high-quality early childhood education that is facilitated by dedicated, professional, and caring teachers in a fun and loving learning environment.</p>
        <p>We can't wait for you to see our state-of-the-art facility and meet our wonderful teaching staff! Spaces for our classrooms are still available, but we are filling up fast, so I encourage you to visit us for your tour on <a href="https://harvestgreenmontessori.com/Schedule_a_tour/tourdetails/<?= urlencode($t_id) ?>" target="_blank">View Your Booked Tour</a>.</p>
        <p>Please feel free to call or email me if you have any questions. Thank you so much for considering your neighborhood Montessori School for your child's academic future and growth.</p>
        <p>See you soon!</p>
        <p><strong>Warm Regards,</strong></p>
        <p>
            <strong>Lorena Corral</strong> - Director<br>
            Harvest Green Montessori School<br>
            4100 Harvest Corner Drive<br>
            Richmond, Texas 77406<br>
            Phone: <a href="tel:2818197529">281-819-7529</a><br>
            <a href="https://www.harvestgreenmontessori.com">www.harvestgreenmontessori.com</a>
        </p>
        <div class="footer">
            <p>"Free the child's potential, and you will transform him into the world."" - Maria Montessori</p>
        </div>
    </div>
</body>
</html>