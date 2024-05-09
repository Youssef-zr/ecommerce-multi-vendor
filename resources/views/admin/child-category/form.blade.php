<div class="row">

    <!-- main category field -->
    <div class="col-12">
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
    @php

        $subCategories = [];

        if (isset($childCategory) and $childCategory->mainCategory != null) {
            $subCategories = $childCategory->mainCategory->subCategories->pluck('name', 'id')->toArray();
        }
    @endphp
    <div class="col-12">
        <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
            {!! Form::label('sub_category_id', 'Select Sub Category *', ['class' => 'form-label']) !!}
            {!! Form::select('sub_category_id', $subCategories, old('sub_category_id'), [
                'id' => 'sub_category_id',
                'class' => 'd-block w-100 select2',
                'required' => 'required',
            ]) !!}

            @if ($errors->any())
                <code>{{ $errors->first('sub_category_id') }}</code>
            @endif
        </div>
    </div>

    <!-- name field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('name') }}</code>
            @endif
        </div>
    </div>


    <!-- Status field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
            {!! Form::select(
                'status',
                [
                    'active' => 'active',
                    'inactive' => 'inactive',
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
    </div>
</div>


@push('js')
    <script>
        $(() => {
            $("input[name='icon']").val($("#icon").data('icon'));

            // get sub categories of main category
            $(".main-category").on('change', function() {
                const subCategoryHtml = $('#sub_category_id');
                const mainCategoryId = $(this).val();
                subCategoryHtml.html('<option value="">please select</option>');

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
                        }
                    })
                }
            })
        })
    </script>
@endpush
