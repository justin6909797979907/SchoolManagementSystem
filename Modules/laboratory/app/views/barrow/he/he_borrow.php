<?php include  __DIR__ . '/../../includes/sidebar.php'; ?>
<?php include  __DIR__ . '/../../includes/header.php'; ?>


<main class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-2 text-gray-800">Borrowing</h1>
        <p class="mb-4">Home Economics Laboratory</p>

        <div class="card mb-4 card shadow-sm border-0 border-top border-4 border-secondary shadow-lg p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Borrowing
                </div>

                <button
                    class="btn btn-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#heAddBorrowModal">
                    <i class="fas fa-plus me-1"></i> Create New
                </button>
            </div>
            <div class="card-body">
                <table id="heBorrowTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Laboratory</th>
                            <th>Borrower Name</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Borrowed Date</th>
                            <th>Returned Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Home Economics Laboratory</td>
                            <td>John Doe</td>
                            <td>Home Economics Kit</td>
                            <td>1</td>
                            <td>2023-04-01</td>
                            <td>2023-04-08</td>
                            <td>Returned</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button
                                                class="dropdown-item"
                                                data-bs-toggle="modal"
                                                data-bs-target="#heViewBorrowModal">
                                                <i class="fas fa-eye me-2"></i> View
                                            </button>
                                        </li>

                                        <li>
                                            <button
                                                class="dropdown-item"
                                                data-bs-toggle="modal"
                                                data-bs-target="#heEditBorrowModal">
                                                <i class="fas fa-edit me-2"></i> Edit
                                            </button>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="delete.php?id=1"
                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                                <i class="fas fa-trash me-2"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>



<script>
    $(document).ready(function() {
        $('#heBorrowTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
        });
    });
</script>

<?php require __DIR__ . '/heAddBorrowModal.php'; ?>
<?php require __DIR__ . '/heViewBorrowModal.php'; ?>
<?php require __DIR__ . '/heEditBorrowModal.php'; ?>


<?php include  __DIR__ . '/../../includes/footer.php'; ?>