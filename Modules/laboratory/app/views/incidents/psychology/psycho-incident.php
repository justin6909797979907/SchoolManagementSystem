<?php include __DIR__ . '/../../includes/sidebar.php'; ?>
<?php include __DIR__ . '/../../includes/header.php'; ?>

<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/SchoolManagementSystem/Modules/laboratory');
}

$incidents = $incidents ?? [];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$flashMessages = [
    'success' => $_SESSION['success'] ?? null,
    'error'   => $_SESSION['error'] ?? null
];

unset($_SESSION['success'], $_SESSION['error']);
?>

<main class="main-content">
    <div class="container-fluid px-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Psychology Incident Reports</h3>
                <p class="text-muted mb-0">
                    Record and monitor incidents in the Psychology Laboratory.
                </p>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php foreach ($flashMessages as $type => $message): ?>
            <?php if (!empty($message)): ?>
                <div class="custom-toast <?= htmlspecialchars($type) ?>"
                    role="<?= $type === 'error' ? 'alert' : 'status' ?>">

                    <div class="toast-icon">
                        <?= $type === 'success' ? '✓' : '!' ?>
                    </div>

                    <div class="toast-content">
                        <div class="toast-title">
                            <?= $type === 'success' ? 'Success!' : 'Something went wrong' ?>
                        </div>

                        <div class="toast-message">
                            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    </div>

                    <button type="button" class="toast-close"
                        aria-label="Close notification">&times;</button>

                    <div class="toast-progress"></div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Incident Records Table -->
        <div class="card mb-4 shadow-sm border-0 border-top border-4 border-secondary p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Incident Records
                </div>

                <div class="d-flex gap-2">

                    <a href="<?= BASE_URL ?>/psycho-incident/inactive"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-box-archive me-2"></i>
                        Inactive Records
                    </a>

                    <button type="button"
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#psyAddIncidentModal">

                        <i class="fas fa-plus me-1"></i>
                        Create New
                    </button>

                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table id="psyIncidentTable"
                        class="table table-striped table-bordered align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Incident No.</th>
                                <th>Incident Type</th>
                                <th>Incident Date</th>
                                <th>Laboratory</th>
                                <th>Reported By</th>
                                <th>Severity</th>
                                <th>Report Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($incidents)): ?>

                                <?php foreach ($incidents as $row): ?>

                                    <?php
                                    $severity = strtolower($row['severity'] ?? 'low');

                                    $severityClasses = [
                                        'low'      => 'bg-success text-white',
                                        'medium'   => 'bg-warning text-dark',
                                        'high'     => 'bg-danger text-white',
                                        'critical' => 'bg-dark text-white'
                                    ];

                                    $severityClass =
                                        $severityClasses[$severity] ?? 'bg-secondary text-white';

                                    $status = strtolower($row['report_status'] ?? 'pending');

                                    $statusClasses = [
                                        'pending'       => 'bg-warning text-dark',
                                        'investigating' => 'bg-primary text-white',
                                        'resolved'      => 'bg-success text-white',
                                        'closed'        => 'bg-secondary text-white'
                                    ];

                                    $statusClass =
                                        $statusClasses[$status] ?? 'bg-secondary text-white';

                                    $date = !empty($row['incident_date'])
                                        ? date('M d, Y h:i A', strtotime($row['incident_date']))
                                        : '—';
                                    ?>

                                    <tr>
                                        <td><?= (int) $row['id'] ?></td>

                                        <td>
                                            <?= htmlspecialchars($row['incident_number'] ?? '—', ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(ucwords($row['incident_type'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['laboratory'] ?? 'Psychology Laboratory', ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['reported_by'] ?? '—', ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <span class="badge <?= $severityClass ?>">
                                                <?= htmlspecialchars(ucfirst($severity), ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge <?= $statusClass ?>">
                                                <?= htmlspecialchars(ucfirst($status), ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="dropdown">

                                                <button
                                                    class="btn btn-secondary btn-sm dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action
                                                </button>

                                                <ul class="dropdown-menu">

                                                    <li>
                                                        <a
                                                            href="<?= BASE_URL ?>/psycho-incident/report/<?= (int) $row['id'] ?>"
                                                            class="dropdown-item"
                                                            target="_blank">

                                                            <i class="fas fa-eye me-2"></i>
                                                            View / Print
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <button
                                                            type="button"
                                                            class="dropdown-item editPsyIncidentBtn"
                                                            data-id="<?= (int) $row['id'] ?>">

                                                            <i class="fas fa-edit me-2"></i>
                                                            Edit
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    <li>
                                                        <form method="POST"
                                                            action="<?= BASE_URL ?>/psycho-incident/deactivate/<?= (int) $row['id'] ?>"
                                                            onsubmit="return confirm('Are you sure you want to deactivate this incident report?');">

                                                            <button type="submit"
                                                                class="dropdown-item text-danger">

                                                                <i class="fas fa-ban me-2"></i>
                                                                Deactivate
                                                            </button>
                                                        </form>
                                                    </li>

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>

    <!-- Add and Edit Incident Modals -->
    
</main>



<script>
    const BASE_URL = <?= json_encode(BASE_URL) ?>;
</script>

<script src="<?= BASE_URL ?>/js/psychIncident.js"></script>

<script>
    $(document).ready(function() {
        $('#psyIncidentTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
            order: [
                [0, 'desc']
            ]
        });
    });
</script>
<?php require_once __DIR__ . '/psycho-incident-form.php'; ?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>