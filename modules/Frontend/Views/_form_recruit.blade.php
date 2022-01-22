<div class="recruit-form-modal">
    <div class="row g-0">
        <div class="col-md-5">
            <img src="{{ asset($banner) }}" width="100%" alt="" style="background-repeat: no-repeat; background-size: cover;">
        </div>
        <div class="col-md-7 pt-5 pb-4 position-relative">
            <button type="button" class="btn-close position-absolute" style="top: 10px; right: 20px" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="" method="post" id="recruit-form" class="m-0">
                @csrf
                <div class="px-4 pb-4">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">{{ trans('Company Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="career">{{ trans('Career') }}</label>
                            @php($prompt = ['' => trans("- Select career -")])
                            {!! Form::select('career_id', $prompt + $careers, NULL, [
                            'id' => 'career_id',
                            'class' => 'select2 form-control w-100']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">{{ trans("Email") }}</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">{{ trans("Phone") }}</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address">{{ trans("Address") }}</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="content">{{ trans("Content") }}</label>
                            <textarea name="content" class="form-control" id="content" rows="10"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary text-uppercase w-25">{{ trans("Send") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
{!! JsValidator::formRequest('Modules\Frontend\Requests\RecruitmentRequest', "#recruit-form") !!}
