<form action="{{ route('post.frontend.apply', ["id" => $data->id, "slug" => $data->slug]) }}" method="post"
      enctype="multipart/form-data" id="apply-form">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('Name') }} <small>*</small></label>
                <input type="text" id="name" name="name" class="form-control"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="birthday">{{ trans('Birthday') }} <small>*</small></label>
                <input type="text" name="birthday" id="birthday" class="form-control"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="email">{{ trans('Email') }} <small>*</small></label>
                <input type="email" id="email" name="email" class="form-control"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="address">{{ trans('Address') }} <small>*</small></label>
                <input type="text" id="address" name="address" class="form-control"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="phone">{{ trans('Phone') }} <small>*</small></label>
                <input type="phone" id="phone" name="phone" class="form-control"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="position">{{ trans('Position') }} <small>*</small></label>
                {!! Form::select('position_id', ["" => trans("- Select Position -")] + $positions, NULL, [
                'id' => 'position',
                'class' => 'select2 form-control w-100']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="file">CV file</label>
                <input type="file" name="file" id="file" class="form-control"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="experience">{{ trans('Experience') }}</label>
                <textarea name="experience" id="experience" rows="6" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <button class="button button-3d button-large" type="submit">{{ trans('Apply') }}</button>
        </div>
    </div>
</form>
@push('js')
{!! JsValidator::formRequest('Modules\Frontend\Requests\ApplyRequest', "#apply-form") !!}
@endpush
