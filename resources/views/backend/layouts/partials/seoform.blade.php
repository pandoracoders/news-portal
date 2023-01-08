<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded mb-2">
                    <h6 class="mb-0 text-uppercase">Meta Data</h6>
                    <hr>
                    <div class="col-12">
                        <label class="form-label">Meta Title</label>
                        <input data-validation="required"  type="text"
                            class="form-control {{ isset($errors) && $errors->has('meta_title') ? 'is-invalid' : '' }}"
                            name="meta_title"
                            value="{{ old('meta_title') ? old('meta_title') :  (isset($meta) ? $meta->meta_title : '' ) }}">
                        @if (isset($errors) && $errors->has('meta_title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('meta_title') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label">Meta Description</label>
                        <textarea data-validation="required" class="form-control {{ isset($errors) && $errors->has('meta_description') ? 'is-invalid' : '' }}"
                            name="meta_description">{{ old('meta_description') ? old('meta_description') :  (isset($meta) ? $meta->meta_description : '' ) }}</textarea>
                        @if (isset($errors) && $errors->has('meta_description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('meta_description') }}
                            </div>
                        @endif
                    </div>
                    {{-- {{ $meta->meta_keywords }} --}}
                    <div class="col-12 mt-2">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text"
                            class="form-control {{ isset($errors) && $errors->has('meta_keywords') ? 'is-invalid' : '' }}"
                            data-role="tagsinput" name="meta_keywords" value="{{ old('meta_keywords') ? old('meta_keywords') :  (isset($meta) ? $meta->meta_keywords : '' ) }}" >

                        @if (isset($errors) && $errors->has('meta_keywords'))
                            <div class="invalid-feedback">
                                {{ $errors->first('meta_keywords') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
