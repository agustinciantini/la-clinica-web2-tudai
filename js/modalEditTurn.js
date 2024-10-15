//Agarro los botones editar.
let btn_editar=document.querySelectorAll("#btn-editar");
//Agarro el form.
let edit_form=document.getElementById("edit-form");

//A cada boton le agrego la funcion luego del click.
btn_editar.forEach(function (button) {
    button.addEventListener('click', function () {
        
        //Tomo el id de la categoria que tiene el boton.
        let turnId = this.getAttribute('data-id');

        // Seteo la URL del form con el ID correcto.
        edit_form.setAttribute('action', 'updateTurns/' + turnId);
    });
});


