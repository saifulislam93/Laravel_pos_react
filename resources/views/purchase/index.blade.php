@extends('layout.app')
@section('pageTitle',trans('Purchase List'))
@section('pageSubTitle',trans('List'))

@section('content')

<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                
                @if(Session::has('response'))
                    {!!Session::get('response')['message']!!}
                @endif
                <div>
                    <a class="float-end" href="{{route(currentUser().'.purchase.create')}}"style="font-size:1.7rem"><i class="bi bi-plus-square-fill"></i></a>
                </div>
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Supplier')}}</th>
                                <th scope="col">{{__('Date')}}</th>
                                <th scope="col">{{__('Reference Number')}}</th>
                                <th scope="col">{{__('Total QTY')}}</th>
                                <th scope="col">{{__('Sub Amount')}}</th>
                                <!-- <th scope="col">{{__('TAX')}}</th>
                                <th scope="col">{{__('Discount Type')}}</th>
                                <th scope="col">{{__('RoundOf')}}</th> -->
                                <th scope="col">{{__('GrandTotal')}}</th>
                                <th scope="col">{{__('Note')}}</th>
                               
                                <th scope="col">{{__('Branch')}}</th>
                                <th scope="col">{{__('Warehouse')}}</th>
                                <th scope="col">{{__('Status')}}</th>
                                <th scope="col">{{__('Payment Status')}}</th>
                                <th class="white-space-nowrap">{{__('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $pur)
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{$pur->supplier?->supplier_name}}</td>
                                <td>{{$pur->purchase_date}}</td>
                                <td>{{$pur->reference_no}}</td>
                                <td>{{$pur->total_quantity}}</td>
                                <td>{{$pur->sub_amount}}</td>
                                <!-- <td>{{$pur->tax}}</td>
                                <td>{{$pur->discount_type}}</td>
                                <td>{{$pur->round_of}}</td> -->
                                <td>{{$pur->grand_total}}</td>
                                <td>{{$pur->note}}</td>
                               
                                <td>{{$pur->branch?->name}}</td>
                                <td>{{$pur->warehouse?->name}}</td>
                                <td>{{$pur->status}}</td>
                                <td>{{$pur->payment_status}}</td>
                                <td class="white-space-nowrap">
                                    <a href="{{route(currentUser().'.purchase.edit',encryptor('encrypt',$pur->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="javascript:void()" onclick="$('#form{{$pur->id}}').submit()">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <form id="form{{$pur->id}}" action="{{route(currentUser().'.purchase.destroy',encryptor('encrypt',$pur->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="12" class="text-center">No Pruduct Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bordered table end -->


@endsection