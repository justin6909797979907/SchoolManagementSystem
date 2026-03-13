let CreateDamageBtn = document.getElementById("CreateDamageBtn");
 const viewButtons = document.querySelectorAll(".viewDamageBtn");

CreateDamageBtn.addEventListener("click", function() {
    let addDamageModal = new bootstrap.Modal(document.getElementById("addDamageModal"));
    addDamageModal.show();
});


    viewButtons.forEach(button => {
        button.addEventListener("click", function () {

            let id = this.getAttribute("data-id");

        
            // open modal
            let modal = new bootstrap.Modal(document.getElementById('viewDamageModal'));
            modal.show();

            // example: set id inside modal
            document.getElementById("damage_id").value = id;


                // Fetch damage details using AJAX\
            
            fetch(`${BASE_URL}/damages/view/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("damage_id").textContent = data.id;
                    document.getElementById("damage_code").textContent = data.code;
                    document.getElementById("damage_category").textContent = data.category;
                    document.getElementById("damage_description").textContent = data.description;
                })
                .catch(error => {
                    console.error('Error fetching damage details:', error);
                });
               

        });
    });
