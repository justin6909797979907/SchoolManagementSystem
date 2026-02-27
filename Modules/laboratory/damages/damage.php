<?php include '../includes/sidebar.php'; ?>
<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="/SchoolManagementSystem/assets/css/style.css">

<main class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-2 text-gray-800">Laboratory</h1>
        <p class="mb-4">Barrowed Equipment</p>

        <div class="card shadow-sm border-0 border-top border-4 border-secondary mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i> Barrowed Equipment
                </div>
                <a href="create.php" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Create New
                </a>
            </div>

            <div class="card-body">
                <table id="barrowedTable" class="table table-striped table-bordered table-hover" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Date Created</th>
                            <th>Category</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2024-03-27 14:25</td>
                            <td>Optical</td>
                            <td>OP-12345</td>
                            <td>
                                <span class="badge bg-success">Returned</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="view.php?id=1"><i class="fas fa-eye me-2"></i>View</a></li>
                                        <li><a class="dropdown-item" href="edit.php?id=1"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="delete.php?id=1" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash me-2"></i>Delete</a></li>
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

<script src="../js/pagination.js"></script>
<?php include '../includes/footer.php'; ?>