

const tbody = document.getElementById("enrollee-documents-table-body");

loadDocuments(applicantId);



tbody.addEventListener("click", function (e) {

    const target = e.target.dataset.action;
    const uncleanAction = e.target.textContent;
    const action = uncleanAction.trim(); 


    if(!target) return;


      Swal.fire({
            title: `Are you sure ?`,
            text: `The applicant document will ${action.toLowerCase()} .Do you wish to proceed?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: `Yes, I understand`,
            }).then((result) => {

              if(result.isConfirmed){

                  // if confirm 

                  
        fetch(`${BASE_URL}/enrollees/${target}/update`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                applicant_id: target,
                status: action
            })
        })
        .then(res => res.json())
        .then(data => {

            if(data.status === 'success')
            {

            loadDocuments(applicantId);

            }

           
        });

              }else{

                return;

              }

            })

            


    

});


function loadDocuments(applicantId) {

    fetch(`${BASE_URL}/enrollees/${applicantId}/allDocs`)
        .then(response => response.json())
        .then(documents => {

            const tbody = document.getElementById("enrollee-documents-table-body");

            tbody.innerHTML = "";

            documents.forEach(doc => {

                let badgeClass = "bg-secondary";

                switch (doc.submission_status) {
                    case "pending":
                        badgeClass = "bg-warning";
                        break;

                    case "verified":
                        badgeClass = "bg-success";
                        break;

                    case "rejected":
                        badgeClass = "bg-danger";
                        break;
                }

                const disabled = doc.submission_status === "Missing" ? "disabled" : "";

                tbody.innerHTML += `
                    <tr>
                        <td>${doc.requirement_name}</td>

                        <td>
                            <span class="badge ${badgeClass}">
                                ${doc.submission_status.charAt(0).toUpperCase() + doc.submission_status.slice(1)}
                            </span>
                        </td>

                        <td>
                            <a href="${doc.doc_path}"
                               data-lightbox="doc-${doc.document_id}"
                               class="btn btn-sm btn-primary ${disabled}"
                               ">
                                View
                            </a>

                            <button
                                class="btn btn-sm btn-success  ${disabled}"
                                data-action="${doc.document_id}">
                                Approve
                            </button>

                            <button
                                class="btn btn-sm btn-danger  ${disabled}"
                                data-action="${doc.document_id}">
                                Reject
                            </button>
                        </td>
                    </tr>
                `;
            });

        });
}





