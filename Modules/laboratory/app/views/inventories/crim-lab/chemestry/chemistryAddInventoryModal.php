<div class="modal fade" id="chemistryAddInventoryModal" tabindex="-1"
    aria-labelledby="chemistryAddInventoryModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form
                id="chemistryAddInventoryForm"
                action="<?= BASE_URL ?>/chemestry-inventory/create"
                method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="chemistryAddInventoryModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>
                        Add Chemistry Laboratory Item
                    </h5>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <!-- Serial Number -->
                        <div class="col-md-6">
                            <label for="chem_serial_number" class="form-label">
                                Serial Number / Asset Code
                            </label>

                            <input
                                type="text"
                                id="chem_serial_number"
                                name="serial_number"
                                class="form-control"
                                placeholder="e.g. CHEM-EQP-0001"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label for="chem_item_name" class="form-label">
                                Item Name
                            </label>

                            <input
                                type="text"
                                id="chem_item_name"
                                name="item_name"
                                class="form-control"
                                placeholder="e.g. Laboratory Beaker"
                                maxlength="150"
                                required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label for="chem_category" class="form-label">
                                Category
                            </label>

                            <input
                                type="text"
                                id="chem_category"
                                name="category"
                                class="form-control"
                                placeholder="e.g. Laboratory Equipment"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label for="chem_laboratory" class="form-label">
                                Laboratory
                            </label>

                            <input
                                type="text"
                                id="chem_laboratory"
                                name="laboratory"
                                class="form-control"
                                value="Chemistry Laboratory"
                                readonly>
                        </div>

                        <!-- Condition -->
                        <div class="col-md-6">
                            <label for="chem_status" class="form-label">
                                Item Condition
                            </label>

                            <select
                                id="chem_status"
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
                        Register each physical item separately. Multiple
                        items of the same type should have separate records
                        with unique serial numbers.
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Save Item
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