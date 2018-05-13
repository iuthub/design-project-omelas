@extends('user.layouts.app')
@section('main-content')
<br>
   <div class="small-6 small-centered columns">
       <h3>Shipping Info</h3>

       {!! Form::open(['route' => 'address.store', 'method' => 'post']) !!}

       <div class="form-group">
         <div class="col-md-6 mb-3">
           {{ Form::label('addressline', 'Address Line') }}
           {{ Form::text('addressline', null, array('class' => 'form-control' )) }}
           <div class="invalid-feedback">
                  Valid first addressline is required.
                </div>
         </div>
       </div>

       <div class="form-group">
         <div class="col-md-6 mb-3">
           {{ Form::label('city', 'City') }}
           {{ Form::text('city', null, array('class' => 'form-control')) }}
         </div>
       </div>
       <div class="form-group">
         <div class="col-md-6 mb-3">
           {{ Form::label('state', 'State') }}
           {{ Form::text('state', null, array('class' => 'form-control')) }}
         </div>
       </div>
       <div class="form-group">
<div class="col-md-6 mb-3">
           {{ Form::label('zip', 'Zip') }}
           {{ Form::text('zip', null, array('class' => 'form-control')) }}
         </div>
       </div>
       <div class="form-group">
         <div class="col-md-6 mb-3">
           {{ Form::label('country', 'Country') }}
           {{ Form::text('country', null, array('class' => 'form-control')) }}
         </div>
       </div>
       <div class="form-group">
         <div class="col-md-6 mb-3">
           {{ Form::label('phone', 'Phone') }}
           {{ Form::text('phone', null, array('class' => 'form-control')) }}
         </div>
       </div>
        <div class="col-md-12 mb-6">
       {{ Form::submit('Proceed to Payment', array('class' => 'button success')) }}
       {!! Form::close() !!}
            </div>
   </div>


</div>



@endsection
