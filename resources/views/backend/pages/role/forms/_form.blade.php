@php
function getTitle($str)
{
    return ucwords(str_replace('-', ' ', $str));
}
@endphp

<form class="row g-3" method="POST"
    action="{{ isset($role) ? route('backend.role-update', ['role' => $role]) : route('backend.role-store') }}"
    enctype="multipart/form-data">
    <div class="row">

        @include('error')

        <div class="col-xl-8 mx-auto">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ (isset($role) ? 'Update' : 'Create') . ' Role' }}</h6>
                        <hr>
                        @csrf

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Title *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" value="{{ isset($role) ? $role->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>



                        <div class="col-12 mb-2 ">

                            <label class="form-label">Permission *</label>

                            <select class="form-control tag-select" id="permission" multiple="multiple"
                                name="permissions[]" aria-placeholder="Enter  Tags">
                                @foreach ($permissions as $key => $permission_array)
                                    <optgroup label="{{ unSlug($key) }}">
                                        @foreach ($permission_array as $permission)
                                            <option value="{{ $permission['name'] }}">
                                                {{ unSlug($permission['title']) }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded mb-2">
                        <h6 class="mb-0 text-uppercase">Action</h6>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ isset($role) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('backend.role-view') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>


@push('scripts')
    <script>
        window.data = @json(isset($role) ? $role->permissions : [])

        function formatState(item) {
            opt = $(item.element);

            og = opt.closest('optgroup').attr('label');
            return og + ' | ' + item.text;
        };

        $(document).ready(function() {
            $('#permission').select2({
                placeholder: 'Select Permission',
                allowClear: true,
                templateResult: formatState,
                templateSelection: formatState,

            });
        });

        $('#permission').select2().val(data).trigger('change');
    </script>
@endpush
