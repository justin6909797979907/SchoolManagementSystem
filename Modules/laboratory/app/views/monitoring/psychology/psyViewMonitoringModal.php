<div class="modal fade" id="psyViewMonitoringModal" tabindex="-1" aria-labelledby="psyViewMonitoringModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="psyViewMonitoringModalLabel">
                    <i class="fas fa-eye me-2"></i>
                    View Psychology Monitoring Record
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
                            id="psy_view_item_name"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Laboratory -->
                    <div class="col-md-6">
                        <label class="form-label">Laboratory</label>
                        <input
                            type="text"
                            id="psy_view_laboratory"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Condition -->
                    <div class="col-md-6">
                        <label class="form-label">Condition</label>
                        <input
                            type="text"
                            id="psy_view_condition"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Last Checked -->
                    <div class="col-md-6">
                        <label class="form-label">Last Checked</label>
                        <input
                            type="date"
                            id="psy_view_last_checked"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Checked By -->
                    <div class="col-md-6">
                        <label class="form-label">Checked By</label>
                        <input
                            type="text"
                            id="psy_view_checked_by"
                            class="form-control"
                            readonly>
                    </div>

                    <!-- Remarks -->
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea
                            id="psy_view_remarks"
                            class="form-control"
                            rows="3"
                            readonly></textarea>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>

        </div>
    </div>
</div>