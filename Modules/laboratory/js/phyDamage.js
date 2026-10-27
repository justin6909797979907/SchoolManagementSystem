const dismissToast = (toast) => {
  let hideTimer;

  function dismiss() {
    clearTimeout(hideTimer);

    if (toast.classList.contains("hiding")) return;

    toast.classList.add("hiding");

    setTimeout(() => toast.remove(), 500);
  }

  const closeButton = toast.querySelector(".toast-close");

  if (closeButton) {
    closeButton.addEventListener("click", dismiss);
  }

  hideTimer = setTimeout(dismiss, 5000);
};

document.querySelectorAll(".custom-toast").forEach(dismissToast);

// EDIT DAMAGE RECORD
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".editBtn");

  if (!btn) return;

  e.preventDefault();

  const id = btn.dataset.id;

  fetch(`${BASE_URL}/physics-damage/view/${id}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to load damage record.");
      }

      return response.json();
    })
    .then((data) => {
      console.log("Edit record:", data);

      document.getElementById("edit_id").value = data.id ?? "";

      // IMPORTANT: Required by the PHP update() controller
      document.getElementById("edit_inventory_id").value =
        data.inventory_id ?? "";

      document.getElementById("edit_serial_number").value =
        data.serial_number ?? "";

      document.getElementById("edit_item_name").value =
        data.item_name ?? "";

      document.getElementById("edit_laboratory").value =
        data.laboratory ?? "Physics Laboratory";

      document.getElementById("edit_issue_description").value =
        data.issue_description ?? "";

      document.getElementById("edit_accountable_department").value =
        data.accountable_department ?? "";

      // Format database datetime for datetime-local input
      document.getElementById("edit_date_reported").value = data.date_reported
        ? data.date_reported.replace(" ", "T").substring(0, 16)
        : "";

      document.getElementById("edit_repair_status").value = (
        data.repair_status ?? "pending"
      ).toLowerCase();

      bootstrap.Modal.getOrCreateInstance(
        document.getElementById("phyEditDamageModal")
      ).show();
    })
    .catch((error) => {
      console.error("Error loading edit record:", error);
      alert("Unable to load the damage record. Check the console.");
    });
});

document.addEventListener("click", function (e) {
  const btn = e.target.closest(".viewBtn");

  if (!btn) return;

  e.preventDefault();

  const id = btn.dataset.id;

  fetch(`${BASE_URL}/physics-damage/view/${id}`)
    .then(async (response) => {
      const text = await response.text();

      console.log("View response:", text);

      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }

      try {
        return JSON.parse(text);
      } catch {
        throw new Error("The controller did not return valid JSON.");
      }
    })
    .then((data) => {
      if (data.error) {
        throw new Error(data.error);
      }

      console.log("Damage data:", data);

      document.getElementById("view_serial_number").value =
        data.serial_number ?? "";

      document.getElementById("view_item_name").value = data.item_name ?? "";

      document.getElementById("view_laboratory").value =
        data.laboratory ?? "Physics Laboratory";

      document.getElementById("view_accountable_department").value =
        data.accountable_department ?? "";

      document.getElementById("view_issue_description").value =
        data.issue_description ?? "";

      document.getElementById("view_date_reported").value =
        data.date_reported ?? "";

      document.getElementById("view_repair_status").value = (
        data.repair_status ?? "pending"
      ).toLowerCase();

      const modalElement = document.getElementById("phyViewDamageModal");

      bootstrap.Modal.getOrCreateInstance(modalElement).show();
    })
    .catch((error) => {
      console.error("View modal error:", error);
      alert(
        "Unable to display the damage record. Check the browser console (F12).",
      );
    });
});

// DELETE HANDLER — only if your application still uses this route
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".deleteBtn");

  if (!btn) return;

  e.preventDefault();

  const id = btn.dataset.id;

  if (confirm("Are you sure you want to delete this damage record?")) {
    window.location.href = `${BASE_URL}/physics-damage/delete/${id}`;
  }
});
