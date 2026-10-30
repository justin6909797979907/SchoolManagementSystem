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

    fetch(`${BASE_URL}/psycho-inventory/view/${id}`)
      .then(async (response) => {
        if (!response.ok) {
          throw new Error(`HTTP Error: ${response.status}`);
        }

        return response.json();
      })
      .then((data) => {
        if (!data || !data.id) {
          throw new Error("Inventory item not found.");
        }

        const fields = {
          edit_id: data.id,
          edit_serial_number: data.serial_number ?? "",
          edit_item_name: data.item_name ?? "",
          edit_category: data.category ?? "",
          edit_laboratory: data.laboratory ?? "Psychology Laboratory",
          edit_status: data.status ?? "working",
        };

        Object.entries(fields).forEach(([id, value]) => {
          const element = document.getElementById(id);

          if (!element) {
            throw new Error(`Missing element: ${id}`);
          }

          element.value = value;
        });

        const modalElement = document.getElementById("psyEditInventoryModal");

        if (!modalElement) {
          throw new Error("Psychology Edit modal not found.");
        }

        bootstrap.Modal.getOrCreateInstance(modalElement).show();
      })
      .catch((error) => {
        console.error("Edit error:", error);
        alert("Unable to load the inventory item. Check the browser console.");
      });

    return;
  }

  // VIEW INVENTORY ITEM
  const viewBtn = e.target.closest(".viewBtn");

  if (viewBtn) {
    e.preventDefault();

    const id = viewBtn.dataset.id;

    fetch(`${BASE_URL}/psycho-inventory/view/${id}`)
      .then(async (response) => {
        if (!response.ok) {
          throw new Error(`HTTP Error: ${response.status}`);
        }

        return response.json();
      })
      .then((data) => {
        if (!data || !data.id) {
          throw new Error("Inventory item not found.");
        }

        const fields = {
          view_id: data.id,
          view_serial_number: data.serial_number ?? "",
          view_item_name: data.item_name ?? "",
          view_category: data.category ?? "",
          view_laboratory: data.laboratory ?? "Psychology Laboratory",
          view_status: data.status ?? "",
        };

        Object.entries(fields).forEach(([id, value]) => {
          const element = document.getElementById(id);

          if (!element) {
            throw new Error(`Missing element: ${id}`);
          }

          element.value = value;
        });

        const modalElement = document.getElementById("psyViewInventoryModal");

        if (!modalElement) {
          throw new Error("Psychology View modal not found.");
        }

        bootstrap.Modal.getOrCreateInstance(modalElement).show();
      })
      .catch((error) => {
        console.error("View error:", error);
        alert("Unable to load the inventory item. Check the browser console.");
      });

    return;
  }

  // ARCHIVE INVENTORY ITEM
  const deactivateBtn = e.target.closest(".deactivateBtn");

  if (deactivateBtn) {
    e.preventDefault();

    const id = deactivateBtn.dataset.id;

    if (confirm("Are you sure you want to deactivate this inventory item?")) {
      window.location.href = `${BASE_URL}/psycho-inventory/deactivate/${id}`;
    }

    return;
  }
});
