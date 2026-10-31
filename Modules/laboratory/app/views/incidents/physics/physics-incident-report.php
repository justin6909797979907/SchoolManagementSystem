<?php

if (!defined('BASE_URL')) {
    define('BASE_URL', '/SchoolManagementSystem/Modules/laboratory');
}

$record = $record ?? [];

// Safely display database values.
function reportValue($value)
{
    return htmlspecialchars(
        (string) ($value ?? 'N/A'),
        ENT_QUOTES,
        'UTF-8'
    );
}

// Format incident date.
function reportDate($date)
{
    if (empty($date)) {
        return 'N/A';
    }

    $timestamp = strtotime($date);

    return $timestamp !== false
        ? date('F d, Y h:i A', $timestamp)
        : 'N/A';
}

// Incident information.
$incidentNumber = $record['incident_number'] ?? 'N/A';
$incidentDate = reportDate($record['incident_date'] ?? null);
$incidentType = $record['incident_type'] ?? 'N/A';
$laboratory = $record['laboratory'] ?? 'Physics Laboratory';

// Severity and status.
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
        Physics Incident Report - <?= reportValue($incidentNumber) ?>
    </title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/incident-form.css">

</head>

<body>

    <!-- Toolbar -->
    <div class="toolbar">

        <a href="<?= BASE_URL ?>/physics-incident"
            class="btn btn-outline-secondary btn-sm">

            <i class="bi bi-arrow-left"></i>
            Back to Incident Reports

        </a>

        <button type="button"
            class="btn btn-primary btn-sm"
            onclick="window.print()">

            <i class="bi bi-printer"></i>
            Print / Save as PDF

        </button>

    </div>

    <!-- Printable Report -->
    <main class="report-paper">

        <!-- School Header -->
        <header class="school-header">

            <div class="school-brand">

                <div class="school-logo">

                    <img
                        src="/SchoolManagementSystem/assets/bcp-logo.png"
                        alt="Bestlink College of the Philippines Logo">

                </div>

                <div class="school-information">

                    <h1>BESTLINK COLLEGE OF THE PHILIPPINES</h1>

                    <p>
                        IPO Road, Brgy. Minuyan Proper,
                        City of San Jose del Monte, Bulacan
                    </p>

                    <p>Laboratory Management System</p>

                </div>

            </div>

            <div class="form-heading">
                PHYSICS LABORATORY INCIDENT REPORT
            </div>

        </header>

        <!-- Incident Information -->
        <h2 class="report-title">
            INCIDENT INFORMATION
        </h2>

        <section>

            <div class="detail-row">

                <div class="detail-label">
                    Incident Number
                </div>

                <div class="detail-value">
                    <?= reportValue($incidentNumber) ?>
                </div>

            </div>

            <div class="detail-row">

                <div class="detail-label">
                    Incident Date
                </div>

                <div class="detail-value">
                    <?= reportValue($incidentDate) ?>
                </div>

            </div>

            <div class="detail-row">

                <div class="detail-label">
                    Incident Type
                </div>

                <div class="detail-value">
                    <?= reportValue(ucwords($incidentType)) ?>
                </div>

            </div>

            <div class="detail-row">

                <div class="detail-label">
                    Severity
                </div>

                <div class="detail-value">

                    <span class="status-badge"
                        style="background-color: <?= htmlspecialchars($severityColor, ENT_QUOTES, 'UTF-8') ?>; color: #fff;">

                        <?= reportValue(ucfirst($severity)) ?>

                    </span>

                </div>

            </div>

            <div class="detail-row">

                <div class="detail-label">
                    Report Status
                </div>

                <div class="detail-value">

                    <span class="status-badge"
                        style="background-color: <?= htmlspecialchars($statusColor, ENT_QUOTES, 'UTF-8') ?>; color: <?= $status === 'pending' ? '#212529' : '#fff' ?>;">

                        <?= reportValue(ucfirst($status)) ?>

                    </span>

                </div>

            </div>

        </section>

        <!-- Laboratory and Equipment Information -->
        <h3 class="section-title">
            Laboratory and Equipment Information
        </h3>

        <section>

            <div class="detail-row">

                <div class="detail-label">
                    Laboratory
                </div>

                <div class="detail-value">
                    <?= reportValue($laboratory) ?>
                </div>

            </div>

            <div class="detail-row">

                <div class="detail-label">
                    Location Details
                </div>

                <div class="detail-value">
                    <?= reportValue($record['location_details'] ?? '') ?>
                </div>

            </div>

            <div class="detail-row">

                <div class="detail-label">
                    Equipment Name
                </div>

                <div class="detail-value">
                    <?= reportValue($record['item_name'] ?? '') ?>
                </div>

            </div>

            <div class="detail-row">

                <div class="detail-label">
                    Serial Number
                </div>

                <div class="detail-value">
                    <?= reportValue($record['serial_number'] ?? '') ?>
                </div>

            </div>

        </section>

        <!-- Incident Details -->
        <h3 class="section-title">
            Incident Details
        </h3>

        <section>

            <div class="detail-label mb-2">
                Description of Incident
            </div>

            <div class="description-box">
                <?= reportValue($record['description'] ?? '') ?>
            </div>

            <div class="detail-row mt-3">

                <div class="detail-label">
                    People Involved
                </div>

                <div class="detail-value">
                    <?= reportValue($record['people_involved'] ?? '') ?>
                </div>

            </div>

            <div class="detail-label mt-4 mb-2">
                Action Taken
            </div>

            <div class="description-box">
                <?= reportValue($record['action_taken'] ?? '') ?>
            </div>

        </section>

        <!-- Reporting Information -->
        <h3 class="section-title">
            Reporting Information
        </h3>

        <section>

            <div class="detail-row">

                <div class="detail-label">
                    Reported By
                </div>

                <div class="detail-value">
                    <?= reportValue($record['reported_by'] ?? '') ?>
                </div>

            </div>

        </section>

        <!-- Signature Area -->
        <section class="signature-section">

            <div class="signature-line">
                Reported By
            </div>

            <div class="signature-line">
                Reviewed / Approved By
            </div>

        </section>

        <!-- Footer -->
        <footer class="report-footer">

            School Laboratory Management System
            <br>

            Physics Laboratory Incident Report

        </footer>

    </main>

</body>

</html>