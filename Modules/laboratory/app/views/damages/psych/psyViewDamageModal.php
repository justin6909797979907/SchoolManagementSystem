<div class="modal fade" id="psyViewDamageModal" tabindex="-1"
    aria-labelledby="psyViewDamageModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="psyViewDamageModalLabel">
                    <i class="fas fa-eye me-2"></i>
                    View Damage Record
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row g-3">

                    <!-- Serial Number -->
                    <div class="col-md-6">
                        <label for="view_serial_number" class="form-label">
                            Serial Number
                        </label>
                        <input type="text" id="view_serial_number"
                            class="form-control" readonly>
                    </div>

                    <!-- Item Name -->
                    <div class="col-md-6">
                        <label for="view_item_name" class="form-label">
                            Item Name
                        </label>
                        <input type="text" id="view_item_name"
                            class="form-control" readonly>
                    </div>

                    <!-- Laboratory -->
                    <div class="col-md-6">
                        <label for="view_laboratory" class="form-label">
                            Laboratory
                        </label>
                        <input type="text" id="view_laboratory"
                            class="form-control"
                            value="Psychology Laboratory" readonly>
                    </div>

                    <!-- Accountable Department -->
                    <div class="col-md-6">
                        <label for="view_accountable_department"
                            class="form-label">
                            Accountable Department
                        </label>
                        <input type="text" id="view_accountable_department"
                            class="form-control" readonly>
                    </div>

                    <!-- Issue Description -->
                    <div class="col-12">
                        <label for="view_issue_description"
                            class="form-label">
                            Issue Description
                        </label>
                        <textarea id="view_issue_description"
                            class="form-control" rows="3"
                            readonly></textarea>
                    </div>

                    <!-- Date Reported -->
                    <div class="col-md-6">
                        <label for="view_date_reported"
                            class="form-label">
                            Date Reported
                        </label>
                        <input type="text" id="view_date_reported"
                            class="form-control" readonly>
                    </div>

                    <!-- Repair Status -->
                    <div class="col-md-6">
                        <label for="view_repair_status"
                            class="form-label">
                            Repair Status
                        </label>
                        <select id="view_repair_status"
                            class="form-select" disabled>
                            <option value="pending">Pending</option>
                            <option value="under repair">Under Repair</option>
                            <option value="repaired">Repaired</option>
                            <option value="written off">Written Off</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>
                    Close
                </button>
            </div>

        </div>
    </div>
</div>