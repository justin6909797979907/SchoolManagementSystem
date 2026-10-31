
<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/SchoolManagementSystem/Modules/laboratory');
}

$inventoryItems = $inventoryItems ?? [];

$incidentTypes = [
    'equipment damage',
    'equipment loss',
    'accident',
    'other'
];

$severities = ['low', 'medium', 'high', 'critical'];

$statuses = [
    'pending',
    'investigating',
    'resolved',
    'closed'
];
?>

<!-- =========================
     ADD INCIDENT MODAL
========================= -->
<div class="modal fade" id="psyAddIncidentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <div>
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-plus me-2"></i>
                        Add Psychology Incident Report
                    </h5>
                    <small>Record a new laboratory incident</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= BASE_URL ?>/psycho-incident/create"
                  method="POST"
                  id="psyAddIncidentForm">

                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">

                    <h6 class="text-primary fw-bold mb-3">Incident Information</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Incident Type <span class="text-danger">*</span></label>
                            <select name="incident_type" class="form-select" required>
                                <option value="">Select Incident Type</option>
                                <?php foreach ($incidentTypes as $type): ?>
                                    <option value="<?= htmlspecialchars($type) ?>">
                                        <?= htmlspecialchars(ucfirst($type)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Incident Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="incident_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Severity <span class="text-danger">*</span></label>
                            <select name="severity" class="form-select" required>
                                <option value="">Select Severity</option>
                                <?php foreach ($severities as $severity): ?>
                                    <option value="<?= htmlspecialchars($severity) ?>">
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
                                        <?= $status === 'pending' ? 'selected' : '' ?>>
                                        <?= htmlspecialchars(ucfirst($status)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary fw-bold mb-3">Laboratory and Equipment Information</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Laboratory</label>
                            <input type="text" name="laboratory" class="form-control"
                                   value="Psychology Laboratory" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Related Equipment</label>
                            <select name="inventory_id" class="form-select">
                                <option value="">No Specific Equipment</option>
                                <?php foreach ($inventoryItems as $item): ?>
                                    <option value="<?= (int) $item['id'] ?>">
                                        <?= htmlspecialchars($item['serial_number'] . ' - ' . $item['item_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Location Details</label>
                            <input type="text" name="location_details" class="form-control"
                                   placeholder="Enter incident location">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary fw-bold mb-3">Incident Details</h6>

                    <div class="mb-3">
                        <label class="form-label">Description of Incident <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Describe what happened..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">People Involved</label>
                        <textarea name="people_involved" class="form-control" rows="2"
                                  placeholder="Enter names of people involved"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Action Taken</label>
                        <textarea name="action_taken" class="form-control" rows="3"
                                  placeholder="Describe the actions taken..."></textarea>
                    </div>

                    <hr>

                    <h6 class="text-primary fw-bold mb-3">Reporting Information</h6>

                    <div class="mb-3">
                        <label class="form-label">Reported By <span class="text-danger">*</span></label>
                        <input type="text" name="reported_by" class="form-control"
                               placeholder="Enter reporting person's name" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Incident
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- =========================
     EDIT INCIDENT MODAL
========================= -->
<div class="modal fade" id="psyEditIncidentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <div>
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Psychology Incident Report
                    </h5>
                    <small>Update the selected incident record</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= BASE_URL ?>/psycho-incident/update"
                  method="POST"
                  id="psyEditIncidentForm">

                <input type="hidden" name="id" id="psy_edit_id">

                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">

                    <h6 class="text-primary fw-bold mb-3">Incident Information</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Incident Type <span class="text-danger">*</span></label>
                            <select name="incident_type" id="psy_edit_incident_type" class="form-select" required>
                                <option value="">Select Incident Type</option>
                                <?php foreach ($incidentTypes as $type): ?>
                                    <option value="<?= htmlspecialchars($type) ?>">
                                        <?= htmlspecialchars(ucfirst($type)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Incident Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="incident_date"
                                   id="psy_edit_incident_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Severity <span class="text-danger">*</span></label>
                            <select name="severity" id="psy_edit_severity" class="form-select" required>
                                <option value="">Select Severity</option>
                                <?php foreach ($severities as $severity): ?>
                                    <option value="<?= htmlspecialchars($severity) ?>">
                                        <?= htmlspecialchars(ucfirst($severity)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Report Status</label>
                            <select name="report_status" id="psy_edit_report_status" class="form-select">
                                <?php foreach ($statuses as $status): ?>
                                    <option value="<?= htmlspecialchars($status) ?>">
                                        <?= htmlspecialchars(ucfirst($status)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary fw-bold mb-3">Laboratory and Equipment Information</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Laboratory</label>
                            <input type="text" name="laboratory" id="psy_edit_laboratory"
                                   class="form-control" value="Psychology Laboratory" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Related Equipment</label>
                            <select name="inventory_id" id="psy_edit_inventory_id" class="form-select">
                                <option value="">No Specific Equipment</option>
                                <?php foreach ($inventoryItems as $item): ?>
                                    <option value="<?= (int) $item['id'] ?>">
                                        <?= htmlspecialchars($item['serial_number'] . ' - ' . $item['item_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Location Details</label>
                            <input type="text" name="location_details"
                                   id="psy_edit_location_details" class="form-control">
                        </div>

                    </div>

                    <hr>

                    <h6 class="text-primary fw-bold mb-3">Incident Details</h6>

                    <div class="mb-3">
                        <label class="form-label">Description of Incident <span class="text-danger">*</span></label>
                        <textarea name="description" id="psy_edit_description"
                                  class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">People Involved</label>
                        <textarea name="people_involved" id="psy_edit_people_involved"
                                  class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Action Taken</label>
                        <textarea name="action_taken" id="psy_edit_action_taken"
                                  class="form-control" rows="3"></textarea>
                    </div>

                    <hr>

                    <h6 class="text-primary fw-bold mb-3">Reporting Information</h6>

                    <div class="mb-3">
                        <label class="form-label">Reported By <span class="text-danger">*</span></label>
                        <input type="text" name="reported_by"
                               id="psy_edit_reported_by" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i> Update Incident
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
