<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Details</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: 600;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            overflow: hidden;
            border-radius: 8px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 16px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
        }
        tr:last-child td {
            border-bottom: none;
        }
        td {
            background: #fafafa;
            font-weight: 500;
            color: #444;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            table, th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tour Details</h2>
        <table>
            <tr><th>Mother First & Last Name</th><td><?= htmlspecialchars($tour->t_mother_name) ?></td></tr>
            <tr><th>Mother's Phone</th><td><?= htmlspecialchars($tour->t_mother_phone) ?></td></tr>
            <tr><th>Mother's Email</th><td><?= htmlspecialchars($tour->t_mother_email) ?></td></tr>
            <tr><th>Father First & Last Name</th><td><?= htmlspecialchars($tour->t_father_name) ?></td></tr>
            <tr><th>Father's Phone</th><td><?= htmlspecialchars($tour->t_father_phone) ?></td></tr>
            <tr><th>Father's Email</th><td><?= htmlspecialchars($tour->t_father_email) ?></td></tr>
            <tr><th>Preferred Communication Method</th><td><?= htmlspecialchars($tour->t_communication_method) ?></td></tr>
            <tr><th>Tour Start Date</th><td><?= htmlspecialchars($tour->t_start_date_field) ?></td></tr>
            <tr><th>Time Slot</th><td><?= htmlspecialchars($tour->t_time_slot) ?></td></tr>
            <tr><th>Previous School</th><td><?= htmlspecialchars($tour->t_previous_school) ?></td></tr>
            <tr><th>Important Factors</th><td><?= htmlspecialchars($tour->t_important_factors) ?></td></tr>
            <tr><th>How Did You Hear About Us?</th><td><?= htmlspecialchars($tour->t_source) ?></td></tr>
            <tr><th>Referral Name</th><td><?= htmlspecialchars($tour->t_referral_name) ?></td></tr>
            <tr><th>Other Notes</th><td><?= htmlspecialchars($tour->t_other_notes) ?></td></tr>
            <tr><th>Programs Interested</th><td><?= htmlspecialchars($tour->t_program) ?></td></tr>
            <tr><th>Our Program (Age Group)</th><td><?= htmlspecialchars($tour->t_agegroups) ?></td></tr>
            <tr><th>Signature Date</th><td><?= htmlspecialchars($tour->t_signature_date) ?></td></tr>
            <!-- Child 1 Details -->
            <tr><th>Child 1 First Name</th><td><?= htmlspecialchars($tour->t_child_name_1) ?></td></tr>
            <tr><th>Child 1 Last Name</th><td><?= htmlspecialchars($tour->t_child_lname_1) ?></td></tr>
            <tr><th>Child 1 Gender</th><td><?= htmlspecialchars($tour->t_gender_1) ?></td></tr>
            <tr><th>Child 1 Date of Birth</th><td><?= htmlspecialchars($tour->t_dob_1) ?></td></tr>
            <tr><th>Child 1 Class</th><td><?= htmlspecialchars($tour->t_class_1) ?></td></tr>

            <!-- Child 2 Details -->
            <tr><th>Child 2 First Name</th><td><?= htmlspecialchars($tour->t_child_name_2) ?></td></tr>
            <tr><th>Child 2 Last Name</th><td><?= htmlspecialchars($tour->t_child_lname_2) ?></td></tr>
            <tr><th>Child 2 Gender</th><td><?= htmlspecialchars($tour->t_gender_2) ?></td></tr>
            <tr><th>Child 2 Date of Birth</th><td><?= htmlspecialchars($tour->t_dob_2) ?></td></tr>
            <tr><th>Child 2 Class</th><td><?= htmlspecialchars($tour->t_class_2) ?></td></tr>

            <!-- Address Details -->
            <tr><th>Address</th><td><?= htmlspecialchars($tour->t_address) ?></td></tr>
            <tr><th>City</th><td><?= htmlspecialchars($tour->t_city) ?></td></tr>
            <tr><th>State</th><td><?= htmlspecialchars($tour->t_state) ?></td></tr>
            <tr><th>ZIP Code</th><td><?= htmlspecialchars($tour->t_zip_code) ?></td></tr>
        </table>
        <div class="footer">
            <p>&copy; <?= date("Y") ?> Harvest Green Montessori School</p>
        </div>
    </div>
</body>
</html>
