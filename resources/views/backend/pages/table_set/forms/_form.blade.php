@php
    $parentCategories = [];
    $childCategories = [];
    $allCategories = [];

    foreach ($categories as $category){
        array_push($allCategories, $category);
        foreach ($categories as $cat){
            if ($category->id == $cat->parent_id){
                array_push($parentCategories, $category);
                break;
            }
        }
    }
    $writableCategories = array_diff($allCategories, $parentCategories);
@endphp
<form class="row g-3" method="POST"
    action="{{ isset($table_set) ? route('backend.table_set-update', ['table_set' => $table_set]) : route('backend.table_set-store') }}"
    enctype="multipart/form-data">
    <div class="row">

        @include('error')

        <div class="col-xl-6 mx-auto">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ (isset($table_set) ? 'Update' : 'Create') . ' table_set' }}
                        </h6>
                        <hr>
                        @csrf

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Title *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" value="{{ isset($table_set) ? $table_set->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>

                        {{-- {{ dd($table_set->categories()->first()->id) }} --}}

                        {{-- multiple select --}}
                        <div class="col-12 mb-2 ">
                            <label class="form-label">Categories *</label>
                            <select name="categories[]" id="categories" class="form-control" multiple="multiple">
                                <option value="" disabled>Select Category</option>
                                @foreach ($writableCategories as $category)
                                    <option
                                        {{ isset($table_set) &&in_array($category->id,$table_set->categories()->pluck('category_id')->toArray())? 'selected=selected': '' }}
                                        value="{{ $category->id }}">{{ $category->title }}
                                    </option>
                                @endforeach
                            </select>

                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded mb-2">
                            <h6 class="mb-0 text-uppercase">Action</h6>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ isset($table_set) ? 'Update' : 'Save' }}
                            </button>
                            <a href="{{ route('backend.table_set-view') }}" class="btn btn-danger btn-block">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded mb-2">
                        <div class="d-flex justify-content-between mb-2" style="align-items: baseline">
                            <h6 class="mb-0 text-uppercase">Tabel Sets List</h6>
                            <button class="btn btn-success btn-sm" type="button" id="add-row">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <hr>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="50%">Field Title</th>

                                    <th scope="col" width="20%">Type</th>
                                    <th scope="col" width="20%">Searchable</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="field-container">
                                @forelse (isset($table_set) ? $table_set->tableFields : [] as $field)
                                    {{-- {{ dd($field) }} --}}
                                    <tr>
                                        <td>
                                            <input type="text" name="fields[]" class="form-control mr-2"
                                                value="{{ $field->title }}">
                                        </td>
                                        <td>
                                            <select name="field_type[]" id="" class="form-control">
                                                @foreach (config('constants.table_field_types') as $key => $type)
                                                    <option {{ $field->type == $type ? 'selected=selected' : '' }}
                                                        value="{{ $type }}">
                                                        {{ ucwords($type) }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    name="searchable[{{ $field->title }}]" value="1"
                                                    {{ $field->searchable ? 'checked=checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <input type="text" name="fields[]" class="form-control mr-2">
                                        </td>
                                        <td>
                                            <select name="field_type[]" id="" class="form-control">
                                                @foreach (config('constants.table_field_types') as $key => $type)
                                                    <option value="{{ $type }}">
                                                        {{ ucwords($type) }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="searchable[]"
                                                    value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {{-- <div class="field-container">
                            @forelse (isset($table_set) ? $table_set->fields : [] as $field)
                            @empty
                                <div class="d-flex mb-2 field-row">
                                    <input type="text" name="fields[]" class="form-control mr-2">

                                </div>
                            @endforelse
                        </div> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>
</form>


@push('scripts')
    <script>
        $(document).ready(function() {
            const select2 = $('#categories').select2({
                placeholder: 'Select Categories',
                allowClear: true,
                // tags: true,
                // templateResult: formatState,
                // templateSelection: formatState,

            });
        })

        $(document).ready(function() {
            $(document).on('click', '.btn-danger', function() {
                $(this).closest('tr').remove();
            });
        });

        $(document).on('click', '#add-row', function() {
            var row = "<tr>";
            row += "<td>";
            row += "<input type='text' name='fields[]' class='form-control mr-2'>";
            row += "</td>";
            row += "<td>";
            row += "<select name='field_type[]'  class='form-control'>";
            @foreach (config('constants.table_field_types') as $key => $type)
                row += "<option value='{{ $type }}'>";
                row += "{{ ucwords($type) }}</option>";
            @endforeach
            row += "</select>";
            row += "</td>";
            row += "<td>";
            row += "<div class='form-check form-switch'>";
            row += "<input class='form-check-input' type='checkbox'  name='searchable[]' value='1'>";
            row += "</div>";
            row += "</td>";


            row += "<td>";
            row += "<button type='button' class='btn btn-danger btn-sm'>";
            row += "<i class='bi bi-trash'></i>";
            row += "</button>";
            row += "</td>";
            row += "</tr>";
            $('.field-container').append(row);
        });
    </script>
@endpush
