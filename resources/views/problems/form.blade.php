@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $title }}</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="post" class=" form-label-left" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group row{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="form-control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" value="{{ old('name') ?: $problem->name }}"
                                       required="required" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('name'))
                                    <span class="form-text">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label class="form-control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" required="required"
                                          class="form-control col-md-7 col-xs-12">{{ old('description') ?: $problem->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="form-text">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('difficulty') ? ' has-danger' : '' }}">
                            <label class="form-control-label col-md-3 col-sm-3 col-xs-12" for="difficulty">Difficulty <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="difficulty" required="required" class="form-control col-md-7 col-xs-12">
                                    @for($i = 0; $i <=5; $i++)
                                        <option value="{{ $i }}" {{ !($problem->difficulty == $i)? : 'selected' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('difficulty'))
                                    <span class="form-text">
                                        <strong>{{ $errors->first('difficulty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('archive') ? ' has-danger' : '' }}">
                            <label class="form-control-label col-md-3 col-sm-3 col-xs-12" for="archive">Archive</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="archive" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('archive'))
                                    <span class="form-text">
                                        <strong>{{ $errors->first('archive') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('image') ? ' has-danger' : '' }}">
                            <label class="form-control-label col-md-3 col-sm-3 col-xs-12" for="image">Image</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="image" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('image'))
                                    <span class="form-text">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('volumes') ? ' has-danger' : '' }}">
                            <label class="form-control-label col-md-3 col-sm-3 col-xs-12" for="volumes">Volumes</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="volumes[]" data-select-volume class="form-control col-md-7 col-xs-12" multiple>
                                    @foreach(\App\Volume::all() as $volume)
                                        <option value="{{ $volume->id }}" {{ $problem->volumes()->find($volume->id) ? 'selected' : '' }}>{{ $volume->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('volumes'))
                                    <span class="form-text">
                                        <strong>{{ $errors->first('volumes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-primary"
                                   href=""
                                   data-toggle="confirmation"
                                   data-message="Are you sure you want to leave the page? The changes won't be saved."
                                   data-btn-ok-href="{{ route('problems::list') }}"
                                   data-btn-ok-label="Leave the page">Cancel</a>

                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
