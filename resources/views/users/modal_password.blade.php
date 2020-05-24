<div class="modal inmodal" id="modal_password" tabindex="-1" role="dialog" aria-hidden="true">
    <form id="form_password" action="" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <i class="fa fa-keyboard-o modal-icon"></i>
                    <h4 class="modal-title" id="modal_title">Usuario</h4>
                    <small class="font-bold">Cambio de contraseña.</small>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" placeholder="Escriba nueva contraseña" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirme contraseña" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <p class="text-danger alertas" id="alert-password"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#form_password').submit()" data-dismiss="modal">Cambiar contraseña</button>
                </div>
            </div>
        </div>
    </form>
</div>