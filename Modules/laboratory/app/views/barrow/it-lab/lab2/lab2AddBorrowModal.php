    <div class="modal fade" id="lab2AddBorrowModal" tabindex="-1" aria-labelledby="lab2AddBorrowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="lab2AddBorrowForm" action="<?= BASE_URL ?>/borrow/create" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="lab2AddBorrowModalLabel">
                        <i class="fas fa-hand-holding me-2"></i>
                        Add Borrow Record
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <!-- Laboratory -->
                        <div class="col-md-6">
                            <label class="form-label">Laboratory</label>
                            <input
                                type="text"
                                name="laboratory"
                                class="form-control"
                                value="IT Laboratory 2"
                                readonly>
                        </div>

                        <!-- Borrower Name -->
                        <div class="col-md-6">
                            <label class="form-label">Borrower Name</label>
                            <input
                                type="text"
                                name="borrower_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label class="form-label">Item Name</label>
                            <input
                                type="text"
                                name="item_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <input
                                type="number"
                                name="quantity"
                                class="form-control"
                                min="1"
                                required>
                        </div>

                        <!-- Borrowed Date -->
                        <div class="col-md-6">
                            <label class="form-label">Borrowed Date</label>
                            <input
                                type="date"
                                name="borrowed_date"
                                class="form-control"
                                required>
                        </div>

                        <!-- Returned Date -->
                        <div class="col-md-6">
                            <label class="form-label">Returned Date</label>
                            <input
                                type="date"
                                name="returned_date"
                                id="lab2_edit_returned_date"
                                class="form-control">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select
                                name="status"
                                id="lab2_edit_status"
                                class="form-select"
                                required>
                                <option value="" disabled selected>-- Select Status --</option>
                                <option value="Borrowed">Borrowed</option>
                                <option value="Returned">Returned</option>
                                <option value="Overdue">Overdue</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>