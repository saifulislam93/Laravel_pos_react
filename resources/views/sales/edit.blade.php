@extends('layout.app')

@section('pageTitle',trans('Update Supplier'))
@section('pageSubTitle',trans('Update'))

@section('content')
  <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.supplier.update',encryptor('encrypt',$supplier->id))}}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$supplier->id)}}">
                                <div class="row">

                                        @if( currentUser()=='owner')
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="branch_id">Branches Name</label>
                                                    <select class="form-control" name="branch_id" id="branch_id">
                                                        @forelse($branches as $b)
                                                            <option value="{{ $b->id }}" {{old('branch_id',$supplier->branch_id)==$b->id?'selected':''}}>{{ $b->name }}</option>
                                                        @empty
                                                            <option value="">No branch found</option>
                                                        @endforelse
                                                    </select>
                                                    @if($errors->has('supplierName'))
                                                    <span class="text-danger"> {{ $errors->first('supplierName') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" value="{{ branch()['branch_id']}}" name="branch_id">
                                        @endif

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="supplierName">Supplier Name</label>
                                            <input type="text" id="supplierName" class="form-control" value="{{ old('supplierName',$supplier->supplier_name)}}" name="supplierName">
                                            @if($errors->has('supplierName'))
                                            <span class="text-danger"> {{ $errors->first('supplierName') }}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="contact">Contact</label>
                                            <input type="text" id="contact" class="form-control" value="{{ old('contact',$supplier->contact)}}" name="contact">
                                            @if($errors->has('contact'))
                                            <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" class="form-control" value="{{ old('email',$supplier->email)}}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" id="phone" class="form-control" value="{{ old('phone',$supplier->phone)}}" name="phone">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="taxNumber">TAX Number</label>
                                            <input type="text" id="taxNumber" class="form-control" value="{{ old('taxNumber',$supplier->tax_number)}}" name="taxNumber">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="gstNumber">GST Number</label>
                                            <input type="text" id="gstNumber" class="form-control" value="{{ old('gstNumber',$supplier->gst_number)}}" name="gstNumber">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="openingAmount">Opening Balance</label>
                                            <input type="text" id="openingAmount" class="form-control" value="{{ old('openingAmount',$supplier->opening_balance)}}" name="openingAmount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="countryName">Country</label>
                                            <select class="form-control" name="countryName" id="countryName">
                                                <option value="">Select Country</option>
                                                @forelse($countries as $d)
                                                    <option value="{{$d->id}}" {{ old('countryName',$supplier->country_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                                @empty
                                                    <option value="">No Category found</option>
                                                @endforelse
                                            </select>
                                            @if($errors->has('countryName'))
                                            <span class="text-danger"> {{ $errors->first('countryName') }}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="divisionName">Division</label>
                                            <select class="form-control" name="divisionName" id="divisionName">
                                                <option value="">Select Country</option>
                                                @forelse($divisions as $d)
                                                    <option value="{{$d->id}}" {{ old('divisionName',$supplier->division_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                                @empty
                                                    <option value="">No Category found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="districtName">Division</label>
                                            <select class="form-control" name="districtName" id="districtName">
                                                <option value="">Select Country</option>
                                                @forelse($districts as $d)
                                                    <option value="{{$d->id}}" {{ old('districtName',$supplier->district_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                                @empty
                                                    <option value="">No Category found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="postCode">Post Code</label>
                                            <input type="text" id="postCode" class="form-control" value="{{ old('postCode',$supplier->post_code)}}" name="postCode">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" id="address" rows="2">{{ old('address',$supplier->address)}}</textarea>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                        
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
