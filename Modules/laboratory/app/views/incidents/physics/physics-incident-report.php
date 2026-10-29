<?php

// Safely display database values.
function incidentReportValue($value)
{
    if ($value === null || $value === '') {
        return 'N/A';
    }

    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

// Format the incident date.
$incidentDate = 'N/A';

if (!empty($record['incident_date'])) {
    $timestamp = strtotime($record['incident_date']);

    if ($timestamp !== false) {
        $incidentDate = date('F d, Y h:i A', $timestamp);
    }
}

// Prepare status and severity.
$severity = strtolower($record['severity'] ?? 'low');
$status = strtolower($record['report_status'] ?? 'pending');

$severityColors = [
    'low'      => '#198754',
    'medium'   => '#fd7e14',
    'high'     => '#dc3545',
    'critical' => '#842029'
];

$severityColor = $severityColors[$severity] ?? '#6c757d';

$statusColors = [
    'pending'       => '#ffc107',
    'investigating' => '#0d6efd',
    'resolved'      => '#198754',
    'closed'        => '#6c757d'
];

$statusColor = $statusColors[$status] ?? '#6c757d';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Incident Report -
        <?= incidentReportValue($record['incident_number'] ?? '') ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #f1f3f5;
            font-family: Arial, Helvetica, sans-serif;
            color: #212529;
        }

        .report-toolbar {
            max-width: 900px;
            margin: 25px auto 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .report-paper {
            max-width: 900px;
            margin: 0 auto 40px;
            padding: 45px;
            background: #fff;
            border: 1px solid #dee2e6;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .school-header {
            width: 100%;
            padding: 10px 0 18px;
            margin-bottom: 25px;
            border-top: 3px solid #d9d9d9;
            border-bottom: 1px solid #b8b8b8;
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 65px;
        }

        .school-logo {
            width: 65px;
            height: 65px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .school-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .school-information {
            flex: 1;
        }

        .school-information h1 {
            font-family: "Times New Roman", serif;
            font-size: 17px;
            font-weight: normal;
            margin: 0 0 5px;
            color: #454545;
            letter-spacing: 0.3px;
        }

        .school-information p {
            font-family: "Times New Roman", serif;
            font-size: 11px;
            margin: 0;
            color: #555;
        }

        .form-heading {
            margin-top: 20px;
            padding-left: 5px;
            font-family: "Times New Roman", serif;
            font-size: 13px;
            font-weight: normal;
            letter-spacing: 0.4px;
            color: #333;
            text-transform: uppercase;
        }

        @media print {
            .school-header {
                border-top: 2px solid #d9d9d9;
                border-bottom: 1px solid #999;
                break-inside: avoid;
            }

            .school-brand {
                gap: 12px;
            }

            .school-information h1 {
                font-size: 16px;
            }

            .form-heading {
                font-size: 12px;
            }
        }

        .report-title {
            text-align: center;
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            background: #f1f3f5;
            border-left: 4px solid #343a40;
            padding: 10px 12px;
            margin: 25px 0 15px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
        }

        .detail-value {
            overflow-wrap: anywhere;
            white-space: pre-wrap;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .description-box {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            min-height: 80px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .signature-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-top: 65px;
        }

        .signature-line {
            border-top: 1px solid #212529;
            text-align: center;
            padding-top: 10px;
            font-size: 13px;
        }

        .report-footer {
            margin-top: 45px;
            padding-top: 12px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #6c757d;
            font-size: 11px;
        }

        @media (max-width: 600px) {
            .report-paper {
                padding: 20px;
                margin: 10px;
            }

            .detail-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .signature-section {
                gap: 25px;
            }
        }

        @page {
            size: A4;
            margin: 15mm;
        }

        @media print {
            body {
                background: #fff;
                font-size: 12px;
            }

            .no-print {
                display: none !important;
            }

            .report-toolbar {
                display: none !important;
            }

            .report-paper {
                max-width: none;
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
            }

            .report-header h1 {
                font-size: 21px;
            }

            .section-title {
                break-after: avoid;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .detail-row {
                break-inside: avoid;
            }

            .description-box {
                break-inside: avoid;
            }

            .signature-section {
                break-inside: avoid;
            }

            .report-footer {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- Toolbar: hidden when printing -->
    <div class="report-toolbar no-print">

        <a
            href="<?= BASE_URL ?>/physics-incident"
            class="btn btn-outline-secondary">
            &larr; Back to Incident Reports
        </a>

        <div class="d-flex gap-2">

            <button
                type="button"
                class="btn btn-primary"
                onclick="window.print()">
                <i class="bi bi-printer"></i>
                Print / Save as PDF
            </button>

        </div>

    </div>

    <!-- Printable report -->
    <main class="report-paper">
        <header class="school-header">
            <div class="school-brand">
                <div class="school-logo">
                    <img
                        src="/SchoolManagementSystem/assets/bcp-logo.png"
                        alt="Bestlink College of the Philippines Logo">
                </div>

                <div class="school-information">
                    <h1>BESTLINK COLLEGE OF THE PHILIPPINES</h1>
                    <p>IPO Road, Brgy. Minuyan Proper, City of San Jose del Monte, Bulacan</p>
                </div>
            </div>

            <div class="form-heading">
                PHYSICS LABORATORY INCIDENT REPORT
            </div>
        </header>


        <h2 class="report-title">
            INCIDENT REPORT
        </h2>

        <!-- Report reference -->
        <section>

            <div class="detail-row">
                <div class="detail-label">Incident Number</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['incident_number'] ?? '') ?>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Incident Date</div>

                <div class="detail-value">
                    <?= incidentReportValue($incidentDate) ?>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Incident Type</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['incident_type'] ?? '') ?>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Severity</div>

                <div class="detail-value">

                    <span
                        class="status-badge"
                        style="background-color: <?= htmlspecialchars($severityColor, ENT_QUOTES, 'UTF-8') ?>; color: #fff;">
                        <?= incidentReportValue(ucfirst($severity)) ?>
                    </span>

                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Report Status</div>

                <div class="detail-value">

                    <span
                        class="status-badge"
                        style="background-color: <?= htmlspecialchars($statusColor, ENT_QUOTES, 'UTF-8') ?>; color: <?= $status === 'pending' ? '#212529' : '#fff' ?>;">
                        <?= incidentReportValue(ucfirst($status)) ?>
                    </span>

                </div>
            </div>

        </section>

        <!-- Laboratory information -->
        <h3 class="section-title">
            Laboratory and Equipment Information
        </h3>

        <section>

            <div class="detail-row">
                <div class="detail-label">Laboratory</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['laboratory'] ?? '') ?>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Location Details</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['location_details'] ?? '') ?>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Equipment Name</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['item_name'] ?? '') ?>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Serial Number</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['serial_number'] ?? '') ?>
                </div>
            </div>

        </section>

        <!-- Incident details -->
        <h3 class="section-title">
            Incident Details
        </h3>

        <section>

            <div class="detail-label mb-2">
                Description of Incident
            </div>

            <div class="description-box">
                <?= incidentReportValue($record['description'] ?? '') ?>
            </div>

            <div class="detail-row mt-3">
                <div class="detail-label">People Involved</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['people_involved'] ?? '') ?>
                </div>
            </div>

            <div class="detail-label mt-4 mb-2">
                Action Taken
            </div>

            <div class="description-box">
                <?= incidentReportValue($record['action_taken'] ?? '') ?>
            </div>

        </section>

        <!-- Reporting information -->
        <h3 class="section-title">
            Reporting Information
        </h3>

        <section>

            <div class="detail-row">
                <div class="detail-label">Reported By</div>

                <div class="detail-value">
                    <?= incidentReportValue($record['reported_by'] ?? '') ?>
                </div>
            </div>

        </section>

        <!-- Signature area -->
        <section class="signature-section">

            <div class="signature-line">
                Reported By
            </div>

            <div class="signature-line">
                Reviewed / Approved By
            </div>

        </section>

        <footer class="report-footer">

            School Laboratory Management System
            <br>

            Physics Laboratory Incident Report

        </footer>

    </main>

    <script>
        // Open the browser print dialog.
        // Select "Save as PDF" as the printer to create a PDF file.
    </script>

</body>

</html>