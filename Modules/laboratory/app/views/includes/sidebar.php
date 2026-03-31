<aside class="sidebar">
    <div class="school-logo">
        <img src="<?= BASE_URL ?>/assets/bcp-logo.png" alt="School Logo">
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
    <div id="accordionSidebar">
        <div><a href="<?= BASE_URL ?>" class="menu-link <?php echo CURRENT_URI == 'laboratory' ? "active" :  "" ?>">Dashboard</a></div>

        <!-- Laboratories -->
        <div class="nav-item">
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

                <div class="py-2 px-3 rounded shadow-sm w-100 accordionSidebar-inner">

                    <a class="dropdown-item menu-link text-white d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapsePhysics"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapsePhysics">
                        <span>Physics Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
                    </a>

                    <div id="collapsePhysics" class="collapse ps-3" data-bs-parent="#collapseUtilities">
                        <a href="<?= BASE_URL ?>/inventory" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'inventory' ? "active" :  "" ?>">Inventory</a>
                        <a href="<?= BASE_URL ?>/damages" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'damages' ? "active" :  "" ?>">Damage</a>
                        <a href="<?= BASE_URL ?>/borrow" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'borrow' ? "active" :  "" ?>">Borrow</a>
                    </div>

                    <a class="dropdown-item menu-link text-white d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapsePsychology"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapsePsychology">
                        <span>Psychology Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
                    </a>

                    <div class="collapse ps-3" id="collapsePsychology" data-bs-parent="#collapseUtilities">
                        <a href="<?= BASE_URL ?>/psycho-inventory" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'psycho-inventory' ? "active" :  "" ?>">Inventory</a>
                        <a href="<?= BASE_URL ?>/psycho-damage" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'psycho-damage' ? "active" :  "" ?>">Damage</a>
                        <a href="#" class="dropdown-item menu-link small text-white">Borrow</a>
                    </div>

                    <a class="dropdown-item menu-link text-white d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapseHE"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseHE">
                        <span>HE Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
                    </a>

                    <div id="collapseHE" class="collapse ps-3" data-bs-parent="#collapseUtilities">
                        <a href="<?= BASE_URL ?>/he-inventory" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'he-inventory' ? "active" :  "" ?>">Inventory</a>
                        <a href="#" class="dropdown-item menu-link small text-white">Damage</a>
                        <a href="#" class="dropdown-item menu-link small text-white">Borrow</a>
                    </div>

                    <!-- Crim Lab with Submenu -->
                    <!-- <a class="dropdown-item menu-link text-white d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapseCrim"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseCrim">
                        <span>Crim Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
                    </a>

                    <div class="collapse ps-2 text-white" id="collapseCrim">
                        <a href="<?= BASE_URL ?>/crim-inventory" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'crim-inventory' ? "active" :  "" ?>">Inventory</a>
                        <a href="<?= BASE_URL ?>/crim-borrow" class="dropdown-item menu-link small fw-light <?php echo CURRENT_URI == 'crim-borrow' ? "active" :  "" ?>">Borrow</a>
                        <a href="<?= BASE_URL ?>/crim-damage" class="dropdown-item menu-link small fw-light <?php echo CURRENT_URI == 'crim-damage' ? "active" :  "" ?>">Damage</a>
                    </div> -->

                    <!-- Crim Lab with Submenu -->
                    <a class="dropdown-item menu-link text-white d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapseCrim"
                        aria-expanded="false">
                        <span>Crim Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon"></i>
                    </a>

                    <div id="collapseCrim" class="collapse ps-3" data-bs-parent="#collapseUtilities">

                        <div class="accordion" id="crimLabAccordion">

                            <!-- Finger Print Lab -->
                            <div class="accordion-item bg-transparent border-0">
                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseCrim1">
                                    <span>Finger Print Lab</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseCrim1" class="collapse ps-3" data-bs-parent="#crimLabAccordion">
                                    <a href="<?= BASE_URL ?>/crim-fingerprint-inventory" class="dropdown-item menu-link small text-white">Inventory</a>
                                    <a href="<?= BASE_URL ?>/crim-fingerprint-damage" class="dropdown-item menu-link small text-white">Damage</a>
                                    <a href="<?= BASE_URL ?>/crim-fingerprint-borrow" class="dropdown-item menu-link small text-white">Borrow</a>
                                </div>
                            </div>

                            <!-- Crime Scene Lab -->
                            <div class="accordion-item bg-transparent border-0">
                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseCrim2">
                                    <span>Crime Scene Lab</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseCrim2" class="collapse ps-3" data-bs-parent="#crimLabAccordion">
                                    <a href="<?= BASE_URL ?>/crim-scene-inventory" class="dropdown-item menu-link small text-white">Inventory</a>
                                    <a href="<?= BASE_URL ?>/crim-scene-damage" class="dropdown-item menu-link small text-white">Damage</a>
                                    <a href="<?= BASE_URL ?>/crim-scene-borrow" class="dropdown-item menu-link small text-white">Borrow</a>
                                </div>
                            </div>

                            <!-- Ballistics Lab -->
                            <div class="accordion-item bg-transparent border-0">
                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseCrim3">
                                    <span>Ballistics Lab</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseCrim3" class="collapse ps-3" data-bs-parent="#crimLabAccordion">
                                    <a href="<?= BASE_URL ?>/crim-ballistics-inventory" class="dropdown-item menu-link small text-white">Inventory</a>
                                    <a href="<?= BASE_URL ?>/crim-ballistics-damage" class="dropdown-item menu-link small text-white">Damage</a>
                                    <a href="<?= BASE_URL ?>/crim-ballistics-borrow" class="dropdown-item menu-link small text-white">Borrow</a>
                                </div>
                            </div>

                            <!-- Questioned Document Lab -->
                            <div class="accordion-item bg-transparent border-0">
                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseCrim4">
                                    <span>Questioned Document Lab</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseCrim4" class="collapse ps-3" data-bs-parent="#crimLabAccordion">
                                    <a href="<?= BASE_URL ?>/crim-doc-inventory" class="dropdown-item menu-link small text-white">Inventory</a>
                                    <a href="<?= BASE_URL ?>/crim-doc-damage" class="dropdown-item menu-link small text-white">Damage</a>
                                    <a href="<?= BASE_URL ?>/crim-doc-borrow" class="dropdown-item menu-link small text-white">Borrow</a>
                                </div>
                            </div>

                            <!-- Chemistry Lab -->
                            <div class="accordion-item bg-transparent border-0">
                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseCrim5">
                                    <span>Chemistry Lab</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseCrim5" class="collapse ps-3" data-bs-parent="#crimLabAccordion">
                                    <a href="<?= BASE_URL ?>/crim-chem-inventory" class="dropdown-item menu-link small text-white">Inventory</a>
                                    <a href="<?= BASE_URL ?>/crim-chem-damage" class="dropdown-item menu-link small text-white">Damage</a>
                                    <a href="<?= BASE_URL ?>/crim-chem-borrow" class="dropdown-item menu-link small text-white">Borrow</a>
                                </div>
                            </div>

                            <!-- Defense & Tactics Lab -->
                            <div class="accordion-item bg-transparent border-0">
                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseCrim6">
                                    <span>Defense & Tactics Lab</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseCrim6" class="collapse ps-3" data-bs-parent="#crimLabAccordion">
                                    <a href="<?= BASE_URL ?>/crim-defense-inventory" class="dropdown-item menu-link small text-white">Inventory</a>
                                    <a href="<?= BASE_URL ?>/crim-defense-damage" class="dropdown-item menu-link small text-white">Damage</a>
                                    <a href="<?= BASE_URL ?>/crim-defense-borrow" class="dropdown-item menu-link small text-white">Borrow</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- IT Lab with Submenu -->
                    <!-- <a class="dropdown-item menu-link text-white d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        href="#collapseIT"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseIT">
                        <span>IT Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
                    </a>

                    <div class="collapse ps-2" id="collapseIT">
                        <a href="<?= BASE_URL ?>/it-inventory" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'it-inventory' ? "active" :  "" ?>">Inventory</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-white">Damage</a>
                        <a href="#" class="dropdown-item menu-link small fw-light text-white">Borrow</a>
                    </div> -->

                    <!-- IT Lab with Submenu -->
                    <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                        data-bs-toggle="collapse"
                        href="#collapseIT"
                        aria-expanded="false">
                        <span>IT Lab</span>
                        <i class="bi bi-chevron-right dropdown-icon"></i>
                    </a>

                    <div id="collapseIT" class="collapse ps-3" data-bs-parent="#collapseUtilities">

                        <!-- ACCORDION GROUP -->
                        <div class="accordion" id="itLabAccordion">

                            <!-- LAB 1 -->
                            <div class="accordion-item bg-transparent border-0">

                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseIT1"
                                    aria-expanded="false">
                                    <span>IT Lab 1</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseIT1"
                                    class="collapse ps-3"
                                    data-bs-parent="#itLabAccordion">

                                    <a href="<?= BASE_URL ?>/it-inventory" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'it-inventory' ? "active" :  "" ?>">Inventory</a>

                                    <a href="<?= BASE_URL ?>/it_damage" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'it_damage' ? "active" :  "" ?>">Damage</a>

                                    <a href="<?= BASE_URL ?>/it_borrow" class="dropdown-item menu-link small text-white <?php echo CURRENT_URI == 'it_borrow' ? "active" :  "" ?>">Borrow</a>
                                </div>

                            </div>

                            <!-- LAB 2 -->
                            <div class="accordion-item bg-transparent border-0">

                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white collapsed"
                                    data-bs-toggle="collapse"
                                    href="#collapseIT2"
                                    aria-expanded="false">
                                    <span>IT Lab 2</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseIT2"
                                    class="collapse ps-3"
                                    data-bs-parent="#itLabAccordion">
                                    <a href="#" class="dropdown-item small menu-link text-white">Inventory</a>
                                    <a href="#" class="dropdown-item small menu-link text-white">Borrow</a>
                                    <a href="#" class="dropdown-item small menu-link text-white">Damage</a>
                                </div>

                            </div>

                            <!-- LAB 3 -->
                            <div class="accordion-item bg-transparent border-0">

                                <a class="dropdown-item menu-link d-flex justify-content-between align-items-center text-white"
                                    data-bs-toggle="collapse"
                                    href="#collapseIT3"
                                    aria-expanded="false">
                                    <span>IT Lab 3</span>
                                    <i class="bi bi-chevron-right dropdown-icon"></i>
                                </a>

                                <div id="collapseIT3"
                                    class="collapse ps-3"
                                    data-bs-parent="#itLabAccordion">
                                    <a href="#" class="dropdown-item menu-link small text-white">Inventory</a>
                                    <a href="#" class="dropdown-item menu-link small text-white">Borrow</a>
                                    <a href="#" class="dropdown-item menu-link small text-white">Damage</a>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>



        <div><a href="" class="menu-link">Users</a></div>
        <a href="<?= BASE_URL ?>/schedule" class="dropdown-item menu-link small fw-light <?php echo CURRENT_URI == 'schedule' ? "active" :  "" ?>">Schedule</a>

        <hr class="text-white">
        <!-- <div class="text-white py-2 px-3 rounded shadow-sm w-100">Reports:</div>
        <div><a href="<?= BASE_URL ?>/approval-decision-support" class="menu-link">Approval Decision Support</a></div>
        <div><a href="<?= BASE_URL ?>/concern-issue-tracking" class="menu-link">Concerns Issue Tracking</a></div>
        <div><a href="<?= BASE_URL ?>/report-submission-management" class="menu-link">Report Submmision Management</a></div> -->

        <!-- Reports -->
        <a class="menu-link collapsed d-flex justify-content-between align-items-center"
            href="#collapseReports"
            data-bs-toggle="collapse"
            aria-expanded="false">

            <span>Reports</span>
            <i class="bi bi-chevron-right dropdown-icon fs-6"></i>
        </a>

        <div id="collapseReports"
            class="collapse"
            data-bs-parent="#accordionSidebar">

            <div class="text-white py-2 px-3 rounded w-100">
                <a class="dropdown-item menu-link" href="#">Inventory Reports</a>
                <a class="dropdown-item menu-link" href="#">Damage Reports</a>
                <a class="dropdown-item menu-link" href="#">Laboratory Usage</a>
                <a class="dropdown-item menu-link" href="#">Monthly Schedule</a>

                <a href="<?= BASE_URL ?>/approval-decision-support" class="menu-link">Approval Decision Support</a>
                <a href="<?= BASE_URL ?>/concern-issue-tracking" class="menu-link">Concerns Issue Tracking</a>
                <a href="<?= BASE_URL ?>/report-submission-management" class="menu-link">Report Submission Management</a>
            </div>
        </div>

    </div>


    <div class="sidebar-header">
    </div>

    <div><a href="#" class="menu-link">Settings</a></div>
    <div><a href="#" class="menu-link">Logout</a></div>

</aside>