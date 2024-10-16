//Agarro todos los botones "editar".
let boton_editar=document.querySelectorAll("#btn-editar");

//Agarro el formulario.
let edit_formulario=document.getElementById("edit-formulario");

boton_editar.forEach(function (button) {
    button.addEventListener('click', function () {
        //Tomo el id de la categoria que tiene el boton.
        let categoryId = this.getAttribute('data-id');

        // Seteo la URL del form con el ID correcto.
        edit_formulario.setAttribute('action', 'updateCategories/' + categoryId);
    });
});
