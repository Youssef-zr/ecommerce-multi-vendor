 <!-- name field -->
 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
     {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
     {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
     @if ($errors->any())
         <code>{{ $errors->first('name') }}</code>
     @endif
 </div>

 <div class="row">
     <!-- code field -->
     <div class="col-md-3">
         <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
             {!! Form::label('code', 'Code *', ['class' => 'form-label']) !!}
             {!! Form::text('code', old('code'), ['class' => 'form-control', 'required' => 'required']) !!}
             @if ($errors->any())
                 <code>{{ $errors->first('code') }}</code>
             @endif
         </div>
     </div>

     <!-- quantity field -->
     <div class="col-md-3">
         <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
             {!! Form::label('quantity', 'Quantity *', ['class' => 'form-label']) !!}
             {!! Form::number('quantity', old('quantity'), ['class' => 'form-control', 'required' => 'required']) !!}
             @if ($errors->any())
                 <code>{{ $errors->first('quantity') }}</code>
             @endif
         </div>
     </div>

     <!-- max use field -->
     <div class="col-md-3">
         <div class="form-group{{ $errors->has('max_use') ? ' has-error' : '' }}">
             {!! Form::label('max_use', 'Max Use *', ['class' => 'form-label']) !!}
             {!! Form::number('max_use', old('max_use'), ['class' => 'form-control', 'required' => 'required']) !!}
             @if ($errors->any())
                 <code>{{ $errors->first('max_use') }}</code>
             @endif
         </div>
     </div>

     <!-- total used field -->
     <div class="col-md-3">
         <div class="form-group{{ $errors->has('total_used') ? ' has-error' : '' }}">
             {!! Form::label('total_used', 'Total Used *', ['class' => 'form-label']) !!}
             {!! Form::number('total_used', old('total_used'), [
                 'class' => 'form-control',
                 'required' => 'required',
             ]) !!}

             @if ($errors->any())
                 <code>{{ $errors->first('total_used') }}</code>
             @endif
         </div>
     </div>

 </div>


 <div class="row">
     <!-- start date field -->
     <div class="col-md-6">
         <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
             {!! Form::label('start_date', 'Start Date *', ['class' => 'form-label']) !!}
             {!! Form::text('start_date', old('start_date'), [
                 'class' => 'form-control datepicker',
                 'required' => 'required',
             ]) !!}
             @if ($errors->any())
                 <code>{{ $errors->first('start_date') }}</code>
             @endif
         </div>
     </div>

     <!-- end date field -->
     <div class="col-md-6">
         <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
             {!! Form::label('end_date', 'End Date *', ['class' => 'form-label']) !!}
             {!! Form::text('end_date', old('end_date'), ['class' => 'form-control datepicker', 'required' => 'required']) !!}
             @if ($errors->any())
                 <code>{{ $errors->first('end_date') }}</code>
             @endif
         </div>
     </div>
 </div>

 <div class="row">
     <!-- discount type field -->
     <div class="col-md-6">
         <div class="form-group{{ $errors->has('discount_type') ? ' has-error' : '' }}">
             {!! Form::label('discount_type', 'Discount Type *', ['class' => 'form-label']) !!}
             {!! Form::select(
                 'discount_type',
                 [
                     'percent' => 'percentage (%)',
                     'amount' => 'Amount (' . $setting->currency_name . ')',
                 ],
                 old('discount_type'),
                 ['class' => 'form-control', 'required' => 'required'],
             ) !!}

             @if ($errors->any())
                 <code>{{ $errors->first('discount_type') }}</code>
             @endif
         </div>

     </div>

     <!-- discount field -->
     <div class="col-md-6">
         <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
             {!! Form::label('discount', 'Discount *', ['class' => 'form-label']) !!}
             {!! Form::number('discount', old('discount'), [
                 'class' => 'form-control',
                 'required' => 'required',
                 'step' => '.1',
             ]) !!}

             @if ($errors->any())
                 <code>{{ $errors->first('discount') }}</code>
             @endif
         </div>
     </div>
 </div>

 <!-- Status field -->
 <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
     {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
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
