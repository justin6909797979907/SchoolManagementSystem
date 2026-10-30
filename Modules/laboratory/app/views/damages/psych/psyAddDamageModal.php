<div class="modal fade"
    id="psyAddDamageModal"
    tabindex="-1"
    aria-labelledby="psyAddDamageModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form
                id="psyAddDamageForm"
                action="<?= BASE_URL ?>/psycho-damage/create"
                method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="psyAddDamageModalLabel">
                        <i class="fas fa-plus-square me-2"></i>
                        Add New Damage Record
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Record the accountable department first. Do not identify
                        an individual as responsible without sufficient evidence.
                    </div>

                    <div class="row g-3">

                        <!-- Inventory Item -->
                        <div class="col-md-6">
                            <label for="psy_damage_inventory_id" class="form-label">
                                Equipment / Item <span class="text-danger">*</span>
                            </label>

                            <select
                                name="inventory_id"
                                id="psy_damage_inventory_id"
                                class="form-select"
                                required>

                                <option value="" selected disabled>
                                    -- Select Equipment --
                                </option>

                                <?php if (!empty($inventoryItems)): ?>
                                    <?php foreach ($inventoryItems as $item): ?>
                                        <option
                                            value="<?= (int) $item['id'] ?>"
                                            data-laboratory="<?= htmlspecialchars(
                                                $item['laboratory'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>">

                                            <?= htmlspecialchars(
                                                $item['serial_number'] . ' - ' . $item['item_name'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>

                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </select>

                            <?php if (empty($inventoryItems)): ?>
                                <small class="text-danger">
                                    No active Psychology inventory items found.
                                    Add an item to the inventory first.
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label for="psy_damage_laboratory" class="form-label">
                                Laboratory
                            </label>

                            <input
                                type="text"
                                id="psy_damage_laboratory"
                                class="form-control"
                                value="Psychology Laboratory"
                                readonly>
                        </div>

                        <!-- Issue Description -->
                        <div class="col-md-12">
                            <label for="psy_damage_issue_description" class="form-label">
                                Issue Description <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="issue_description"
                                id="psy_damage_issue_description"
                                class="form-control"
                                rows="3"
                                placeholder="Describe the damage or equipment problem..."
                                required></textarea>
                        </div>

                        <!-- Accountable Department -->
                        <div class="col-md-6">
                            <label for="psy_damage_accountable_department" class="form-label">
                                Accountable Department <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="accountable_department"
                                id="psy_damage_accountable_department"
                                class="form-control"
                                placeholder="Enter department name"
                                required>
                        </div>

                        <!-- Reported By -->
                        <div class="col-md-6">
                            <label for="psy_damage_reported_by" class="form-label">
                                Reported By
                            </label>

                            <input
                                type="text"
                                name="reported_by"
                                id="psy_damage_reported_by"
                                class="form-control"
                                placeholder="Name of person reporting">
                        </div>

                        <!-- Date Reported -->
                        <div class="col-md-6">
                            <label for="psy_damage_date_reported" class="form-label">
                                Date and Time Reported <span class="text-danger">*</span>
                            </label>

                            <input
                                type="datetime-local"
                                name="date_reported"
                                id="psy_damage_date_reported"
                                class="form-control"
                                value="<?= date('Y-m-d\TH:i') ?>"
                                required>
                        </div>

                        <!-- Repair Status -->
                        <div class="col-md-6">
                            <label for="psy_damage_repair_status" class="form-label">
                                Repair Status <span class="text-danger">*</span>
                            </label>

                            <select
                                name="repair_status"
                                id="psy_damage_repair_status"
                                class="form-select"
                                required>

                                <option value="pending" selected>
                                    Pending
                                </option>

                                <option value="under repair">
                                    Under Repair
                                </option>

                                <option value="repaired">
                                    Repaired
                                </option>

                                <option value="written off">
                                    Written Off
                                </option>

                            </select>
                        </div>

                        <!-- Action Taken -->
                        <div class="col-md-12">
                            <label for="psy_damage_action_taken" class="form-label">
                                Action Taken
                            </label>

                            <textarea
                                name="action_taken"
                                id="psy_damage_action_taken"
                                class="form-control"
                                rows="2"
                                placeholder="Describe any inspection, repair, or action taken..."></textarea>
                        </div>

                        <!-- Remarks -->
                        <div class="col-md-12">
                            <label for="psy_damage_remarks" class="form-label">
                                Remarks
                            </label>

                            <textarea
                                name="remarks"
                                id="psy_damage_remarks"
                                class="form-control"
                                rows="2"
                                placeholder="Additional information (optional)..."></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        <?= empty($inventoryItems) ? 'disabled' : '' ?>>

                        <i class="fas fa-save me-1"></i>
                        Save Damage Record
                    </button>

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inventorySelect = document.getElementById('psy_damage_inventory_id');
        const laboratoryInput = document.getElementById('psy_damage_laboratory');

        if (inventorySelect && laboratoryInput) {
            inventorySelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                laboratoryInput.value =
                    selectedOption.dataset.laboratory || 'Psychology Laboratory';
            });
        }
    });
</script>