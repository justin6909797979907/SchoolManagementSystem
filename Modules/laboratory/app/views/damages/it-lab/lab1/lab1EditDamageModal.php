<div class="modal fade" id="lab1EditDamageModal" tabindex="-1" aria-labelledby="lab1EditDamageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="lab1EditDamageForm" action="<?= BASE_URL ?>/damages/update" method="POST">

                <!-- Hidden ID -->
                <input type="hidden" name="id" id="lab1_edit_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="lab1EditDamageModalLabel">
                        <i class="fas fa-edit me-2"></i>
                        Edit Damage Record
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
                                id="lab1_edit_item_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label class="form-label">Laboratory</label>
                            <input
                                type="text"
                                name="laboratory"
                                id="lab1_edit_laboratory"
                                class="form-control"
                                value="IT Laboratory 1"
                                readonly>
                        </div>

                        <!-- Issue -->
                        <div class="col-md-6">
                            <label class="form-label">Issue</label>
                            <input
                                type="text"
                                name="issue"
                                id="lab1_edit_issue"
                                class="form-control"
                                required>
                        </div>

                        <!-- Reported By -->
                        <div class="col-md-6">
                            <label class="form-label">Reported By</label>
                            <input
                                type="text"
                                name="reported_by"
                                id="lab1_edit_reported_by"
                                class="form-control"
                                required>
                        </div>

                        <!-- Date Reported -->
                        <div class="col-md-6">
                            <label class="form-label">Date Reported</label>
                            <input
                                type="date"
                                name="date_reported"
                                id="lab1_edit_date_reported"
                                class="form-control"
                                required>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select
                                name="status"
                                id="lab1_edit_status"
                                class="form-select"
                                required>
                                <option value="" selected disabled>-- Select Status --</option>
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