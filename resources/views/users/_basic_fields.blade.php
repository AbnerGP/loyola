<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">
        <p class="text-danger alertas" id="alert-name"></p>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nombre de usuario</label>
    <div class="col-sm-10">
        @if(isset($user->username))
            {{ $user->username }}
        @else
            <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
            <p class="text-danger alertas" id="alert-username"></p>
        @endif
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label">Correo electrónico</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}">
        <p class="text-danger alertas" id="alert-email"></p>
    </div>
</div>