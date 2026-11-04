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

// EDIT IT LAB 1 INVENTORY
document.addEventListener("click", function (e) {

    const btn = e.target.closest(".editBtn");

    if (!btn) return;

    e.preventDefault();

    const id = btn.dataset.id;

    fetch(`${BASE_URL}/it-lab1-inventory/view/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to retrieve inventory details.");
            }

            return response.json();
        })
        .then(data => {

            console.log(data);

            document.getElementById("edit_id").value = data.id ?? "";
            document.getElementById("edit_serial_number").value = data.serial_number ?? "";
            document.getElementById("edit_item_name").value = data.item_name ?? "";
            document.getElementById("edit_category").value = data.category ?? "";
            document.getElementById("edit_laboratory").value = data.laboratory ?? "IT Lab 1";
            document.getElementById("edit_status").value = data.status ?? "";

            const editModal = bootstrap.Modal.getOrCreateInstance(
                document.getElementById("itLab1EditInventoryModal")
            );

            editModal.show();

        })
        .catch(error => {
            console.error("Edit Error:", error);
            alert("Unable to load inventory details. Please try again.");
        });

});


// VIEW IT LAB 1 INVENTORY
document.addEventListener("click", function (e) {

    const btn = e.target.closest(".viewBtn");

    if (!btn) return;

    e.preventDefault();

    const id = btn.dataset.id;

    fetch(`${BASE_URL}/it-lab1-inventory/view/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to retrieve inventory details.");
            }

            return response.json();
        })
        .then(data => {

            document.getElementById("view_id").value = data.id ?? "";
            document.getElementById("view_serial_number").value = data.serial_number ?? "";
            document.getElementById("view_item_name").value = data.item_name ?? "";
            document.getElementById("view_category").value = data.category ?? "";
            document.getElementById("view_laboratory").value = data.laboratory ?? "";
            document.getElementById("view_status").value = data.status ?? "";

            const viewModal = bootstrap.Modal.getOrCreateInstance(
                document.getElementById("itLab1ViewInventoryModal")
            );

            viewModal.show();

        })
        .catch(error => {
            console.error("View Error:", error);
            alert("Unable to load inventory details. Please try again.");
        });

});


// DELETE IT LAB 1 INVENTORY
document.addEventListener("click", function (e) {

    const btn = e.target.closest(".deleteBtn");

    if (!btn) return;

    e.preventDefault();

    const id = btn.dataset.id;

    if (confirm("Are you sure you want to delete this inventory item?")) {

        window.location.href =
            `${BASE_URL}/it-lab1-inventory/delete/${id}`;

    }

});