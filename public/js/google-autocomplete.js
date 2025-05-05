function initAutocomplete() {
    const ac = new google.maps.places.Autocomplete(
        document.getElementById("address"),
        {
            types: ["address"],
            componentRestrictions: {
                country: "cl",
            },
        }
    );
    ac.addListener("place_changed", () => {
        const p = ac.getPlace();
        document.getElementById("latitude").value = p.geometry.location.lat();
        document.getElementById("longitude").value = p.geometry.location.lng();
        document.getElementById("latitude").classList.remove("d-none");
        document.getElementById("longitude").classList.remove("d-none");
    });
}

// Registrar la función en el `window` para que Google la reconozca al cargar
window.initAutocomplete = initAutocomplete;
