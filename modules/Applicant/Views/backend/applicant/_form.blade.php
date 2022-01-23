<form action="" method="post" id="applicant-form" enctype=multipart/form-data>
    @csrf
    @php($prompt = ['' => trans('Select')])
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="title">{{ trans('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name ?? NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email" class="title">{{ trans('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $data->email ?? NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="phone" class="title">{{ trans('Phone') }}</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone ?? NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="address" class="title">{{ trans('Address') }}</label>
                <input type="text" class="form-control" id="address" name="address"
                       value="{{ $data->address ?? NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="birthday" class="title">{{ trans('Birthday') }}</label>
                <input type="text" class="form-control date" id="birthday" name="birthday"
                       value="{{isset($data->birthday) ? date('d-m-Y',strtotime($data->birthday)) : NULL }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="birthday" class="title">{{ trans('CV File') }}</label>
                <br>
                <input type="file" class="form-control" name="file" value="{{$data->file ?? NULL}}">
                @if(isset($data))
                    <a href="{{ asset($data->file) }}" class="w-100" target="_blank">{{ trans('CV file link') }}</a>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="birthday" class="title">{{ trans('Post') }}</label>
                    <br>
                    {!! Form::select('post_id', ["" => trans('Select')] + $posts, $post->id ?? NULL, [
                        'id' => 'post',
                        'class' => 'select2 form-control']) !!}
                    @if(isset($post))
                        <a href="{{ route('get.post.update', $post->id) }}" class="w-100"
                           target="_blank">{{ $post->title }}</a>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="status" class="title">{{ trans('Position') }}</label>
                    {!! Form::select('position_id', ["" => trans('Select')] + $positions, $data->position_id ?? NULL, [
                        'id' => 'position',
                        'class' => 'select2 form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="experience" class="title">{{ trans('Experience') }}</label><br>
                <textarea name="experience" id="experience" class="form-control"
                          rows="10">{{ $data->experience ?? NULL }}</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="status" class="title">{{ trans('Status') }}</label>
                {!! Form::select('status', $statuses, $data->status ?? NULL, [
                    'id' => 'status',
                    'class' => 'select2 form-control']) !!}
            </div>
            @if(isset($data))
                <div class="form-group">
                    <label for="tags" class="title">{{ trans('Updated At') }}</label>
                    <div>{{ formatDate(strtotime($data->updated_at), 'd-m-Y H:i:s') }}</div>
                </div>
                <div class="form-group">
                    <label for="tags" class="title">{{ trans('Created At') }}</label>
                    <div>{{ formatDate(strtotime($data->created_at), 'd-m-Y H:i:s') }}</div>
                </div>
            @endif
        </div>
    </div>
    <div class="input-group">
        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-default" data-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>
@push('js')
    {!! JsValidator::formRequest('Modules\Applicant\Requests\ApplicantRequest','#applicant-form') !!}

    <script !src="">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.tag-select2').select2({
                tags: true
            })
        })
    </script>
@endpush
