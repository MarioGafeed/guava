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
   
<!-- Add by Mario for hasbeds -->
    <div class="form-group{{ $errors->has('hasBeds') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.hasBeds') }} <span class="required"></span> </label>
        <div class="col-md-10">
            <input type="number" name="hasBeds" id="hasBeds" value="{{ getData($data, 'hasBeds') }}" class="form-control" placeholder="{{ trans('main.hasBeds') }}" required>
            @if ($errors->has('hasBeds'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('hasBeds') }}</strong>
                </span>
            @endif
        </div>
    </div>    

    <!-- Add by Mario for availableBeds -->
    <div class="form-group{{ $errors->has('availableBeds') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.availableBeds') }} <span class="required"></span> </label>
        <div class="col-md-10">
            <input type="number" name="availableBeds" id="availableBeds" value="{{ getData($data, 'availableBeds') }}" class="form-control" placeholder="{{ trans('main.availableBeds') }}" readonly>
            @if ($errors->has('availableBeds'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('availableBeds') }}</strong>
                </span>
            @endif
        </div>
    </div>    

    {{-- Add Appartment Place Location --}}
    <div class="form-group{{ $errors->has('place_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.place') }} </label>
        <div class="col-md-6">
            <select class="form-control select2" id="place_id" name="place_id">
              <option value="">{{ trans('main.select_place') }}</option>
              @foreach ($places as $wp)
              <option value="{{ $wp->id }}" {{ getData($data, 'place_id') == $wp->id ? 'selected' : '' }}>
                     {{ $wp->name }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('place_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('place_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.status') }} </span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="active" name="active">
                <option value="">{{ trans('main.status_choose') }}</option>
                <option value="1" {{ getData($data, 'active') == '1' ? ' selected' : '' }} selected>{{trans('main.active')}}</option>
                <option value="0" {{ getData($data, 'active') == '0' ? ' selected' : '' }}>{{trans('main.inactive')}}</option>
            </select>
            @if ($errors->has('active'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('active') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
</div>
