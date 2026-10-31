<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/SchoolManagementSystem/Modules/laboratory');
}

$rows = $rows ?? [];
?>

<?php include __DIR__ . '/../../includes/sidebar.php'; ?>
<?php include __DIR__ . '/../../includes/header.php'; ?>

<main class="main-content">
    <div class="container-fluid px-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Inactive Psychology Incident Reports</h3>
                <p class="text-muted mb-0">
                    View and restore archived Psychology Laboratory incidents.
                </p>
            </div>

            <a href="<?= BASE_URL ?>/psycho-incident"
                class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i>
                Back to Active Records
            </a>
        </div>

        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $flashMessages = [
            'success' => $_SESSION['success'] ?? null,
            'error'   => $_SESSION['error'] ?? null
        ];

        unset($_SESSION['success'], $_SESSION['error']);
        ?>

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

        <div class="card mb-4 shadow-sm border-0 border-top border-4 border-secondary p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-box-archive me-1"></i>
                    Archived Incident Records
                </span>

                <span class="badge bg-secondary">
                    <?= count($rows) ?> Archived
                </span>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table id="psyInactiveIncidentTable"
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
                            <?php foreach ($rows as $row): ?>

                                <?php
                                $severity = strtolower($row['severity'] ?? 'low');

                                $severityClasses = [
                                    'low'      => 'bg-success text-white',
                                    'medium'   => 'bg-warning text-dark',
                                    'high'     => 'bg-danger text-white',
                                    'critical' => 'bg-dark text-white'
                                ];

                                $status = strtolower($row['report_status'] ?? 'pending');

                                $statusClasses = [
                                    'pending'       => 'bg-warning text-dark',
                                    'investigating' => 'bg-primary text-white',
                                    'resolved'      => 'bg-success text-white',
                                    'closed'        => 'bg-secondary text-white'
                                ];

                                $date = !empty($row['incident_date'])
                                    ? date('M d, Y h:i A', strtotime($row['incident_date']))
                                    : '—';
                                ?>

                                <tr>
                                    <td><?= (int) $row['id'] ?></td>

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['incident_number'] ?? '—',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            ucwords($row['incident_type'] ?? ''),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8') ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['laboratory'] ?? 'Psychology Laboratory',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            $row['reported_by'] ?? '—',
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        <span class="badge <?= $severityClasses[$severity] ?? 'bg-secondary text-white' ?>">
                                            <?= htmlspecialchars(ucfirst($severity), ENT_QUOTES, 'UTF-8') ?>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge <?= $statusClasses[$status] ?? 'bg-secondary text-white' ?>">
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
                                                    <button
                                                        type="button"
                                                        class="dropdown-item view-inactive-psy-incident"
                                                        data-id="<?= (int) $row['id'] ?>">

                                                        <i class="fas fa-eye me-2"></i>
                                                        View
                                                    </button>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form method="POST"
                                                        action="<?= BASE_URL ?>/psycho-incident/activate/<?= (int) $row['id'] ?>"
                                                        onsubmit="return confirm('Are you sure you want to restore this incident report?');">

                                                        <button type="submit"
                                                            class="dropdown-item text-success">

                                                            <i class="fas fa-undo me-2"></i>
                                                            Activate
                                                        </button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Archived Incident Details Modal -->
    <div class="modal fade"
        id="inactivePsyIncidentViewModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Archived Psychology Incident Details</h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" id="inactivePsyIncidentViewContent">
                    Loading incident details...
                </div>

            </div>
        </div>
    </div>

</main>

<script>
    document.addEventListener('click', async function(event) {

        const button = event.target.closest('.view-inactive-psy-incident');

        if (!button) return;

        const id = button.dataset.id;

        const content = document.getElementById('inactivePsyIncidentViewContent');

        content.textContent = 'Loading incident details...';

        const modal = bootstrap.Modal.getOrCreateInstance(
            document.getElementById('inactivePsyIncidentViewModal')
        );

        modal.show();

        try {
            const response = await fetch(
                '<?= BASE_URL ?>/psycho-incident/view-inactive/' +
                encodeURIComponent(id)
            );

            const record = await response.json();

            if (!response.ok) {
                throw new Error(record.error || 'Unable to load incident.');
            }

            content.replaceChildren();

            const fields = [
                ['Incident Number', record.incident_number],
                ['Incident Type', record.incident_type],
                ['Date', record.incident_date],
                ['Laboratory', record.laboratory],
                ['Location', record.location_details],
                ['Description', record.description],
                ['Reported By', record.reported_by],
                ['People Involved', record.people_involved],
                ['Action Taken', record.action_taken],
                ['Severity', record.severity],
                ['Report Status', record.report_status],
                ['Inventory Item', record.item_name]
            ];

            fields.forEach(([label, value]) => {

                const wrapper = document.createElement('div');
                wrapper.className = 'mb-3';

                const heading = document.createElement('strong');
                heading.textContent = label;

                const paragraph = document.createElement('p');
                paragraph.className = 'mb-0';
                paragraph.textContent = value || 'Not provided';

                wrapper.append(heading, paragraph);
                content.appendChild(wrapper);
            });

        } catch (error) {
            content.textContent = error.message;
        }
    });

    $(document).ready(function() {
        $('#psyInactiveIncidentTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
            order: [
                [0, 'desc']
            ]
        });
    });
</script>

<script src="<?= BASE_URL ?>/js/psychIncident.js"></script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>