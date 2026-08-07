document.addEventListener("click", function (e) {
  const btn = e.target.closest(".editBtn");

  if (!btn) return;

  e.preventDefault();

  let id = btn.dataset.id;

  fetch(`${BASE_URL}/psy_borrow/view/${id}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      document.getElementById("edit_id").value = data.id;
      document.getElementById("edit_item_name").value = data.item_name;
      document.getElementById("edit_laboratory").value = data.laboratory;
      document.getElementById("edit_borrower_name").value = data.borrower_name;
      document.getElementById("edit_quantity").value = data.quantity;
      document.getElementById("edit_borrowed_date").value = data.borrowed_date;
      document.getElementById("edit_returned_date").value = data.returned_date;
      document.getElementById("edit_status").value = data.status;

      let editModal = new bootstrap.Modal(
        document.getElementById("psyEditBorrowModal"),
      );

      editModal.show();
    })
    .catch((error) => console.error(error));
});

//view
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".viewBtn");

  if (!btn) return;

  e.preventDefault();

  let id = btn.dataset.id;

  fetch(`${BASE_URL}/psy_borrow/view/${id}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      document.getElementById("view_laboratory").value = data.laboratory;
      document.getElementById("view_borrower_name").value = data.borrower_name;
      document.getElementById("view_item_name").value = data.item_name;
      document.getElementById("view_quantity").value = data.quantity;
      document.getElementById("view_borrowed_date").value = data.borrowed_date;
      document.getElementById("view_returned_date").value = data.returned_date;
      document.getElementById("view_status").value = data.status;

      const viewModal = new bootstrap.Modal(
        document.getElementById("psyViewBorrowModal"),
      );

      viewModal.show();
    })
    .catch((error) => console.error(error));
});

//delete
document.addEventListener("click", function (e) {
  const btn = e.target.closest(".deleteBtn");

  if (!btn) return;

  e.preventDefault();

  let id = btn.dataset.id;

  if (confirm("Are you sure you want to delete this inventory?")) {
    window.location.href = `${BASE_URL}/psy_borrow/delete/${id}`;
  }
});
