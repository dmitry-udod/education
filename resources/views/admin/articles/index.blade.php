@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="position: relative">
                    <h4>Iнформацiйнi блоки</h4>

                    <a href="{{ route('articles.create') }}" class="btn btn-primary pull-right panel-add-btn">
                        <span class="glyphicon glyphicon-plus-sign"></span> Додати
                    </a>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Назва</th>
                            <th class="col-lg-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->name }}</td>
                            <td>
                                <form class="btn-separator pull-right" action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash"></span> Видалити
                                    </button>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                </form>

                                <a class="btn btn-primary btn-sm pull-right" href="{{ route('articles.edit', $article->id) }}">
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
    {{  $articles->links() }}
    </div>
@endsection