<div class="modal fade" id="lab2EditMonitoringModal" tabindex="-1" aria-labelledby="lab2EditMonitoringModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="lab2EditMonitoringForm" action="<?= BASE_URL ?>/monitoring/update" method="POST">

                <!-- Hidden ID -->
                <input type="hidden" name="id" id="lab2_edit_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="lab2EditMonitoringModalLabel">
                        <i class="fas fa-edit me-2"></i>
                        Edit IT Laboratory 2 Monitoring Record
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
                                id="lab2_edit_item_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label class="form-label">Laboratory</label>
                            <input
                                type="text"
                                name="laboratory"
                                id="lab2_edit_laboratory"
                                class="form-control"
                                value="IT Laboratory 2"
                                readonly>
                        </div>

                        <!-- Condition -->
                        <div class="col-md-6">
                            <label class="form-label">Condition</label>
                            <select
                                name="condition"
                                id="lab2_edit_condition"
                                class="form-select"
                                required>
                                <option value="" selected disabled>-- Select Condition --</option>
                                <option value="Working">Working</option>
                                <option value="Under Maintenance">Under Maintenance</option>
                                <option value="Damaged">Damaged</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>

                        <!-- Last Checked -->
                        <div class="col-md-6">
                            <label class="form-label">Last Checked</label>
                            <input
                                type="date"
                                name="last_checked"
                                id="lab2_edit_last_checked"
                                class="form-control"
                                required>
                        </div>

                        <!-- Checked By -->
                        <div class="col-md-6">
                            <label class="form-label">Checked By</label>
                            <input
                                type="text"
                                name="checked_by"
                                id="lab2_edit_checked_by"
                                class="form-control"
                                required>
                        </div>

                        <!-- Remarks -->
                        <div class="col-12">
                            <label class="form-label">Remarks</label>
                            <textarea
                                name="remarks"
                                id="lab2_edit_remarks"
                                class="form-control"
                                rows="3"
                                required></textarea>
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