@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="position: relative">
                    <h4>Категорiї</h4>

                    <a href="{{ route('categories.create') }}" class="btn btn-primary pull-right panel-add-btn">
                        <span class="glyphicon glyphicon-plus-sign"></span> Додати
                    </a>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th>URL</th>
                            <th>Сортування</th>
                            <th class="col-lg-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->order }}</td>
                            <td>
                                <form class="btn-separator pull-right" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash"></span> Видалити
                                    </button>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                </form>

                                <a class="btn btn-primary btn-sm pull-right" href="{{ route('categories.edit', $category->id) }}">
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

    <div class="pull-right">
    {{  $categories->links() }}
    </div>
@endsection