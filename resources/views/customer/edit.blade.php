@extends('layout.app')

@section('pageTitle',trans('Update Customer'))
@section('pageSubTitle',trans('Update'))

@section('content')
  <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.customer.update',encryptor('encrypt',$customer->id))}}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$customer->id)}}">
                                <div class="row">

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="customerName">{{__('Customer Name')}}</label>
                                            <input type="text" id="customerName" class="form-control" value="{{ old('customerName',$customer->customer_name)}}" name="customerName">
                                            @if($errors->has('customerName'))
                                            <span class="text-danger"> {{ $errors->first('customerName') }}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="contact">{{__('Contact')}}</label>
                                            <input type="text" id="contact" class="form-control" value="{{ old('contact',$customer->contact)}}" name="contact">
                                            @if($errors->has('contact'))
                                            <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="email">{{__('Email')}}</label>
                                            <input type="text" id="email" class="form-control" value="{{ old('email',$customer->email)}}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="phone">{{__('Phone')}}</label>
                                            <input type="text" id="phone" class="form-control" value="{{ old('phone',$customer->phone)}}" name="phone">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="taxNumber">{{__('TAX Number')}}</label>
                                            <input type="text" id="taxNumber" class="form-control" value="{{ old('taxNumber',$customer->tax_number)}}" name="taxNumber">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="gstNumber">{{__('GST Number')}}</label>
                                            <input type="text" id="gstNumber" class="form-control" value="{{ old('gstNumber',$customer->gst_number)}}" name="gstNumber">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="openingAmount">{{__('Opening Balance')}}</label>
                                            <input type="text" id="openingAmount" class="form-control" value="{{ old('openingAmount',$customer->opening_balance)}}" name="openingAmount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="countryName">{{__('Country')}}</label>
                                            <select onchange="show_division(this.value)" class="form-control form-select" name="countryName" id="countryName">
                                                <option value="">Select Country</option>
                                                @forelse($countries as $d)
                                                    <option value="{{$d->id}}" {{ old('countryName',$customer->country_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                                @empty
                                                    <option value="">No Country found</option>
                                                @endforelse
                                            </select>
                                            @if($errors->has('countryName'))
                                            <span class="text-danger"> {{ $errors->first('countryName') }}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="divisionName">{{__('Division')}}</label>
                                            <select onchange="show_district(this.value)" class="form-control form-select" name="divisionName" id="divisionName">
                                                <option value="">Select Division</option>
                                                @forelse($divisions as $d)
                                                    <option class="div div{{$d->country_id}}" value="{{$d->id}}" {{ old('divisionName',$customer->division_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                                @empty
                                                    <option value="">No division found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="districtName">{{__('District')}}</label>
                                            <select class="form-control form-select" name="districtName" id="districtName">
                                                <option value="">Select District</option>
                                                @forelse($districts as $d)
                                                    <option class="dist dist{{$d->division_id}}" value="{{$d->id}}" {{ old('districtName',$customer->district_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                                @empty
                                                    <option value="">No district found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="postCode">{{__('Post Code')}}</label>
                                            <input type="text" id="postCode" class="form-control" value="{{ old('postCode',$customer->post_code)}}" name="postCode">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">{{__('Address')}}</label>
                                            <textarea class="form-control" name="address" id="address" rows="2">{{ old('address',$customer->address)}}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">{{__('Save')}}</button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>
@endsection

@push('scripts')
<script>
    /* call on load page */
    $(document).ready(function(){
        $('.div').hide();
        $('.dist').hide();
    })

    function show_division(e){
         $('.div').hide();
         $('.div'+e).show()
    }
    function show_district(e){
        $('.dist').hide();
        $('.dist'+e).show();
    }

    
   
    
</script>
@endpush