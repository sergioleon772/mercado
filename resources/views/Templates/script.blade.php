<script>
    // Mostrar/ocultar contraseña
    const togglePasswordBtn = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");

    if (togglePasswordBtn && passwordField) {
        togglePasswordBtn.addEventListener("click", function() {
            let icon = this.querySelector("i");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        });
    }

    // Limpiar RUT
    function limpiarRut(rut) {
        return rut.replace(/[^0-9kK]/g, "").toUpperCase();
    }

    // Formatear RUT
    function formatearRut(rut) {
        rut = limpiarRut(rut);
        if (rut.length <= 1) return rut;

        const cuerpo = rut.slice(0, -1);
        const dv = rut.slice(-1);

        let cuerpoFormateado = "";
        let i = 0;
        for (let pos = cuerpo.length - 1; pos >= 0; pos--) {
            cuerpoFormateado = cuerpo[pos] + cuerpoFormateado;
            i++;
            if (i % 3 === 0 && pos !== 0) {
                cuerpoFormateado = "." + cuerpoFormateado;
            }
        }

        return cuerpoFormateado + "-" + dv;
    }

    // Detectar campo de RUT dinámicamente
    document.addEventListener("DOMContentLoaded", function() {
        const rutInput = document.getElementById("rut") || document.getElementById("rut_empresa");

        if (rutInput) {
            rutInput.addEventListener("input", function() {
                const rutSinFormato = limpiarRut(rutInput.value);
                const rutFormateado = formatearRut(rutSinFormato);
                rutInput.value = rutFormateado;
            });
        }
    });
</script>
