<div class="row recruit-form-modal">
    <div class="col-md-5 p-0">
        <img src="{{ $banner }}"
             width="100%" alt="" style="background-repeat: no-repeat; background-size: cover;">
    </div>
    <div class="col-md-7 pt-5 position-relative">
        <button type="button" class="btn-close position-absolute" style="top: 10px; right: 20px"
                data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post" id="recruit-form">
            @csrf
            <div class="px-4">
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
                        'class' => 'select2 form-control']) !!}
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
                        <textarea name="content" class="form-control" id="content" rows="15"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary text-uppercase w-25">{{ trans("Send") }}</button>
                <div class="py-3">
                    <div class="text-danger">
                        * Hoặc bạn có thể gọi trực tiếp cho chúng tôi tại Hotline: <a
                            href="tel:+84-364-669-810">+84-364-669-810</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{!! JsValidator::formRequest('Modules\Frontend\Requests\RecruitmentRequest', "#recruit-form") !!}
