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

        .form-section {
            margin-top: 20px;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Form Submission</h2>
        </div>

        <div class="content">
            <h5 class="bg-success text-white p-2">Child 1 information</h5>

            <p><strong>Child First Name:</strong> <?php echo isset($t_child_name_1) ? htmlspecialchars($t_child_name_1) : 'N/A'; ?></p>
            <p><strong>Child Last Name:</strong> <?php echo isset($t_child_lname_1) ? htmlspecialchars($t_child_lname_1) : 'N/A'; ?></p>
            <p><strong>Gender:</strong> <?php echo isset($t_gender_1) ? htmlspecialchars($t_gender_1) : 'N/A'; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo isset($t_dob_1) ? htmlspecialchars($t_dob_1) : 'N/A'; ?></p>
            <p><strong>Class:</strong> <?php echo isset($t_class_1) ? htmlspecialchars($t_class_1) : 'N/A'; ?></p>

            <h5 class="bg-success text-white p-2">Child 2 information</h5>

            <p><strong>Child First Name:</strong> <?php echo isset($t_child_name_2) ? htmlspecialchars($t_child_name_2) : 'N/A'; ?></p>
            <p><strong>Child Last Name:</strong> <?php echo isset($t_child_lname_2) ? htmlspecialchars($t_child_lname_2) : 'N/A'; ?></p>
            <p><strong>Gender 2:</strong> <?php echo isset($t_gender_2) ? htmlspecialchars($t_gender_2) : 'N/A'; ?></p>
            <p><strong>Date of Birth 2:</strong> <?php echo isset($t_dob_2) ? htmlspecialchars($t_dob_2) : 'N/A'; ?></p>
            <p><strong>Class 2:</strong> <?php echo isset($t_class_2) ? htmlspecialchars($t_class_2) : 'N/A'; ?></p>

            <h5 class="bg-success text-white p-2">Family Info</h5>

            <p><strong>Address:</strong> <?php echo isset($t_address) ? htmlspecialchars($t_address) : 'N/A'; ?></p>
            <p><strong>City:</strong> <?php echo isset($t_city) ? htmlspecialchars($t_city) : 'N/A'; ?></p>
            <p><strong>State:</strong> <?php echo isset($t_state) ? htmlspecialchars($t_state) : 'N/A'; ?></p>
            <p><strong>ZIP Code:</strong> <?php echo isset($t_zip_code) ? htmlspecialchars($t_zip_code) : 'N/A'; ?></p>

            <p><strong>Mother's First & Last Name:</strong> <?php echo isset($t_mother_name) ? htmlspecialchars($t_mother_name) : 'N/A'; ?></p>
            <p><strong>Mother's Phone:</strong> <?php echo isset($t_mother_phone) ? htmlspecialchars($t_mother_phone) : 'N/A'; ?></p>
            <p><strong>Mother's Email:</strong> <?php echo isset($t_mother_email) ? htmlspecialchars($t_mother_email) : 'N/A'; ?></p>

            <p><strong>Father's First & Last Name:</strong> <?php echo isset($t_father_name) ? htmlspecialchars($t_father_name) : 'N/A'; ?></p>
            <p><strong>Father's Phone:</strong> <?php echo isset($t_father_phone) ? htmlspecialchars($t_father_phone) : 'N/A'; ?></p>
            <p><strong>Father's Email:</strong> <?php echo isset($t_father_email) ? htmlspecialchars($t_father_email) : 'N/A'; ?></p>

            <p><strong>Preferred Communication Method:</strong> <?php echo isset($t_communication_method) ? htmlspecialchars($t_communication_method) : 'N/A'; ?></p>
            <p><strong>Requested Tour Date:</strong> <?php echo isset($t_start_date_field) ? htmlspecialchars($t_start_date_field) : 'N/A'; ?></p>
            <p><strong>Time Slot:</strong> <?php echo isset($t_time_slot) ? htmlspecialchars($t_time_slot) : 'N/A'; ?></p>

            <p><strong>Previous School:</strong> <?php echo isset($t_previous_school) ? htmlspecialchars($t_previous_school) : 'N/A'; ?></p>
            <p><strong>Important Factors:</strong> <?php echo isset($t_important_factors) ? htmlspecialchars($t_important_factors) : 'N/A'; ?></p>

            <p><strong>How Did You Hear About Us:</strong> <?php echo isset($t_source) ? htmlspecialchars($t_source) : 'N/A'; ?></p>
            <p><strong>Referral Name:</strong> <?php echo isset($t_referral_name) ? htmlspecialchars($t_referral_name) : 'N/A'; ?></p>
            <p><strong>Other Notes:</strong> <?php echo isset($t_other_notes) ? htmlspecialchars($t_other_notes) : 'N/A'; ?></p>

            <p><strong>Programs of Interest:</strong> <?php echo isset($t_program) ? htmlspecialchars($t_program) : 'N/A'; ?></p>
            <p><strong>Our Program (Age Group):</strong> <?php echo isset($t_agegroups) ? htmlspecialchars($t_agegroups) : 'N/A'; ?></p>
            <p><strong>Date:</strong> <?php echo isset($t_signature_date) ? htmlspecialchars($t_signature_date) : 'N/A'; ?></p>
        </div>

        <div class="footer">
            <p>This email was sent via the contact form on your website.</p>
        </div>
    </div>
</body>

</html>