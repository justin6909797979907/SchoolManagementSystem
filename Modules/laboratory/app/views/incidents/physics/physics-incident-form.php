
<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/SchoolManagementSystem/Modules/laboratory');
}

$record = $record ?? [];
$inventoryItems = $inventoryItems ?? [];

$isEdit = !empty($record['id']);

$formAction = $isEdit
    ? BASE_URL . '/physics-incident/update'
    : BASE_URL . '/physics-incident/create';

$incidentTypes = [
    'equipment damage',
    'equipment loss',
    'accident',
    'other'
];

$severities = ['low', 'medium', 'high', 'critical'];
$statuses = ['pending', 'investigating', 'resolved', 'closed'];

$incidentDate = !empty($record['incident_date'])
    ? date('Y-m-d\TH:i', strtotime($record['incident_date']))
    : date('Y-m-d\TH:i');

// Adjust this path if your shared includes are stored elsewhere.
$includesPath = __DIR__ . '/../../includes';

require_once $includesPath . '/sidebar.php';
require_once $includesPath . '/header.php';
?>


<main class="main-content">
<div class="container-fluid px-4">

    <div class="mb-4">
        <h3><?= $isEdit ? 'Edit Incident Report' : 'Create Incident Report' ?></h3>
        <p class="text-muted">
            <?= $isEdit
                ? 'Update the incident details below.'
                : 'Enter the details of the laboratory incident.' ?>
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form method="POST" action="<?= htmlspecialchars($formAction) ?>">

                <?php if (!empty($record['damage_id'])): ?>
                    <input type="hidden" name="damage_id"
                           value="<?= (int) $record['damage_id'] ?>">
                <?php endif; ?>

                <?php if ($isEdit): ?>
                    <input type="hidden" name="id"
                           value="<?= (int) $record['id'] ?>">
                <?php endif; ?>

                <div class="row g-3">

                    <?php if ($isEdit): ?>
                        <div class="col-md-6">
                            <label class="form-label">Incident Number</label>
                            <input type="text" class="form-control"
                                   value="<?= htmlspecialchars($record['incident_number'] ?? '') ?>"
                                   readonly>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-6">
                        <label class="form-label">Incident Type <span class="text-danger">*</span></label>
                        <select name="incident_type" class="form-select" required>
                            <option value="">Select incident type</option>
                            <?php foreach ($incidentTypes as $type): ?>
                                <option value="<?= htmlspecialchars($type) ?>"
                                    <?= ($record['incident_type'] ?? '') === $type ? 'selected' : '' ?>>
                                    <?= htmlspecialchars(ucwords($type)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Incident Date and Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="incident_date"
                               class="form-control"
                               value="<?= htmlspecialchars($incidentDate) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Laboratory <span class="text-danger">*</span></label>
                        <input type="text" name="laboratory" class="form-control"
                               value="<?= htmlspecialchars($record['laboratory'] ?? 'Physics Laboratory') ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Location Details</label>
                        <input type="text" name="location_details" class="form-control"
                               placeholder="e.g. Front workstation"
                               value="<?= htmlspecialchars($record['location_details'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Related Inventory Item</label>
                        <select name="inventory_id" class="form-select">
                            <option value="">No related inventory item</option>
                            <?php foreach ($inventoryItems as $item): ?>
                                <option value="<?= (int) $item['id'] ?>"
                                    <?= (string) ($record['inventory_id'] ?? '') === (string) $item['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars(
                                        ($item['serial_number'] ?? '') . ' - ' .
                                        ($item['item_name'] ?? '')
                                    ) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Reported By <span class="text-danger">*</span></label>
                        <input type="text" name="reported_by" class="form-control"
                               value="<?= htmlspecialchars($record['reported_by'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">People Involved</label>
                        <textarea name="people_involved" class="form-control"
                                  rows="2"><?= htmlspecialchars($record['people_involved'] ?? '') ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Severity <span class="text-danger">*</span></label>
                        <select name="severity" class="form-select" required>
                            <?php foreach ($severities as $severity): ?>
                                <option value="<?= htmlspecialchars($severity) ?>"
                                    <?= ($record['severity'] ?? 'low') === $severity ? 'selected' : '' ?>>
                                    <?= htmlspecialchars(ucfirst($severity)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Report Status</label>
                        <select name="report_status" class="form-select">
                            <?php foreach ($statuses as $status): ?>
                                <option value="<?= htmlspecialchars($status) ?>"
                                    <?= ($record['report_status'] ?? 'pending') === $status ? 'selected' : '' ?>>
                                    <?= htmlspecialchars(ucfirst($status)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Incident Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control"
                                  rows="4" required><?= htmlspecialchars($record['description'] ?? '') ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Action Taken</label>
                        <textarea name="action_taken" class="form-control"
                                  rows="3"><?= htmlspecialchars($record['action_taken'] ?? '') ?></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= BASE_URL ?>/physics-incident"
                       class="btn btn-outline-secondary">Cancel</a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        <?= $isEdit ? 'Update Incident' : 'Save Incident' ?>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
</main>

<?php require_once $includesPath . '/footer.php'; ?>
