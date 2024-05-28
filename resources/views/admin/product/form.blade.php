@php
    $categories = App\Models\Backend\Category::whereStatus('active')->plucK('name', 'id')->toArray();
    $brands = App\Models\Backend\Brand::whereStatus('active')->plucK('name', 'id')->toArray();
@endphp


<!-- image field -->
@if (isset($product))
    <div class="form-group mb-3">
        <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" style="width: 120px" class="img-thumbnail">
    </div>
@endif

<div class="form-group{{ $errors->has('thumb_image') ? ' has-error' : '' }}">
    {!! Form::label('thumb_image', 'Image', ['class' => 'form-label']) !!}
    {!! Form::file('thumb_image', ['class' => 'w-100']) !!}
    @if ($errors->any())
        <code>{{ $errors->first('thumb_image') }}</code>
    @endif
</div>

<!-- name field -->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name'), [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Product name',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('name') }}</code>
    @endif
</div>

<!-- category -->
<div class="row">

    <!-- main category field -->
    <div class="col-md-4">
        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            {!! Form::label('category_id', 'Select Category *', ['class' => 'form-label']) !!}
            {!! Form::select('category_id', $categories, old('category_id'), [
                'id' => 'category_id',
                'class' => 'd-block w-100 select2 main-category',
                'required' => 'required',
            ]) !!}

            @if ($errors->any())
                <code>{{ $errors->first('category_id') }}</code>
            @endif
        </div>
    </div>

    <!-- sub category field -->
    <div class="col-md-4">
        @php
            $subCategories = [];

            if (isset($product) and $product->mainCategory != null) {
                $subCategories = $product->mainCategory->subCategories->pluck('name', 'id')->toArray();
            }
        @endphp
        <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
            {!! Form::label('sub_category_id', 'Select Sub Category', ['class' => 'form-label']) !!}
            {!! Form::select('sub_category_id', $subCategories, old('sub_category_id'), [
                'id' => 'sub_category_id',
                'class' => 'd-block w-100 select2 sub-category',
            ]) !!}

            @if ($errors->any())
                <code>{{ $errors->first('sub_category_id') }}</code>
            @endif
        </div>
    </div>

    <!-- child category field -->
    <div class="col-md-4">
        @php
            $childCategories = [];

            if (isset($product) and $product->subCategory) {
                $childCategories = $product->subCategory->childCategories->pluck('name', 'id')->toArray();
            }
        @endphp
        <div class="form-group{{ $errors->has('child_category_id') ? ' has-error' : '' }}">
            {!! Form::label('child_category_id', 'Select Child Category', ['class' => 'form-label']) !!}
            {!! Form::select('child_category_id', $childCategories, old('child_category_id'), [
                'id' => 'child_category_id',
                'class' => 'd-block w-100 select2',
            ]) !!}

            @if ($errors->any())
                <code>{{ $errors->first('child_category_id') }}</code>
            @endif
        </div>
    </div>
</div>

<!-- Brands field -->
<div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
    {!! Form::label('brand_id', 'Brand', ['class' => 'form-label']) !!}
    {!! Form::select('brand_id', $brands, old('brand_id'), [
        'id' => 'brand_id',
        'class' => 'd-block w-100 select2',
    ]) !!}

    @if ($errors->any())
        <code>{{ $errors->first('brand_id') }}</code>
    @endif
</div>

<!-- sku field -->
<div class="form-group{{ $errors->has('sku') ? ' has-error' : '' }}">
    {!! Form::label('sku', 'SKU', ['class' => 'form-label']) !!}
    {!! Form::text('sku', old('sku'), [
        'class' => 'form-control',
        'placeholder' => 'Product SKU Ex : BLK-TSHIRT-M-MAN1',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('sku') }}</code>
    @endif
</div>

<!-- price fields -->
<div class="row">
    <!-- price field -->
    <div class="col-12 col-md-6">
        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            {!! Form::label('price', 'Price *', ['class' => 'form-label']) !!}
            {!! Form::number('price', old('price'), [
                'class' => 'form-control',
                'required' => 'required',
                'step' => '.1',
                'min' => '0',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('price') }}</code>
            @endif
        </div>
    </div>

    <!-- offer_price field -->
    <div class="col-12 col-md-6">
        <div class="form-group{{ $errors->has('offer_price') ? ' has-error' : '' }}">
            {!! Form::label('offer_price', 'Offer price', ['class' => 'form-label']) !!}
            {!! Form::number('offer_price', old('offer_price'), [
                'class' => 'form-control',
                'step' => '.1',
                'min' => '0',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('offer_price') }}</code>
            @endif
        </div>
    </div>
</div>

<!-- date offer fields -->
<div class="row">
    <!-- offer start date field -->
    <div class="col-12 col-md-6">
        <div class="form-group{{ $errors->has('offer_start_date') ? ' has-error' : '' }}">
            {!! Form::label('offer_start_date', 'Offer start date', ['class' => 'form-label']) !!}
            {!! Form::text('offer_start_date', old('offer_start_date'), [
                'class' => 'form-control datepicker',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('offer_start_date') }}</code>
            @endif
        </div>
    </div>

    <!-- offer end date field -->
    <div class="col-12 col-md-6">
        <div class="form-group{{ $errors->has('offer_end_date') ? ' has-error' : '' }}">
            {!! Form::label('offer_end_date', 'Offer end date', ['class' => 'form-label']) !!}
            {!! Form::text('offer_end_date', old('offer_end_date'), [
                'class' => 'form-control datepicker',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('offer_end_date') }}</code>
            @endif
        </div>
    </div>
</div>

<!-- qty field -->
<div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
    {!! Form::label('qty', 'Stock quantity', ['class' => 'form-label']) !!}
    {!! Form::number('qty', old('qty'), [
        'class' => 'form-control',
        'min' => '0',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('qty') }}</code>
    @endif
</div>

<!-- video_link field -->
<div class="form-group{{ $errors->has('video_link') ? ' has-error' : '' }}">
    {!! Form::label('video_link', 'Video link', ['class' => 'form-label']) !!}
    {!! Form::text('video_link', old('video_link'), [
        'class' => 'form-control',
        'placeholder' => 'https://www.youtube.com/watch?v=TkuI-cxP6G4&t',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('video_link') }}</code>
    @endif
</div>

<!-- short_description field -->
<div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
    {!! Form::label('short_description', 'Short description *', ['class' => 'form-label']) !!}
    {!! Form::textarea('short_description', old('short_description'), [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Product short description',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('short_description') }}</code>
    @endif
</div>

<!-- long_description field -->
<div class="form-group{{ $errors->has('long_description') ? ' has-error' : '' }}">
    {!! Form::label('long_description', 'Long description *', ['class' => 'form-label']) !!}
    {!! Form::textarea('long_description', old('long_description'), [
        'class' => 'form-control summernote',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('long_description') }}</code>
    @endif
</div>

<!-- product type -->
<div class="form-group{{ $errors->has('product_type') ? ' has-error' : '' }}">
    {!! Form::label('product_type', 'Is Featured', ['class' => 'form-label']) !!}
    {!! Form::select(
        'product_type',
        [
            'undefined' => 'Undefined',
            'best' => 'Best',
            'new_arrival' => 'New Arrival',
            'feature' => 'Feature',
            'top' => 'Top',
            'flash_deal' => 'Flash Deal',
        ],
        old('product_type'),
        [
            'id' => 'product_type',
            'class' => 'd-block w-100 select2',
            'required' => 'required',
        ],
    ) !!}

    @if ($errors->any())
        <code>{{ $errors->first('is_featured') }}</code>
    @endif
</div>

<!-- seo_title field -->
<div class="form-group{{ $errors->has('seo_title') ? ' has-error' : '' }}">
    {!! Form::label('seo_title', 'Seo Title', ['class' => 'form-label']) !!}
    {!! Form::textarea('seo_title', old('seo_title'), [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Product Seo Title',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('seo_title') }}</code>
    @endif
</div>

<!-- seo_description field -->
<div class="form-group{{ $errors->has('seo_description') ? ' has-error' : '' }}">
    {!! Form::label('seo_description', 'Seo description', ['class' => 'form-label']) !!}
    {!! Form::textarea('seo_description', old('seo_description'), [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Product Seo Description',
        'style' => 'min-height:120px',
    ]) !!}
    @if ($errors->any())
        <code>{{ $errors->first('seo_description') }}</code>
    @endif
</div>

<!-- status field -->
<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    {!! Form::label('status', 'Status *', ['class' => 'form-label']) !!}
    {!! Form::select(
        'status',
        [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        old('status'),
        [
            'id' => 'status',
            'class' => 'd-block w-100 select2',
            'required' => 'required',
        ],
    ) !!}

    @if ($errors->any())
        <code>{{ $errors->first('status') }}</code>
    @endif
</div>

@push('css')
    <!-- daterangepicker -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <style>
        label.form-label {
            text-transform: capitalize;
        }
    </style>
@endpush

@push('js')
    <!-- daterangepicker -->
    <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script>
        $(() => {

            const subCategoryHtml = $('#sub_category_id');
            const childCategoryHtml = $('#child_category_id');

            // get sub categories of main category
            $(".main-category").on('change', function() {
                const mainCategoryId = $(this).val();
                subCategoryHtml.html('<option value="">please select</option>');
                childCategoryHtml.html('<option value="">please select</option>');

                if (mainCategoryId != "") {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('admin.dashboard.child-category.get-subcategories') }}",
                        data: {
                            mainCategoryId,
                        },
                        success(res) {
                            const subCategories = res.data;

                            if (subCategories != '' || subCategories != undefined) {
                                subCategoryHtml.html(subCategories);
                            }
                        },
                        error(err) {
                            subCategoryHtml.html('<option value="">please select</option>');
                            childCategoryHtml.html('<option value="">please select</option>');
                        }
                    })
                }
            })

            // get child categories of sub category
            $(".sub-category").on('change', function() {
                const subCategoryId = $(this).val();
                childCategoryHtml.html('<option value="">please select</option>');

                if (subCategoryId != "") {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('admin.dashboard.child-category.get-childcategories') }}",
                        data: {
                            subCategoryId,
                        },
                        success(res) {
                            const childCategories = res.data;

                            if (childCategories != '' || childCategories != undefined) {
                                childCategoryHtml.html(childCategories);
                            }
                        },
                        error(err) {
                            childCategoryHtml.html('<option value="">please select</option>');
                        }
                    })
                }
            })

        });
    </script>
@endpush
