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
    <title>Incident Report -<?= incidentReportValue($record['incident_number'] ?? '') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/incident-form.css">
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
            INCIDENT INFORMATION
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