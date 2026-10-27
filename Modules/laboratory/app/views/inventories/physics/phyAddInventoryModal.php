<div class="modal fade" id="phyAddInventoryModal" tabindex="-1"
    aria-labelledby="phyAddInventoryModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form
                id="phyAddInventoryForm"
                action="<?= BASE_URL ?>/physics-inventory/create"
                method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="phyAddInventoryModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>
                        Add Physics Laboratory Item
                    </h5>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Serial Number -->
                        <div class="col-md-6">
                            <label for="phy_serial_number" class="form-label">
                                Serial Number / Asset Code
                            </label>

                            <input
                                type="text"
                                id="phy_serial_number"
                                name="serial_number"
                                class="form-control"
                                placeholder="e.g. PHY-MIC-0001"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label for="phy_item_name" class="form-label">
                                Item Name
                            </label>

                            <input
                                type="text"
                                id="phy_item_name"
                                name="item_name"
                                class="form-control"
                                placeholder="e.g. Microscope"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label for="phy_category" class="form-label">
                                Category
                            </label>

                            <input
                                type="text"
                                id="phy_category"
                                name="category"
                                class="form-control"
                                placeholder="e.g. Equipment"
                                maxlength="100"
                                required>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label for="phy_laboratory" class="form-label">
                                Laboratory
                            </label>

                            <input
                                type="text"
                                id="phy_laboratory"
                                name="laboratory"
                                class="form-control"
                                value="Physics Laboratory"
                                readonly>
                        </div>

                        <!-- Condition -->
                        <div class="col-md-6">
                            <label for="phy_status" class="form-label">
                                Item Condition
                            </label>

                            <select
                                id="phy_status"
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
                        three microscopes should have three separate records
                        with unique serial numbers.
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