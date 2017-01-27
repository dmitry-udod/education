@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="position: relative">
                        <h4>@if (empty($category->id))Додавання @else Редагування @endif категорiї</h4>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="@if (!empty($category->id)) {{ route('categories.update', $category->id) }} @else {{ route('categories.store') }} @endif">
                            {{ csrf_field() }}

                            {{--Name --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Назва<span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $category->name or old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Email--}}
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="col-md-3 control-label">URL<span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ $category->slug or old('slug') }}" required>

                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Order --}}
                            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                <label for="order" class="col-md-3 control-label">Сортування<span class="required">*</span></label>
                                <div class="col-md-7">
                                    <input id="order" type="number" class="form-control" name="order" value="{{ $category->order or old('order') }}" required>

                                    @if ($errors->has('order'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span> Зберегти
                                    </button>
                                    <a class="back-link" href="{{ route('categories.index') }}">Назад</a>
                                </div>
                            </div>

                            @if (!empty($category->id))
                                <input type="hidden" name="_method" value="PUT" />
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection