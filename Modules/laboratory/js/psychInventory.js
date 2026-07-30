let psychInventoryBtn = document.getElementById("psychInventoryBtn");

psychInventoryBtn.addEventListener("click", function () {
  let addPsychInventoryModal = new bootstrap.Modal(
    document.getElementById("addPsychInventoryModal"),
  );
  addPsychInventoryModal.show();
});

document.querySelectorAll(".psychViewBtn").forEach((button) => {
  button.addEventListener("click", function () {
    let psyViewModal = new bootstrap.Modal(
      document.getElementById("psyViewInventoryModal"),
    );
    psyViewModal.show();

    let id = this.getAttribute("data-id");

    fetch(`${BASE_URL}/psycho-inventory/view/${id}`)
      .then((response) => response.json())
      .then((data) => {
        document.getElementById("view_id").value = data.id;
        document.getElementById("view_item_name").value = data.item_name;
        document.getElementById("view_category").value = data.category;
        document.getElementById("view_laboratory").value = data.laboratory;
        document.getElementById("view_total_item").value = data.total_item;
        document.getElementById("view_available_item").value =
          data.available_item;
        document.getElementById("view_status").value = data.status;
      })
      .catch((error) => {
        console.error("Error fetching damage details:", error);
      });
  });
});

document.addEventListener("click", function (e) {
  const btn = e.target.closest(".psychEditBtn");

  if (!btn) return;

  e.preventDefault();

  const id = btn.dataset.id;

  fetch(`${BASE_URL}/psycho-inventory/view/${id}`)
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("psy_edit_id").value = data.id;
      document.getElementById("psy_edit_item_name").value = data.item_name;
      document.getElementById("psy_edit_category").value = data.category;
      document.getElementById("psy_edit_laboratory").value = data.laboratory;
      document.getElementById("psy_edit_total_item").value = data.total_item;
      document.getElementById("psy_edit_available_item").value = data.available_item;
      document.getElementById("psy_edit_status").value = data.status;

      const modal = new bootstrap.Modal(
        document.getElementById("psyEditInventoryModal"),
      );
      modal.show();
    })
    .catch(console.error);
});

document
  .getElementById("editPsychForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(`${BASE_URL}/psycho-inventory/update`, {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          let psychEditModal = new bootstrap.Modal(
            document.getElementById("psyEditInventoryModal"),
          );
          psychEditModal.show();

          location.reload();
        } else {
          alert("Error: " + data.error);
        }
      })
      .catch((err) => console.error("Error updating damage:", err));
  });

document.querySelectorAll(".deleteBtn").forEach((button) => {
  button.addEventListener("click", function () {
    let id = this.getAttribute("data-id");

    if (confirm("Are you sure you want to delete this damage?")) {
      fetch(`${BASE_URL}/psycho-inventory/delete/${id}`, {
        method: "POST",
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            location.reload();
          } else {
            alert("Error: " + data.error);
          }
        })
        .catch((err) => console.error("Error deleting damage:", err));
    }
  });
});
