@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="position: relative">
                        <h4>Додавання користувача</h4>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="@if (!empty($role->id)) {{ route('roles.update', $role->id) }} @else {{ route('roles.store') }} @endif">
                            {{ csrf_field() }}

                            {{--Name --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Повне Iм'я<span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $role->name or old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Email--}}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">Email<span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ $role->email or old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Password--}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-3 control-label">Пароль<span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input id="password" type="password" class="form-control" name="password" value="{{ $role->password or old('password') }}" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Roles--}}
                            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                                <label for="roles" class="col-md-3 control-label">Ролi</label>
                                <div class="col-md-7">
                                    <select multiple id="roles" class="form-control" name="roles[]">
                                        @foreach($roles as $id => $role)
                                        <option value="{{ $id  }}">{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('roles'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span> Зберегти
                                    </button>
                                    <a class="back-link" href="{{ route('roles.index') }}">Назад</a>
                                </div>
                            </div>

                            @if (!empty($role->id))
                                <input type="hidden" name="_method" value="PUT" />
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection