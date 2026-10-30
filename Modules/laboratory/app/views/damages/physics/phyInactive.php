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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Inactive Physics Damages</h3>
                <p class="text-muted mb-0">
                    Damage records that have been deactivated.
                </p>
            </div>

            <a href="<?= BASE_URL ?>/physics-damage"
                class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Damages
            </a>
        </div>

        <div class="card mb-4 shadow-sm border-0 border-top border-4 border-secondary">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-box-archive me-2"></i>
                    Inactive Damage Records
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="phyInactiveDamageTable"
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
                            <?php if (!empty($rows)): ?>
                                <?php foreach ($rows as $row): ?>

                                    <?php
                                    $repairStatus = strtolower(
                                        $row['repair_status'] ?? 'pending'
                                    );

                                    $statusClass = match ($repairStatus) {
                                        'pending' => 'bg-danger text-white',
                                        'under repair' => 'bg-warning text-dark',
                                        'repaired' => 'bg-success text-white',
                                        'written off' => 'bg-dark text-white',
                                        default => 'bg-secondary text-white'
                                    };

                                    $dateReported = !empty($row['date_reported'])
                                        ? date(
                                            'M d, Y h:i A',
                                            strtotime($row['date_reported'])
                                        )
                                        : '—';
                                    ?>

                                    <tr>
                                        <td>
                                            <?= (int) $row['id'] ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['serial_number'] ?? '—',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['item_name'] ?? 'Unknown item',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['laboratory'] ?? 'Physics Laboratory',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['issue_description'] ?? '',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $row['accountable_department'] ?? 'Not assigned',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $dateReported,
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td>
                                            <span class="badge <?= $statusClass ?>">
                                                <?= htmlspecialchars(
                                                    ucwords($repairStatus),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-sm btn-secondary dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action
                                                </button>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a
                                                            class="dropdown-item viewBtn"
                                                            href="#"
                                                            data-id="<?= (int) $row['id'] ?>">
                                                            <i class="fas fa-eye me-2"></i>
                                                            View
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a
                                                            class="dropdown-item text-success"
                                                            href="<?= BASE_URL ?>/physics-damage/activate/<?= (int) $row['id'] ?>"
                                                            onclick="return confirm('Are you sure you want to activate this damage record?');">
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
                                    <td colspan="9"
                                        class="text-center text-muted py-4">
                                        <i class="fas fa-box-open fa-2x mb-2"></i>
                                        <br>
                                        No inactive damage records found.
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
        $('#phyInactiveDamageTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
            order: [
                [0, 'desc']
            ]
        });
    });
</script>
<script>
    const dismissToast = (toast) => {
        let hideTimer;

        function dismiss() {
            clearTimeout(hideTimer);

            if (toast.classList.contains("hiding")) return;

            toast.classList.add("hiding");

            setTimeout(() => toast.remove(), 500);
        }

        const closeButton = toast.querySelector(".toast-close");

        if (closeButton) {
            closeButton.addEventListener("click", dismiss);
        }

        hideTimer = setTimeout(dismiss, 5000);
    };

    document.querySelectorAll(".custom-toast").forEach(dismissToast);
</script>

<?php include __DIR__ . '/../../../includes/footer.php'; ?>