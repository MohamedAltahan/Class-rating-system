@extends('admin.layouts.master')
@section('mainTitle', __('Socials'))
@section('content')
    <div class="card-header">
        <h4>{{ __('Social media') }}</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.socials.create') }}" class="btn btn-primary">{{ __('+ Create new') }}</a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            // change status-------------------------------------------------------
            $(document).ready(function() {
                $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.socials.change-status') }}",
                        data: {
                            // status is the name of the value "ischecked" in you php function
                            status: isChecked,
                            id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            toastr.success(data.message)
                        },
                        error: function(error) {
                            toastr.error('Not updated')
                        }


                    })
                })
            })
        </script>
    @endpush
@endsection
