<!-- application/views/error_view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <!-- Add your CSS styles or link to external stylesheets here -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/home/css/bootstrap.min.css">
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
            color: #f50318;
        }

        p {
            color: #333;
        }
    </style>
</head>
<body>
    <div id="container" class="text-center">
        <p class="alert alert-danger"><?php echo $error; ?></p>
        <!-- You can add more styling and content as needed -->
         <!-- Back button -->
         <a href="javascript:history.go(-1)" class="btn btn-primary button">Go Back</a>
    </div>
</body>
</html>
