@extends('admin.layouts.master')
@section('mainTitle', __('Materials'))
@section('content')

    <div class="card-header">
        <h4>{{ __('All materials') }}</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.material.create') }}" class="btn btn-primary">{{ __('+ Create new') }}</a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    {{-- scripts ----------------------------------------------------------- --}}
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $(document).ready(function() {

                $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.material.change-status') }}",
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
