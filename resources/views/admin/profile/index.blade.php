@extends('admin.layouts.master')
@section('mainTitle', 'Profile')
@section('content')
    <!-- Main Content -->
    <div class="row mt-sm-4">
        {{-- edit profile ------------------------------------------------------- --}}
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" enctype="multipart/form-data" class="needs-validation"
                    action="{{ route('admin.profile.update') }}" novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>{{ __('Edit Profile') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="form-group mx-1 ">
                            <img width='200px' src="{{ asset('uploads/' . Auth::guard('web')->user()->image) }}"
                                alt="image">
                        </div>


                        <div class="form-group col-md-12">
                            <x-form.input accept="image/*" label="Image" name='image' type='file' />
                        </div>

                        <div class="form-group  col-md-12">
                            <x-form.input label="UserName" name='name' placeholder="{{ __('Your name') }}"
                                value="{{ Auth::guard('web')->user()->name }}" />
                        </div>

                        <div class="form-group  col-md-12">
                            <x-form.input label="Phone" name='phone' placeholder="{{ __('Your phone number') }}"
                                value="{{ Auth::guard('web')->user()->phone }}" />
                        </div>

                        <div class="form-group  col-md-12">
                            <x-form.input label="Email" name='email' placeholder="{{ __('your Email') }}"
                                value="{{ Auth::guard('web')->user()->email }}" />
                        </div>

                        <div class="form-group  col-md-12">
                            <x-form.input label="Residence number" name='residence_number'
                                placeholder="{{ __('Residence number') }}"
                                value="{{ Auth::guard('web')->user()->residence_number }}" />
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        {{-- update password------------------------------------------------------- --}}
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" class="needs-validation" action="{{ route('admin.password.update') }}" novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>{{ __('Update password') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="form-group mx-1 col-12">
                                <x-form.input type='password' label="Current password" name='current_password'
                                    placeholder="{{ __('Current password') }}" />
                            </div>

                            <div class="form-group mx-1 col-12">
                                <x-form.input type='password' label="New password" name='password'
                                    placeholder="{{ __('New password') }}" />
                            </div>

                            <div class="form-group mx-1 col-12">
                                <x-form.input type='password' label="Confirm password" name='password_confirmation'
                                    placeholder="{{ __('Confirm password') }}" />
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
