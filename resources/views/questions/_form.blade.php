@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" id="question-title" value="{{old('title',$question->title??'')}}" placeholder="Question Title" class="form-control {{$errors->has('title')?'is-invalid':''}}">
    @if($errors->has('title'))
        <div class="invalid-feedback"><strong>{{$errors->first('title')}}</strong></div>
    @endif
</div>
<div class="form-group">
    <label for="question-body">Question Body</label>
    <textarea name="body" id="question-body" placeholder="Question Body" rows="5" class="form-control {{$errors->has('body')?'is-invalid':''}}">{{old('body',$question->body??'')}}</textarea>
    @if($errors->has('body'))
        <div class="invalid-feedback"><strong>{{$errors->first('body')}}</strong></div>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-md">{{$buttonText}}</button>
</div>
