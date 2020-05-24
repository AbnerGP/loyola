<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="form_user" action="" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label"><b>Nombre:</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                        <p class="text-danger alertas" id="alert-name"></p>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label"><b>Usuario:</b></label>
                        <input type="text" class="form-control" name="username" id="username">
                        <p class="text-danger alertas" id="alert-username"></p>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label"><b>Correo electrónico:</b></label>
                        <input type="text" class="form-control" name="email" id="email">
                        <p class="text-danger alertas" id="alert-email"></p>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label"><b>Comentarios:</b></label>
                        <textarea name="comments" id="comments" class="form-control"></textarea>
                        <p class="text-danger alertas" id="alert-comments"></p>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label"><b>Rol:</b></label>
                        <select name="role" id="role" class="form-control">
                            {!! $roles !!}
                        </select>

                        <p class="text-danger alertas" id="alertedit-template"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_save" onclick="$('#form_user').submit()">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
</div>