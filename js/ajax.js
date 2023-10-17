const formulariosAjax = document.querySelectorAll(".FormularioAjax");

function enviarFormularioAjax(e) {
    e.preventDefault();

    const enviar = confirm("¿Quieres enviar el formulario?");

    if (enviar) {
        const formData = new FormData(this);
        const method = this.getAttribute("method");
        const action = this.getAttribute("action");

        const headers = new Headers();

        const config = {
            method: method,
            headers: headers,
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        };

        fetch(action, config)
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                const contenedor = document.querySelector(".form-rest");
                contenedor.innerHTML = respuesta;
            });
    }
}

formulariosAjax.forEach(formulario => {
    formulario.addEventListener("submit", enviarFormularioAjax);
});
