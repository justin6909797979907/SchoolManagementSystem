<div class="modal fade" id="heEditInventoryModal" tabindex="-1" aria-labelledby="heEditInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="heEditInventoryForm" method="POST" enctype="multipart/form-data">

                <!-- Hidden ID -->
                <input type="hidden" name="id" id="he_edit_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="heEditInventoryModalLabel">
                        Edit Home Economics Inventory
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label class="form-label">Item Name</label>
                            <input
                                type="text"
                                name="item_name"
                                id="he_edit_item_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <input
                                type="text"
                                name="category"
                                id="he_edit_category"
                                class="form-control"
                                required>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label class="form-label">Laboratory</label>
                            <input
                                type="text"
                                name="laboratory"
                                id="he_edit_laboratory"
                                class="form-control"
                                value="Home Economics Laboratory"
                                readonly>
                        </div>

                        <!-- Total Quantity -->
                        <div class="col-md-6">
                            <label class="form-label">Total Quantity</label>
                            <input
                                type="number"
                                name="total_quantity"
                                id="he_edit_total_quantity"
                                class="form-control"
                                min="1"
                                required>
                        </div>

                        <!-- Available Quantity -->
                        <div class="col-md-6">
                            <label class="form-label">Available Quantity</label>
                            <input
                                type="number"
                                name="available_quantity"
                                id="he_edit_available_quantity"
                                class="form-control"
                                min="0"
                                required>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select
                                name="status"
                                id="he_edit_status"
                                class="form-select"
                                required>
                                <option value="" selected disabled>-- Select Condition --</option>
                                <option value="Working">Working</option>
                                <option value="Under Maintenance">Under Maintenance</option>
                                <option value="Damaged">Damaged</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i> Update
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>