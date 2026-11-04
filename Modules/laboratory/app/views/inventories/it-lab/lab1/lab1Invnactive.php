<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php include __DIR__ . '/../../../includes/sidebar.php'; ?>
<?php include __DIR__ . '/../../../includes/header.php'; ?>

<main class="main-content">

    <!-- Success and Error Notifications -->
    <?php
    $flashMessages = [
        'success' => $_SESSION['success'] ?? null,
        'error'   => $_SESSION['error'] ?? null
    ];

    unset($_SESSION['success'], $_SESSION['error']);
    ?>

    <?php foreach ($flashMessages as $type => $message): ?>
        <?php if (!empty($message)): ?>
            <div class="custom-toast <?= $type ?>"
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

    <div class="container-fluid px-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Inactive IT Laboratory 1 Inventory</h3>
                <p class="text-muted mb-0">
                    Inventory items that have been deactivated.
                </p>
            </div>

            <a href="<?= BASE_URL ?>/it-lab1-inventory"
                class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Inventory
            </a>
        </div>

        <div class="card mb-4 shadow-sm border-0 border-top border-4 border-secondary">

            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-box-archive me-2"></i>
                    Inactive Inventory
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table id="itLab1InactiveInventoryTable"
                        class="table table-striped table-bordered align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Serial Number</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Laboratory</th>
                                <th>Condition</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($rows)): ?>

                                <?php foreach ($rows as $row): ?>

                                    <tr>
                                        <td>
                                            <?= htmlspecialchars((string) $row['id']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['serial_number'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['item_name'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['category'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['laboratory'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?php
                                            $status = strtolower($row['status'] ?? 'working');

                                            $statusClasses = [
                                                'working' => 'success',
                                                'under maintenance' => 'warning',
                                                'damage' => 'danger',
                                                'unavailable' => 'secondary'
                                            ];

                                            $badgeClass = $statusClasses[$status] ?? 'secondary';
                                            ?>

                                            <span class="badge bg-<?= $badgeClass ?>">
                                                <?= htmlspecialchars(ucwords($status)) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown">
                                                    Action
                                                </button>

                                                <ul class="dropdown-menu">

                                                    <li>
                                                        <a href="<?= BASE_URL ?>/it-lab1-inventory/view/<?= (int) $row['id'] ?>"
                                                            class="dropdown-item">
                                                            <i class="fas fa-eye me-2"></i>
                                                            View
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="<?= BASE_URL ?>/it-lab1-inventory/activate/<?= (int) $row['id'] ?>"
                                                            class="dropdown-item text-success"
                                                            onclick="return confirm('Are you sure you want to restore this item?');">
                                                            <i class="fas fa-undo me-2"></i>
                                                            Restore
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
    $(document).ready(function() {

        if ($.fn.DataTable.isDataTable('#itLab1InactiveInventoryTable')) {
            $('#itLab1InactiveInventoryTable').DataTable().destroy();
        }

        $('#itLab1InactiveInventoryTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                targets: 6,
                orderable: false,
                searchable: false
            }],
            language: {
                emptyTable: "No inactive IT Lab 1 inventory items found.",
                zeroRecords: "No matching inventory items found."
            }
        });

    });
</script>
<script src="<?= BASE_URL ?>/js/lab1Inventory.js"></script>

<?php include __DIR__ . '/../../../includes/footer.php'; ?>