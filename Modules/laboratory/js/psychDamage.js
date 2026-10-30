// toast notifications 
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

// edit damage record
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".editBtn");

  if (!btn) return;

  e.preventDefault();

  const id = btn.dataset.id;

  fetch(`${BASE_URL}/psycho-damage/view/${id}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to load damage record.");
      }

      return response.json();
    })
    .then((data) => {
      console.log("Psychology edit record:", data);

      document.getElementById("edit_id").value = data.id ?? "";

      // Inventory reference
      document.getElementById("edit_inventory_id").value =
        data.inventory_id ?? "";

      // Inventory details
      document.getElementById("edit_serial_number").value =
        data.serial_number ?? "";

      document.getElementById("edit_item_name").value = data.item_name ?? "";

      document.getElementById("edit_laboratory").value =
        data.laboratory ?? "Psychology Laboratory";

      // Damage details
      document.getElementById("edit_accountable_department").value =
        data.accountable_department ?? "";

      document.getElementById("edit_issue_description").value =
        data.issue_description ?? "";

      // Format database datetime for datetime-local input
      document.getElementById("edit_date_reported").value = data.date_reported
        ? data.date_reported.replace(" ", "T").substring(0, 16)
        : "";

      document.getElementById("edit_repair_status").value = (
        data.repair_status ?? "pending"
      ).toLowerCase();

      // Show edit modal
      const modalElement = document.getElementById("psyEditDamageModal");

      bootstrap.Modal.getOrCreateInstance(modalElement).show();
    })
    .catch((error) => {
      console.error("Error loading Psychology edit record:", error);
      alert("Unable to load the damage record. Check the console.");
    });
});

// VIEW
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".viewBtn");

  if (!btn) return;

  e.preventDefault();

  const id = btn.dataset.id;

  fetch(`${BASE_URL}/psycho-damage/view/${id}`)
    .then(async (response) => {
      const text = await response.text();

      console.log("Psychology view response:", text);

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

      console.log("Psychology damage data:", data);

      document.getElementById("view_serial_number").value =
        data.serial_number ?? "";

      document.getElementById("view_item_name").value = data.item_name ?? "";

      document.getElementById("view_laboratory").value =
        data.laboratory ?? "Psychology Laboratory";

      document.getElementById("view_accountable_department").value =
        data.accountable_department ?? "";

      document.getElementById("view_issue_description").value =
        data.issue_description ?? "";

      document.getElementById("view_date_reported").value =
        data.date_reported ?? "";

      document.getElementById("view_repair_status").value = (
        data.repair_status ?? "pending"
      ).toLowerCase();

      // Show view modal
      const modalElement = document.getElementById("psyViewDamageModal");

      bootstrap.Modal.getOrCreateInstance(modalElement).show();
    })
    .catch((error) => {
      console.error("Psychology view modal error:", error);

      alert(
        "Unable to display the damage record. Check the browser console (F12).",
      );
    });
});

// delete psychology damage record
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".deleteBtn");

  if (!btn) return;

  e.preventDefault();

  const id = btn.dataset.id;

  if (confirm("Are you sure you want to delete this damage record?")) {
    window.location.href = `${BASE_URL}/psycho-damage/delete/${id}`;
  }
});
