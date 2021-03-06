@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="position: relative">
                    <h4>Ролi</h4>

                    <a href="{{ route('roles.create') }}" class="btn btn-primary pull-right panel-add-btn">
                        <span class="glyphicon glyphicon-plus-sign"></span> Додати
                    </a>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Назва</th>
                            <th>Дата створення</th>
                            <th class="col-lg-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <th scope="row">{{ $role->id }}</th>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>
                                @if ($role->name !== \App\Role::ROLE_SLUG_ADMIN)
                                <form class="btn-separator pull-right" action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash"></span> Видалити
                                    </button>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                </form>
                                @endif

                                <a class="btn btn-primary btn-sm pull-right" href="{{ route('roles.edit', $role->id) }}">
                                    <span class="glyphicon glyphicon-edit"></span> Редагувати
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection