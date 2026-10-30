<div class="modal fade" id="psyEditDamageModal" tabindex="-1"
    aria-labelledby="psyEditDamageModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form id="psyEditDamageForm"
                action="<?= BASE_URL ?>/psycho-damage/update"
                method="POST">

                <!-- Hidden IDs -->
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="inventory_id" id="edit_inventory_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="psyEditDamageModalLabel">
                        <i class="fas fa-edit me-2"></i>
                        Edit Damage Record
                    </h5>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Serial Number -->
                        <div class="col-md-6">
                            <label for="edit_serial_number" class="form-label">
                                Serial Number
                            </label>
                            <input type="text" name="serial_number"
                                id="edit_serial_number"
                                class="form-control" readonly>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label for="edit_item_name" class="form-label">
                                Item Name
                            </label>
                            <input type="text" name="item_name"
                                id="edit_item_name"
                                class="form-control" readonly>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label for="edit_laboratory" class="form-label">
                                Laboratory
                            </label>
                            <input type="text" name="laboratory"
                                id="edit_laboratory"
                                class="form-control"
                                value="Psychology Laboratory" readonly>
                        </div>

                        <!-- Accountable Department -->
                        <div class="col-md-6">
                            <label for="edit_accountable_department"
                                class="form-label">
                                Accountable Department
                            </label>
                            <input type="text" name="accountable_department"
                                id="edit_accountable_department"
                                class="form-control" required>
                        </div>

                        <!-- Issue Description -->
                        <div class="col-12">
                            <label for="edit_issue_description"
                                class="form-label">
                                Issue Description
                            </label>
                            <textarea name="issue_description"
                                id="edit_issue_description"
                                class="form-control" rows="3"
                                required></textarea>
                        </div>

                        <!-- Date Reported -->
                        <div class="col-md-6">
                            <label for="edit_date_reported"
                                class="form-label">
                                Date Reported
                            </label>
                            <input type="datetime-local" name="date_reported"
                                id="edit_date_reported"
                                class="form-control" required>
                        </div>

                        <!-- Repair Status -->
                        <div class="col-md-6">
                            <label for="edit_repair_status"
                                class="form-label">
                                Repair Status
                            </label>
                            <select name="repair_status"
                                id="edit_repair_status"
                                class="form-select" required>
                                <option value="" disabled>
                                    -- Select Repair Status --
                                </option>
                                <option value="pending">Pending</option>
                                <option value="under repair">Under Repair</option>
                                <option value="repaired">Repaired</option>
                                <option value="written off">Written Off</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>
                        Update
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