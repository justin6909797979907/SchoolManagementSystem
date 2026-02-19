<aside class="sidebar">
    <div class="school-logo">
        <img src="assets/bcp-logo.png" alt="School Logo">
        <div class="sidebar-icons">
            <i class="fa-regular fa-bell"></i>
            <i class="fa-regular fa-circle-user"></i>
        </div>
    </div>
    <div class="sidebar-header">
        <div class="user-avatar">UA</div>
        <h1>Username</h1>
        <p class="user-id">SAMPLEID123456789</p>
    </div>
    <h2>Laboratory</h2>
    <ul>
        <li><a href="" class="menu-link"> Dashboard</a></li>
        <!-- Laboratories -->
        <li class="nav-item">
            <a class="menu-link collapsed d-flex justify-content-between align-items-center"
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#collapseUtilities"
                aria-expanded="false"
                aria-controls="collapseUtilities">
                <span>Laboratories</span>
                <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
            </a>

            <div id="collapseUtilities"
                class="collapse"
                data-bs-parent="#accordionSidebar">

                <div class="bg-white py-2 px-3 rounded shadow-sm w-100">
                    <h6 class="px-3 text-muted small">Option:</h6>

                    <a class="dropdown-item menu-link text-dark" href="#">Physics Lab</a>
                    <a class="dropdown-item menu-link text-dark" href="#">Psychology Lab</a>
                    <a class="dropdown-item menu-link text-dark" href="#">HE Lab</a>

                    <!-- Crim Lab with Submenu -->
                    <a class="dropdown-item menu-link text-dark d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapseCrim"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseCrim">
                        <span>Crim Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
                    </a>

                    <div class="collapse ps-2" id="collapseCrim">
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">Finger Print Lab</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">Crime Scene Lab</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">Ballistics Lab</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">Questions Document Lab</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">Chemistry Lab</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">Defense & Tactics Lab</a>
                    </div>

                    <!-- IT Lab with Submenu -->
                    <a class="dropdown-item menu-link text-dark d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapseIT"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseIT">
                        <span>IT Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
                    </a>

                    <div class="collapse ps-2" id="collapseIT">
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">IT Laboratory 1</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">IT Laboratory 2</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-dark">IT Laboratory 3</a>
                    </div>

                </div>
            </div>
        </li>


        <!-- Reports -->
        <li class="nav-item">
            <a class="menu-link collapsed d-flex justify-content-between align-items-center"
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#collapseReports"
                aria-expanded="false"
                aria-controls="collapseReporta">
                <span>Reports</span>
                <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
            </a>

            <div id="collapsereports"
                class="collapse"
                data-bs-parent="#accordionSidebar">

                <div class="bg-white py-2 px-3 rounded shadow-sm w-100">
                    <h6 class="px-3 text-muted small">Option:</h6>

                    <a class="dropdown-item menu-link text-dark" href="#">Inventory Reports</a>
                    <a class="dropdown-item menu-link text-dark" href="#">Damaged Equipment</a>
                    <a class="dropdown-item menu-link text-dark" href="#">Laboratory Usage</a>
                    <a class="dropdown-item menu-link text-dark" href="#">Monthly Schedule</a>
                </div>
            </div>
        </li>

        <li><a href="" class="menu-link">Users</a></li>
        <li><a href="" class="menu-link">Schedule</a></li>
        <li><a href="" class="menu-link">Reports</a></li>
    </ul>


    <div class="sidebar-header">
    </div>

    <ul>
        <li><a href="#" class="menu-link">Settings</a></li>
        <li><a href="#" class="menu-link">Lagout</a></li>
    </ul>
</aside>