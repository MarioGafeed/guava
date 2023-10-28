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

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.image') }}</label>
        <div class="col-md-10">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'image')))
                        <img src="{{ ShowImage(getData($data, 'image')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.select_image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="image">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('image') }}</strong>
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
    <div class="form-group{{ $errors->has('identity') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.identity') }}  </label>
        <div class="col-md-10">
            <input type="text" name="identity" value="{{ getData($data, 'identity') }}" class="form-control" placeholder="{{ trans('main.identity') }}" required>
            @if ($errors->has('identity'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('identity') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- Add Guest Work Location --}}
    <div class="form-group{{ $errors->has('workplace_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.workplace') }} </label>
        <div class="col-md-6">
            <select class="form-control select2" id="workplace_id" name="workplace_id">
              <option value="">{{ trans('main.select workplace') }}</option>
              @foreach ($workplaces as $wp)
              <option value="{{ $wp->id }}" {{ getData($data, 'workplace_id') == $wp->id ? 'selected' : '' }}>
                     {{ $wp->name }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('workplace_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('workplace_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('vacation_day_start') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.vacation_day_start') }} </label>
        <div class="col-md-6">
            <select class="form-control select2" id="vacation_day_start" name="vacation_day_start">
              <option value="">{{ trans('main.vacation_day_start') }}</option>
              @foreach (range(1, 30) as $day)
                <option value="{{ $day }}" {{ getData($data, 'vacation_day_start') == $day ? 'selected' : '' }}>
                    {{ $day }}
                </option>
              @endforeach
            </select>
            @if ($errors->has('vacation_day_start'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('vacation_day_start') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('vacation_day_end') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.vacation_day_end') }} </label>
        <div class="col-md-6">
            <select class="form-control select2" id="vacation_day_end" name="vacation_day_end">
              <option value="">{{ trans('main.vacation_day_end') }}</option>
              @foreach (range(1, 30) as $day)
                <option value="{{ $day }}" {{ getData($data, 'vacation_day_end') == $day ? 'selected' : '' }}>
                    {{ $day }}
                </option>
              @endforeach
            </select>
            @if ($errors->has('vacation_day_end'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('vacation_day_end') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.status') }} </span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="active" name="active">
                <option value="">{{ trans('main.status_choose') }}</option>
                <option value="1" {{ getData($data, 'active') == '1' ? ' selected' : '' }} selected>{{trans('main.active')}} </option>
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
