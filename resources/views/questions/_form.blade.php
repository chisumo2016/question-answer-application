{{ csrf_field() }}
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" value="{{ old('title', $question->title) }}" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">

    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="question-description">Explain  you question</label>
    <textarea name="description" id="question-description"  rows="10" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}">
        {{ old('description', $question->description) }}
     </textarea>

    @if($errors->has('description'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('description') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>