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

document.addEventListener("click", function (e) {
  // EDIT INVENTORY ITEM
  const editBtn = e.target.closest(".editBtn");

  if (editBtn) {
    e.preventDefault();

    const id = editBtn.dataset.id;

    fetch(`${BASE_URL}/physics-inventory/view/${id}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Failed to fetch inventory item.");
        }

        return response.json();
      })
      .then((data) => {
        if (!data || !data.id) {
          throw new Error("Inventory item not found.");
        }

        document.getElementById("edit_id").value = data.id;
        document.getElementById("edit_serial_number").value =
          data.serial_number ?? "";
        document.getElementById("edit_item_name").value = data.item_name ?? "";
        document.getElementById("edit_category").value = data.category ?? "";
        document.getElementById("edit_laboratory").value =
          data.laboratory ?? "Physics Laboratory";
        document.getElementById("edit_status").value = data.status ?? "working";

        const modalElement = document.getElementById("phyEditInventoryModal");

        bootstrap.Modal.getOrCreateInstance(modalElement).show();
      })
      .catch((error) => {
        console.error("Edit error:", error);
        alert("Unable to load the inventory item. Please try again.");
      });

    return;
  }

  // VIEW INVENTORY ITEM
  const viewBtn = e.target.closest(".viewBtn");

  if (viewBtn) {
    e.preventDefault();

    const id = viewBtn.dataset.id;

    fetch(`${BASE_URL}/physics-inventory/view/${id}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Failed to fetch inventory item.");
        }

        return response.json();
      })
      .then((data) => {
        if (!data || !data.id) {
          throw new Error("Inventory item not found.");
        }

        document.getElementById("view_id").value = data.id ?? "";
        document.getElementById("view_item_name").value = data.item_name ?? "";
        document.getElementById("view_category").value = data.category ?? "";
        document.getElementById("view_laboratory").value =
          data.laboratory ?? "Physics Laboratory";

        // Support either database column naming convention.
        document.getElementById("view_total_quantity").value =
          data.total_quantity ?? data.total_item ?? "";

        document.getElementById("view_available_quantity").value =
          data.available_quantity ?? data.available_item ?? "";

        document.getElementById("view_status").value = data.status ?? "";

        const modalElement = document.getElementById("phyViewInventoryModal");

        bootstrap.Modal.getOrCreateInstance(modalElement).show();
      })
      .catch((error) => {
        console.error("View error:", error);
        alert("Unable to load the inventory item. Please try again.");
      });

    return;
  }

  // ARCHIVE INVENTORY ITEM
  // Use a link with class="deactivateBtn" and data-id="..."
  const deactivateBtn = e.target.closest(".deactivateBtn");

  if (deactivateBtn) {
    e.preventDefault();

    const id = deactivateBtn.dataset.id;

    if (confirm("Are you sure you want to deactivate this inventory item?")) {
      window.location.href = `${BASE_URL}/physics-inventory/deactivate/${id}`;
    }

    return;
  }
});
