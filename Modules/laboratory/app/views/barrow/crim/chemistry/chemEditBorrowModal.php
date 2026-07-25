<div class="modal fade" id="chemEditBorrowModal" tabindex="-1" aria-labelledby="chemEditBorrowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="chemEditBorrowForm" action="<?= BASE_URL ?>/borrow/update" method="POST">

                <!-- Hidden ID -->
                <input type="hidden" name="id" id="chem_edit_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="chemEditBorrowModalLabel">
                        <i class="fas fa-edit me-2"></i>
                        Edit Borrow Record
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
                                id="chem_edit_laboratory"
                                class="form-control"
                                value="Chemistry Laboratory"
                                readonly>
                        </div>

                        <!-- Borrower Name -->
                        <div class="col-md-6">
                            <label class="form-label">Borrower Name</label>
                            <input
                                type="text"
                                name="borrower_name"
                                id="chem_edit_borrower_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label class="form-label">Item Name</label>
                            <input
                                type="text"
                                name="item_name"
                                id="chem_edit_item_name"
                                class="form-control"
                                required>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <input
                                type="number"
                                name="quantity"
                                id="chem_edit_quantity"
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
                                id="chem_edit_borrowed_date"
                                class="form-control"
                                required>
                        </div>

                        <!-- Returned Date -->
                        <div class="col-md-6">
                            <label class="form-label">Returned Date</label>
                            <input
                                type="date"
                                name="returned_date"
                                id="chem_edit_returned_date"
                                class="form-control">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select
                                name="status"
                                id="chem_edit_status"
                                class="form-select"
                                required>
                                <option value="" selected disabled>-- Select Status --</option>
                                <option value="Borrowed">Borrowed</option>
                                <option value="Returned">Returned</option>
                                <option value="Overdue">Overdue</option>
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