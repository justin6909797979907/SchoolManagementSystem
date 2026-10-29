<?php include __DIR__ . '/../../includes/sidebar.php'; ?>
<?php include __DIR__ . '/../../includes/header.php'; ?>

<main class="main-content">
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
            <div class="custom-toast <?= $type ?>" role="<?= $type === 'error' ? 'alert' : 'status' ?>">
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

    <div class="container-fluid px-4">

        <h1 class="h3 mb-2 text-gray-800">Damages</h1>
        <p class="mb-4">Physics Laboratory</p>

        <div class="card mb-4 shadow-sm border-0 border-top border-4 border-secondary p-3">

            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Damage Records
                </div>

                <div class="d-flex gap-2">
                    <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#phyAddDamageModal">
                        <i class="fas fa-plus me-1"></i>
                        Create New
                    </button>

                    <a href="<?= BASE_URL ?>/physics-damage/inactive"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-box-archive me-2"></i>
                        Inactive Records
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="phyDamageTable"
                        class="table table-striped table-bordered align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Serial Number</th>
                                <th>Item Name</th>
                                <th>Laboratory</th>
                                <th>Issue Description</th>
                                <th>Accountable Department</th>
                                <th>Date Reported</th>
                                <th>Repair Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($damages)): ?>
                                <?php foreach ($damages as $row): ?>

                                    <?php
                                    $status = strtolower($row['repair_status'] ?? 'pending');

                                    $statusClass = match ($status) {
                                        'pending' => 'bg-danger text-white',
                                        'under repair' => 'bg-warning text-dark',
                                        'repaired' => 'bg-success text-white',
                                        'written off' => 'bg-dark text-white',
                                        default => 'bg-secondary text-white'
                                    };

                                    $date = !empty($row['date_reported'])
                                        ? date('M d, Y h:i A', strtotime($row['date_reported']))
                                        : '—';
                                    ?>

                                    <tr>
                                        <td>
                                            <?= (int) $row['id'] ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['serial_number'] ?? '—', ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['item_name'] ?? 'Unknown item', ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['laboratory'] ?? 'Physics Laboratory', ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['issue_description'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['accountable_department'] ?? 'Not assigned',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <span class="badge <?= $statusClass ?>">
                                                <?= htmlspecialchars(ucwords($status), ENT_QUOTES, 'UTF-8') ?>
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
                                                        <a href="#"
                                                            class="dropdown-item viewBtn"
                                                            data-id="<?= (int) $row['id'] ?>">
                                                            <i class="fas fa-eye me-2"></i>
                                                            View
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="#"
                                                            class="dropdown-item editBtn"
                                                            data-id="<?= (int) $row['id'] ?>">
                                                            <i class="fas fa-edit me-2"></i>
                                                            Edit
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>


                                                    <?php if (!empty($row['incident_id'])): ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?= BASE_URL ?>/physics-incident/view-page/<?= (int) $row['incident_id'] ?>">
                                                                <i class="fas fa-file-alt me-2"></i>
                                                                View Incident Report
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="<?= BASE_URL ?>/physics-incident/create-form?damage_id=<?= (int) $row['id'] ?>">
                                                                <i class="fas fa-file-circle-plus me-2"></i>
                                                                Incident Re..
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <li>
                                                        <a href="<?= BASE_URL ?>/physics-damage/deactivate/<?= (int) $row['id'] ?>"
                                                            class="dropdown-item text-danger"
                                                            onclick="return confirm('Are you sure you want to deactivate this damage record?');">
                                                            <i class="fas fa-ban me-2"></i>
                                                            Deactivate
                                                        </a>
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
</main>

<script>
    const BASE_URL = <?= json_encode(BASE_URL) ?>;

    $(document).ready(function() {
        $('#phyDamageTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
            order: [
                [0, 'desc']
            ]
        });
    });
</script>

<script src="<?= BASE_URL ?>/js/phyDamage.js"></script>

<?php require __DIR__ . '/phyAddDamageModal.php'; ?>
<?php require __DIR__ . '/phyEditDamageModal.php'; ?>
<?php require __DIR__ . '/phyViewDamageModal.php'; ?>

<?php include __DIR__ . '/../../includes/footer.php'; ?>