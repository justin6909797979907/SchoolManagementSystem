<div class="modal fade" id="itLab3ViewInventoryModal" tabindex="-1"
    aria-labelledby="itLab3ViewInventoryModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="itLab3ViewInventoryModalLabel">
                    <i class="fas fa-eye me-2"></i>
                    View IT Laboratory 3 Inventory
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <!-- ID -->
                    <div class="col-md-6">
                        <label for="view_id" class="form-label">
                            ID
                        </label>

                        <input
                            type="text"
                            id="view_id"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Serial Number -->
                    <div class="col-md-6">
                        <label for="view_serial_number" class="form-label">
                            Serial Number
                        </label>

                        <input
                            type="text"
                            id="view_serial_number"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Item Name -->
                    <div class="col-md-6">
                        <label for="view_item_name" class="form-label">
                            Item Name
                        </label>

                        <input
                            type="text"
                            id="view_item_name"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label for="view_category" class="form-label">
                            Category
                        </label>

                        <input
                            type="text"
                            id="view_category"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Laboratory -->
                    <div class="col-md-6">
                        <label for="view_laboratory" class="form-label">
                            Laboratory
                        </label>

                        <input
                            type="text"
                            id="view_laboratory"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Condition -->
                    <div class="col-md-6">
                        <label for="view_status" class="form-label">
                            Condition
                        </label>

                        <input
                            type="text"
                            id="view_status"
                            class="form-control"
                            readonly>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    <i class="fas fa-times me-1"></i>
                    Close
                </button>
            </div>

        </div>
    </div>
</div>