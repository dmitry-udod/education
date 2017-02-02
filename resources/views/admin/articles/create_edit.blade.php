@extends('layouts.app')

@section('css')
    <link href="/css/bootstrap-datetimepicker.css" rel="stylesheet">
@endsection

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="position: relative">
                        <h4>@if (empty($category->id))Додавання @else Редагування @endif iнформацiйного блоку</h4>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="@if (!empty($category->id)) {{ route('categories.update', $category->id) }} @else {{ route('categories.store') }} @endif">
                            {{ csrf_field() }}

                            {{--Name --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Назва<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $category->name or old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Html --}}
                            <div class="form-group{{ $errors->has('html') ? ' has-error' : '' }}">
                                <label for="html" class="col-md-2 control-label">Контент<span class="required">*</span></label>
                                <div class="col-md-10">
                                    <textarea id="html" class="form-control" name="html">{{ $category->html or old('html') }}</textarea>

                                    @if ($errors->has('html'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('html') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Roles--}}
                            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                                <label for="roles" class="col-md-2 control-label">Рiвень</label>
                                <div class="col-md-10">
                                    <select multiple id="roles" class="form-control" name="roles[]">
                                        @foreach($roles as $id => $role)

                                            <option value="{{ $id  }}" @if (in_array($id, [])) selected @endif>{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('roles'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Roles--}}
                            <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                                <label for="categories" class="col-md-2 control-label">Категорiя</label>
                                <div class="col-md-10">
                                    <select multiple id="categories" class="form-control" name="categories[]">
                                        @foreach($categories as $id => $category)

                                            <option value="{{ $id  }}" @if (in_array($id, [])) selected @endif>{{ $category }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('roles'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Is Published --}}
                            <div class="form-group{{ $errors->has('is_publish') ? ' has-error' : '' }}">
                                <label for="is_publish" class="col-md-2 control-label">Опублiковати</label>
                                <div class="col-md-10">
                                    <input id="is_publish" type="checkbox"  name="is_publish" value="{{ $category->is_publish or old('is_publish') }}">

                                    @if ($errors->has('is_publish'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_publish') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Published At --}}
                            <div class="form-group{{ $errors->has('publish_at') ? ' has-error' : '' }}">
                                <label for="publish_at" class="col-md-2 control-label">Опублiковати з</label>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker2'>
                                            <input id="publish_at" type="text"  class="form-control" name="publish_at" value="{{ $category->publish_at or old('publish_at') }}">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    @if ($errors->has('publish_at'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('publish_at') }}</strong>
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

@section('js')
    <script src="/js/ckeditor/ckeditor.js"></script>

    <script src="/js/moment-with-locales.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>
    <script>
        CKEDITOR.replace('html', {
            extraPlugins: 'uploadimage,colorbutton',
            // Upload images to a CKFinder connector (note that the response type is set to JSON).
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

            language: "uk",

        });


        $(function () {
            $('#datetimepicker2').datetimepicker({
                locale: 'ru'
            });
        });
    </script>
@endsection