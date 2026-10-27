
<div class="modal fade" id="phyEditInventoryModal" tabindex="-1"
    aria-labelledby="phyEditInventoryModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form
                id="phyEditInventoryForm"
                action="<?= BASE_URL ?>/physics-inventory/update"
                method="POST">

                <!-- Hidden ID -->
                <input type="hidden" name="id" id="edit_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="phyEditInventoryModalLabel">
                        <i class="fas fa-edit me-2"></i>
                        Edit Physics Laboratory Item
                    </h5>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Serial Number -->
                        <div class="col-md-6">
                            <label for="edit_serial_number" class="form-label">
                                Serial Number / Asset Code
                            </label>

                            <input
                                type="text"
                                name="serial_number"
                                id="edit_serial_number"
                                class="form-control"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label for="edit_item_name" class="form-label">
                                Item Name
                            </label>

                            <input
                                type="text"
                                name="item_name"
                                id="edit_item_name"
                                class="form-control"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label for="edit_category" class="form-label">
                                Category
                            </label>

                            <input
                                type="text"
                                name="category"
                                id="edit_category"
                                class="form-control"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label for="edit_laboratory" class="form-label">
                                Laboratory
                            </label>

                            <input
                                type="text"
                                name="laboratory"
                                id="edit_laboratory"
                                class="form-control"
                                value="Physics Laboratory"
                                readonly>
                        </div>

                        <!-- Condition -->
                        <div class="col-md-6">
                            <label for="edit_status" class="form-label">
                                Item Condition
                            </label>

                            <select
                                name="status"
                                id="edit_status"
                                class="form-select"
                                required>

                                <option value="" disabled>
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
                        Changing the condition to <strong>Damage</strong>
                        should make this item appear in the Damage module
                        once the model and controller use the new status.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>
                        Update Item
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
