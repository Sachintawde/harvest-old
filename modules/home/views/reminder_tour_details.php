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

        th,
        td {
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

            table,
            th,
            td {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tour Details</h2>
        <table>
            <!-- Child 1 -->
            <tr><th colspan="2" style="background:#2e7d32;">Child 1 Details</th></tr>
            <tr>
                <th>First Name</th>
                <td><?= htmlspecialchars($tour['t_child_name_1']) ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?= htmlspecialchars($tour['t_child_lname_1']) ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?= htmlspecialchars($tour['t_dob_1']) ?></td>
            </tr>
            <tr>
                <th>Program of Interest</th>
                <td><?= htmlspecialchars($tour['t_program']) ?></td>
            </tr>

            <?php if (!empty($tour['t_child_name_2'])) : ?>
            <!-- Child 2 -->
            <tr><th colspan="2" style="background:#2e7d32;">Child 2 Details</th></tr>
            <tr>
                <th>First Name</th>
                <td><?= htmlspecialchars($tour['t_child_name_2']) ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?= htmlspecialchars($tour['t_child_lname_2']) ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?= htmlspecialchars($tour['t_dob_2']) ?></td>
            </tr>
            <tr>
                <th>Program / Class</th>
                <td><?= htmlspecialchars($tour['t_class_2']) ?></td>
            </tr>
            <?php endif; ?>

            <!-- Guardian -->
            <tr><th colspan="2" style="background:#2e7d32;">Parent / Guardian Information</th></tr>
            <tr>
                <th>Guardian Name</th>
                <td><?= htmlspecialchars($tour['t_mother_name']) ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?= htmlspecialchars($tour['t_mother_phone']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($tour['t_mother_email']) ?></td>
            </tr>

            <!-- Tour -->
            <tr><th colspan="2" style="background:#2e7d32;">Tour Information</th></tr>
            <tr>
                <th>Tour Date</th>
                <td><?= htmlspecialchars($tour['t_start_date_field']) ?></td>
            </tr>
            <tr>
                <th>Time Slot</th>
                <td><?= htmlspecialchars($tour['t_time_slot']) ?></td>
            </tr>

            <!-- Additional -->
            <tr><th colspan="2" style="background:#2e7d32;">Additional Information</th></tr>
            <tr>
                <th>How Did You Hear About Us?</th>
                <td><?= htmlspecialchars($tour['t_source']) ?></td>
            </tr>
            <?php if (!empty($tour['t_referral_name'])) : ?>
            <tr>
                <th>Referral Name</th>
                <td><?= htmlspecialchars($tour['t_referral_name']) ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th>Signature Date</th>
                <td><?= htmlspecialchars($tour['t_signature_date']) ?></td>
            </tr>
        </table>
        <div class="footer">
            <p>&copy; <?= date("Y") ?> Harvest Green Montessori School</p>
        </div>
    </div>
</body>

</html>