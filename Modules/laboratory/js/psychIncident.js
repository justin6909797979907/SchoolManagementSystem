
document.addEventListener("click", function (e) {

    // EDIT PSYCHOLOGY INCIDENT
    const editBtn = e.target.closest(".editPsyIncidentBtn");

    if (!editBtn) return;

    e.preventDefault();

    const id = editBtn.dataset.id;

    if (!id) {
        alert("Incident ID is missing.");
        return;
    }

    fetch(`${BASE_URL}/psycho-incident/view/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to retrieve incident record.");
            }

            return response.json();
        })
        .then(result => {

            // Support either direct JSON or wrapped JSON response.
            const record = result.data ?? result.record ?? result;

            if (!record || !record.id) {
                throw new Error("Incident record not found.");
            }

            // Fill Edit Modal fields
            document.getElementById("psy_edit_id").value = record.id ?? "";

            document.getElementById("psy_edit_incident_type").value =
                record.incident_type ?? "";

            // Convert MySQL datetime into datetime-local format.
            let incidentDate = record.incident_date ?? "";

            if (incidentDate) {
                incidentDate = incidentDate.replace(" ", "T").substring(0, 16);
            }

            document.getElementById("psy_edit_incident_date").value =
                incidentDate;

            document.getElementById("psy_edit_severity").value =
                record.severity ?? "low";

            document.getElementById("psy_edit_report_status").value =
                record.report_status ?? "pending";

            document.getElementById("psy_edit_laboratory").value =
                record.laboratory ?? "Psychology Laboratory";

            document.getElementById("psy_edit_inventory_id").value =
                record.inventory_id ?? "";

            document.getElementById("psy_edit_location_details").value =
                record.location_details ?? "";

            document.getElementById("psy_edit_description").value =
                record.description ?? "";

            document.getElementById("psy_edit_people_involved").value =
                record.people_involved ?? "";

            document.getElementById("psy_edit_action_taken").value =
                record.action_taken ?? "";

            document.getElementById("psy_edit_reported_by").value =
                record.reported_by ?? "";

            // Open Edit Modal after populating fields.
            const editModalElement =
                document.getElementById("psyEditIncidentModal");

            const editModal =
                bootstrap.Modal.getOrCreateInstance(editModalElement);

            editModal.show();

        })
        .catch(error => {
            console.error("Edit Incident Error:", error);
            alert(error.message || "Unable to load incident information.");
        });

});
