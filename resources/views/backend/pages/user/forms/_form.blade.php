<form class="row g-3" method="POST" protected $casts=[ ];
    action="{{ isset($user) ? route('backend.user-update', ['user' => $user]) : route('backend.user-store') }}"
    enctype="multipart/form-data">
    <div class="row">

        @include('error')

        <div class="col-xl-6 mx-auto">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ (isset($user) ? 'Update' : 'Create') . ' User' }}</h6>
                        <hr>
                        @csrf

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Full Name *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" value="{{ isset($user) ? $user->name : old('name') }}">
                            @if (isset($errors) && $errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12 mb-2 ">
                            <label class="form-label">Email *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('email') ? 'is-invalid' : '' }}"
                                name="email" value="{{ isset($user) ? $user->email : old('email') }}">
                            @if (isset($errors) && $errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Password *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('password') ? 'is-invalid' : '' }}"
                                name="password" value="">
                            @if (isset($errors) && $errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Alias Name *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('alias_name') ? 'is-invalid' : '' }}"
                                name="alias_name" value="{{ isset($user) ? $user->alias_name : old('alias_name') }}">
                            @if (isset($errors) && $errors->has('alias_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alias_name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        Role and Permission
                    </h6>
                </div>
                <div class="card-body">
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Role *</label>
                        <select name="role_id" id="role-select" class="form-control">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ isset($user) && $user->role?->id == $role->id ? 'selected=selected' : '' }}>
                                    {{ $role->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-12 mb-2 ">

                        <label class="form-label">Permission *</label>

                        <select class="form-control tag-select" id="permission" multiple="multiple"
                            name="permissions[]">

                            @foreach ($permissions as $key => $permission)
                                <option {{ isset($user)? (in_array($permission, $user->permission['permissions'] )? "selected":""):"" }} value="{{ $permission }}">
                                    {{ unSlug($permission) }}</option>
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-2 ">

                        <label class="form-label">Avatar</label>

                        <input type="file" name="avatar" class="form-control">
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded mb-2">
                            <h6 class="mb-0 text-uppercase">Action</h6>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ isset($user) ? 'Update' : 'Save' }}
                            </button>
                            <a href="{{ route('backend.user-view') }}" class="btn btn-danger btn-block">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>

{{-- {{ dd(call_user_func_array('array_merge', collect($permissions)->pluck("*.name")->toArray())); }} --}}



@push('scripts')
    <script>
        window.data = @json(isset($user) ? $user->permission?->permissions : [])

        $(document).ready(function() {

            const select2 = $('#permission').select2({
                placeholder: 'Select Permission',
                allowClear: true,
                // tags: true,
                // templateResult: formatState,
                // templateSelection: formatState,

            });

            const callApi = (role_id) => {
                $.ajax({
                    url: "{{ route('backend.role-view') }}",
                    type: "GET",
                    data: {
                        role_id: role_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {

                        select2.val(data).trigger('change');

                    }
                });
            }

            $(document).on("change", "#role-select", function() {
                var role_id = $(this).val();
                callApi(role_id);
            });





        });
    </script>
@endpush
