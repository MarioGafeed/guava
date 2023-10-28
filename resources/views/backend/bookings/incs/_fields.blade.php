<div class="form-body">

    <div class="form-group{{ $errors->has('checkin_date') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.checkin_date') }} <span class="required"></span> </label>
        <div class="col-md-8">
            <div  class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                <input type="text" name="checkin_date" id="checkin_date" class="form-control" value="{{ getData($data, 'checkin_date')  }}"  required>
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
            @if ($errors->has('checkin_date'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('checkin_date') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- Add Appartment  --}}
    <div class="form-group{{ $errors->has('appartment_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.appartment') }} </label>
        <div class="col-md-6">
            <select class="form-control select2" id="appartment_id" name="appartment_id">
              <option value="">{{ trans('main.select_appartment') }}</option>
              @foreach ($appartments as $wp)
              <option value="{{ $wp->id }}" {{ getData($data, 'appartment_id') == $wp->id ? 'selected' : '' }} selected>
                     {{ $wp->name }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('appartment_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('appartment_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- Add Guests  --}}
    <div class="form-group{{ $errors->has('guest_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.guest') }} </label>
        <div class="col-md-6">
            <select class="form-control select2" id="guest_id" name="guest_id">
              <option value="">{{ trans('main.select_guest') }}</option>
              @foreach ($guests as $wp)
              <option value="{{ $wp->id }}" {{ getData($data, 'guest_id') == $wp->id ? 'selected' : '' }}>
                     {{ $wp->name }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('guest_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('guest_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('checkout_date') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.checkout_date') }} <span class="required"></span> </label>
        <div class="col-md-8">
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                <input type="text" name="checkout_date" id="date_checkout" class="form-control" value="{{ getData($data, 'checkout_date') ? null : '2030-12-30' }}" readonly required>
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
            @if ($errors->has('checkout_date'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('checkout_date') }}</strong>
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
