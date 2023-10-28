<div class="form-body">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.name') }} <span class="required"></span> </label>
        <div class="col-md-10">
            <input type="text" name="name" value="{{ getData($data, 'name') }}" class="form-control" placeholder="{{ trans('main.fullname') }}" required>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>       
   
<!-- Add by Mario for Phone -->
    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.phone') }} <span class="required"></span> </label>
        <div class="col-md-10">
            <input type="text" name="phone" value="{{ getData($data, 'phone') }}" class="form-control" placeholder="{{ trans('main.phone') }}" required>
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.address') }} </label>
        <div class="col-md-6">
            <input type="textarea" name="address" value="{{ getData($data, 'address') }}" class="form-control" placeholder="{{ trans('main.address') }}" >
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
</div>
