<!-- Success / Error Toast Notifications -->
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

                <button type="button"
                    class="toast-close"
                    aria-label="Close notification">&times;</button>

                <div class="toast-progress"></div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<div class="modal fade" id="itLab2AddInventoryModal" tabindex="-1"
    aria-labelledby="itLab2AddInventoryModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form
                id="itLab2AddInventoryForm"
                action="<?= BASE_URL ?>/it-lab2-inventory/create"
                method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="itLab2AddInventoryModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>
                        Add IT Laboratory 2 Item
                    </h5>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Serial Number -->
                        <div class="col-md-6">
                            <label for="it2_serial_number" class="form-label">
                                Serial Number / Asset Code
                            </label>

                            <input
                                type="text"
                                id="it2_serial_number"
                                name="serial_number"
                                class="form-control"
                                placeholder="e.g. IT2-PC-0001"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label for="it2_item_name" class="form-label">
                                Item Name
                            </label>

                            <input
                                type="text"
                                id="it2_item_name"
                                name="item_name"
                                class="form-control"
                                placeholder="e.g. Desktop Computer"
                                maxlength="150"
                                required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label for="it2_category" class="form-label">
                                Category
                            </label>

                            <input
                                type="text"
                                id="it2_category"
                                name="category"
                                class="form-control"
                                placeholder="e.g. Computer Equipment"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label for="it2_laboratory" class="form-label">
                                Laboratory
                            </label>

                            <input
                                type="text"
                                id="it2_laboratory"
                                name="laboratory"
                                class="form-control"
                                value="IT Lab 2"
                                readonly>
                        </div>

                        <!-- Condition -->
                        <div class="col-md-6">
                            <label for="it2_status" class="form-label">
                                Item Condition
                            </label>

                            <select
                                id="it2_status"
                                name="status"
                                class="form-select"
                                required>

                                <option value="" selected disabled>
                                    -- Select Condition --
                                </option>

                                <option value="working">Working</option>
                                <option value="under maintenance">Under Maintenance</option>
                                <option value="damage">Damage</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>

                    </div>

                    <div class="alert alert-info mt-3 mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Register each physical item separately. For example,
                        multiple desktop computers should have separate
                        records with unique serial numbers.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Item
                    </button>

                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>