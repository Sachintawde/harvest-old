<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            border-radius: 8px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            border-radius: 8px 8px 0 0;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
            background-color: aliceblue;
        }

        .footer {
            color: white;
            background-color: #4CAF50;
            border-radius: 0 0 8px 8px;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Career Form Submission</h2>
        </div>

        <div class="content">
            <p><strong>First Name:</strong> <?php echo $name; ?></p>
            <p><strong>Last Name:</strong> <?php echo $e_lname; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Position To Apply:</strong> <?php echo $position_to_apply; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
            <p><strong>Resume:</strong> 
                <a href="<?php echo $resume; ?>" class="download-btn" download>Download Resume</a>
            </p>
            <p><strong>Message:</strong> <?php echo nl2br($message); ?></p> 
        </div>

        <div class="footer">
            <p>This email was sent via the career form on your website.</p>
        </div>
    </div>
</body>
</html>
