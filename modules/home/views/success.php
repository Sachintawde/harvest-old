<!-- success_view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .success-container {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
        }

        p {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Success!</h1>
        <?php if(isset($success)): ?>
            <p><?= $success ?></p>
        <?php endif; ?>.
        <p>Thank you!</p>
         <!-- Back button -->
         <a href="javascript:history.go(-1)" class="button">Go Back</a>
    </div>
</body>
</html>
