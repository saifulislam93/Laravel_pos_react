@extends('layout.app')

@section('pageTitle',trans('Update Childcategory'))
@section('pageSubTitle',trans('Update'))

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.childcategory.update',encryptor('encrypt',$childcategory->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$childcategory->id)}}">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="subcategory">{{__('Sub Category')}}</label>
                                        <select class="form-control form-select" name="subcategory" id="subcategory">
                                            <option value="">Select Category</option>
                                            @forelse($subcategory as $sub)
                                                <option value="{{$sub->id}}" {{ old('subcategory',$childcategory->subcategory_id)==$sub->id?"selected":""}}> {{ $sub->name}}</option>
                                            @empty
                                                <option value="">No Category found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="childcat">{{__('Name')}}</label>
                                        <input type="text" id="childcat" class="form-control"
                                            placeholder="Childcategory Name" value="{{ old('childcat',$childcategory->name)}}" name="childcat">
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-start">
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