document.addEventListener("submit", function (e) {

    if (!e.target.matches("#addScheduleForm")) {
        return;
    }

    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch(`${BASE_URL}/schedule/create`, {
        method: "POST",
        body: formData
    })
    .then(async response => {

        const text = await response.text();

        console.log("HTTP STATUS:", response.status);
        console.log("SERVER RESPONSE:", text);

        let data;

        try {
            data = JSON.parse(text);
        } catch (error) {
            throw new Error(
                "Server returned invalid JSON:\n\n" + text
            );
        }

        if (!response.ok) {
            throw new Error(
                data.error || "Server error."
            );
        }

        return data;
    })
    .then(data => {

        console.log("DATA:", data);

        if (data.success) {

            alert("Schedule added successfully!");

            location.reload();

        } else {

            alert(data.error || "Failed to add schedule.");

        }

    })
    .catch(error => {

        console.error("CREATE SCHEDULE ERROR:", error);

        alert(error.message);

    });

});