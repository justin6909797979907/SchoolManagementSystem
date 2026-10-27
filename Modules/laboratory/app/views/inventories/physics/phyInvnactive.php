<?php include __DIR__ . '/../../includes/sidebar.php'; ?>
<?php include __DIR__ . '/../../includes/header.php'; ?>

<main class="main-content">
    <div class="container-fluid px-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Inactive Physics Inventory</h3>
                <p class="text-muted mb-0">
                    Inventory items that have been deactivated.
                </p>
            </div>

            <a href="<?= BASE_URL ?>/physics-inventory"
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

                    <table id="physInactiveInventoryTable"
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
                                            <?= (int) $row['id'] ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['serial_number'] ?? '') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['item_name']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['category']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($row['laboratory']) ?>
                                        </td>

                                        <td>
                                            <?php
                                            $status = strtolower($row['status'] ?? '');

                                            $statusClasses = [
                                                'working' => 'bg-success',
                                                'under maintenance' => 'bg-warning text-dark',
                                                'damage' => 'bg-danger',
                                                'unavailable' => 'bg-secondary'
                                            ];

                                            $statusClass = $statusClasses[$status] ?? 'bg-secondary';
                                            ?>

                                            <span class="badge <?= $statusClass ?>">
                                                <?= htmlspecialchars(ucwords($status)) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-sm btn-secondary dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown">
                                                    Action
                                                </button>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="<?= BASE_URL ?>/physics-inventory/view/<?= (int) $row['id'] ?>">
                                                            <i class="fas fa-eye me-2"></i>
                                                            View
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            class="dropdown-item text-success"
                                                            href="<?= BASE_URL ?>/physics-inventory/activate/<?= (int) $row['id'] ?>"
                                                            onclick="return confirm('Are you sure you want to activate this item?');">
                                                            <i class="fas fa-check-circle me-2"></i>
                                                            Activate
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-box-open fa-2x mb-2"></i>
                                        <br>
                                        No inactive inventory items found.
                                    </td>
                                </tr>
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
        $('#physInactiveInventoryTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
            order: [
                [0, 'desc']
            ]
        });
    });
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>