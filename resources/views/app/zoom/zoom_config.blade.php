@extends('layout.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('general') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>{{__('Zoom Config')}}
            </h4>

        <x-form
            method="POST"
            action="{{ route('zoom.update', $generalsetting->id) }}"
            class="mt-4"
        >
        @method('PATCH')
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 control-label text-right" for="api_key">{{__('Zoom api key')}}</label>
                    <div class="col-sm-9">
                        <input type="text" id="api_key" name="api_key" value="{{ $generalsetting->api_key }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label text-right" for="api_secret">{{__('Zoom api secret')}}</label>
                    <div class="col-sm-9">
                        <input type="text" id="api_secret" name="api_secret" value="{{ $generalsetting->api_secret }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label text-right" for="zoom_email">{{__('Zoom Email')}}</label>
                    <div class="col-sm-9">
                        <input type="text" id="zoom_email" name="zoom_email" value="{{ $generalsetting->zoom_email }}" class="form-control">
                    </div>
                </div>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary float-right" type="submit">{{__('Save')}}</button>
            </div>
        </div>
    </div>
</div>
</x-form>
</div>
</div>
</div>
@endsection
