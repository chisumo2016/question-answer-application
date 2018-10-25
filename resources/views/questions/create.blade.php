@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-centers">
                            <h2> Ask Questions</h2>

                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to all Questions</a>
                            </div>
                        </div>


                    </div>

                    <div class="card-body">
                        <form action="{{ route('questions.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="question-title">Question Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">

                                @if($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="question-description">Explain  you question</label>
                                <textarea name="description" id="question-description"  rows="10" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}">
                                    {{ old('description') }}
                                </textarea>

                                @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-lg">Ask this question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
