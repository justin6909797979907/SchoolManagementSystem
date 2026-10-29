document.addEventListener("click", async function (event) {
  const button = event.target.closest(".view-incident");

  if (!button) {
    return;
  }

  const id = button.dataset.id;
  const content = document.getElementById("incidentViewContent");

  content.textContent = "Loading incident details...";

  const modal = bootstrap.Modal.getOrCreateInstance(
    document.getElementById("incidentViewModal"),
  );

  modal.show();

  try {
    const response = await fetch(
      "<?= BASE_URL ?>/physics-incident/view/" + encodeURIComponent(id),
    );

    const record = await response.json();

    if (!response.ok) {
      throw new Error(record.error || "Unable to load incident.");
    }

    // Build the details safely without inserting user data as HTML.
    content.replaceChildren();

    const fields = [
      ["Incident Number", record.incident_number],
      ["Incident Type", record.incident_type],
      ["Date", record.incident_date],
      ["Laboratory", record.laboratory],
      ["Location", record.location_details],
      ["Description", record.description],
      ["Reported By", record.reported_by],
      ["People Involved", record.people_involved],
      ["Action Taken", record.action_taken],
      ["Severity", record.severity],
      ["Report Status", record.report_status],
      ["Inventory Item", record.item_name],
    ];

    fields.forEach(function ([label, value]) {
      const wrapper = document.createElement("div");
      wrapper.className = "mb-3";

      const heading = document.createElement("strong");
      heading.textContent = label;

      const paragraph = document.createElement("p");
      paragraph.className = "mb-0";
      paragraph.textContent = value || "Not provided";

      wrapper.append(heading, paragraph);
      content.appendChild(wrapper);
    });
  } catch (error) {
    content.textContent = error.message;
  }
});

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
