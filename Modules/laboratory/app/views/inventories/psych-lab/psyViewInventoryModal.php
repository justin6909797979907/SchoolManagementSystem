<div class="modal fade" id="psyViewInventoryModal" tabindex="-1"
    aria-labelledby="psyViewInventoryModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="psyViewInventoryModalLabel">
                    <i class="fas fa-eye me-2"></i>
                    View Psychology Inventory
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <!-- ID -->
                    <div class="col-md-6">
                        <label class="form-label">ID</label>
                        <input
                            type="text"
                            id="view_id"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Serial Number -->
                    <div class="col-md-6">
                        <label class="form-label">Serial Number</label>
                        <input
                            type="text"
                            id="view_serial_number"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Item Name -->
                    <div class="col-md-6">
                        <label class="form-label">Item Name</label>
                        <input
                            type="text"
                            id="view_item_name"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <input
                            type="text"
                            id="view_category"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Laboratory -->
                    <div class="col-md-6">
                        <label class="form-label">Laboratory</label>
                        <input
                            type="text"
                            id="view_laboratory"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Condition -->
                    <div class="col-md-6">
                        <label class="form-label">Condition</label>
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