
<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/SchoolManagementSystem/Modules/laboratory');
}

$record = $record ?? [];

function reportValue($value)
{
    return htmlspecialchars((string) ($value ?? 'N/A'), ENT_QUOTES, 'UTF-8');
}

function reportDate($date)
{
    if (empty($date)) {
        return 'N/A';
    }

    return date('F d, Y', strtotime($date));
}

$incidentNumber = $record['incident_number'] ?? 'N/A';
$incidentDate = reportDate($record['incident_date'] ?? null);
$incidentType = $record['incident_type'] ?? 'N/A';
$severity = ucfirst($record['severity'] ?? 'N/A');
$reportStatus = ucfirst($record['report_status'] ?? 'N/A');
$laboratory = $record['laboratory'] ?? 'Psychology Laboratory';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Psychology Incident Report - <?= reportValue($incidentNumber) ?></title>

    <link href="<?= BASE_URL ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/psychoIncident.css">


</head>

<body>

<div class="toolbar">
    <a href="<?= BASE_URL ?>/psycho-incident"
       class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <button onclick="window.print()" class="btn btn-primary btn-sm">
        <i class="bi bi-printer"></i> Print Report
    </button>
</div>

<div class="report-paper">

    <!-- SCHOOL HEADER -->
    <div class="school-header">
        <img src="/SchoolManagementSystem/assets/bcp-logo.png"
             alt="School Logo">

        <div>
            <h5>BESTLINK COLLEGE OF THE PHILIPPINES</h5>
            <p>Laboratory Management System</p>
            <p>Psychology Laboratory</p>
            <p>Official Incident Documentation</p>
        </div>
    </div>

    <!-- DOCUMENT TITLE -->
    <div class="document-title">
        <h4>INCIDENT REPORT FORM</h4>
        <p>Psychology Laboratory</p>
    </div>

    <!-- REPORT REFERENCE -->
    <table class="info-table">
        <tr>
            <td class="label">Incident Report No.</td>
            <td><?= reportValue($incidentNumber) ?></td>
            <td class="label">Date Reported</td>
            <td><?= reportValue($incidentDate) ?></td>
        </tr>
    </table>

    <!-- SECTION 1 -->
    <div class="section-heading">I. Incident Information</div>

    <table class="info-table">
        <tr>
            <td class="label">Incident Type</td>
            <td><?= reportValue(ucwords($incidentType)) ?></td>
            <td class="label">Severity</td>
            <td><?= reportValue($severity) ?></td>
        </tr>
        <tr>
            <td class="label">Laboratory</td>
            <td><?= reportValue($laboratory) ?></td>
            <td class="label">Report Status</td>
            <td><?= reportValue($reportStatus) ?></td>
        </tr>
        <tr>
            <td class="label">Incident Date</td>
            <td colspan="3"><?= reportValue($incidentDate) ?></td>
        </tr>
        <tr>
            <td class="label">Location</td>
            <td colspan="3"><?= reportValue($record['location_details'] ?? 'N/A') ?></td>
        </tr>
        <tr>
            <td class="label">Equipment / Serial No.</td>
            <td colspan="3">
                <?= reportValue($record['item_name'] ?? 'N/A') ?>
                /
                <?= reportValue($record['serial_number'] ?? 'N/A') ?>
            </td>
        </tr>
    </table>

    <!-- SECTION 2 -->
    <div class="section-heading">II. Description of Incident</div>

    <div class="narrative-box">
        <?= reportValue($record['description'] ?? 'No description provided.') ?>
    </div>

    <!-- SECTION 3 -->
    <div class="section-heading">III. Persons Involved</div>

    <div class="narrative-box">
        <?= reportValue($record['people_involved'] ?? 'No information provided.') ?>
    </div>

    <!-- SECTION 4 -->
    <div class="section-heading">IV. Action Taken / Immediate Response</div>

    <div class="narrative-box">
        <?= reportValue($record['action_taken'] ?? 'No action recorded.') ?>
    </div>

    <!-- SECTION 5 -->
    <div class="section-heading">V. Reporting Information</div>

    <table class="info-table">
        <tr>
            <td class="label">Reported By</td>
            <td><?= reportValue($record['reported_by'] ?? 'N/A') ?></td>
        </tr>
    </table>

    <!-- SIGNATURES -->
    <div class="signature-section">
        <div>
            <div class="signature-line">
                <strong><?= reportValue($record['reported_by'] ?? '________________________') ?></strong>
                <br>
                Person Who Reported
            </div>
            <p>Date: __________________</p>
        </div>

        <div>
            <div class="signature-line">
                <strong>____________________________</strong>
                <br>
                Laboratory In-Charge
            </div>
            <p>Date: __________________</p>
        </div>
    </div>

    <div class="footer-note">
        This document is an official record of the Psychology Laboratory.
        Keep a copy for laboratory documentation and reference.
    </div>

</div>

</body>
</html>
