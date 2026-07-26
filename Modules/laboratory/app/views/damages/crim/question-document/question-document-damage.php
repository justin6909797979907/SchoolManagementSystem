<?php include  __DIR__ . '/../../../includes/sidebar.php'; ?>
<?php include  __DIR__ . '/../../../includes/header.php'; ?>


<main class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-2 text-gray-800">Damages</h1>
        <p class="mb-4">Questioned Document Laboratory</p>

        <div class="card mb-4 card shadow-sm border-0 border-top border-4 border-secondary shadow-lg p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Damages
                </div>

                <button
                    class="btn btn-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#qdAddDamageModal">
                    <i class="fas fa-plus me-1"></i> Create New
                </button>
            </div>
            <div class="card-body">
                <table id="qdDamageTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Laboratory</th>
                            <th>Issue</th>
                            <th>Reported By</th>
                            <th>Date Reported</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Questioned Document Kit</td>
                            <td>Questioned Document Laboratory</td>
                            <td>Damage</td>
                            <td>John Doe</td>
                            <td>07-26-2026</td>
                            <td>Item is functioning properly but needs repair.</td>
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
                                                data-bs-target="#qdViewDamageModal">
                                                <i class="fas fa-eye me-2"></i> View
                                            </button>
                                        </li>

                                        <li>
                                            <button
                                                class="dropdown-item"
                                                data-bs-toggle="modal"
                                                data-bs-target="#qdEditDamageModal">
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
        $('#qdDamageTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
        });
    });
</script>

<?php require __DIR__ . '/qdAddDamageModal.php'; ?>
<?php require __DIR__ . '/qdEditDamageModal.php'; ?>
<?php require __DIR__ . '/qdViewDamageModal.php'; ?>


<?php include  __DIR__ . '/../../../includes/footer.php'; ?>