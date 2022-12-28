@extends('layout.app')

@section('pageTitle',trans('Create Purchase'))
@section('pageSubTitle',trans('Create'))

@section('content')
  <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.purchase.store')}}">
                                @csrf
                                <div class="row">
                                    @if( currentUser()=='owner')
                                        <div class="col-md-2 mt-2">
                                            <label for="branch_id" class="float-end" ><h6>Branches Name</h6></label>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <select required onchange="change_data(this.value)" class="form-control form-select" name="branch_id" id="branch_id">
                                                <option value="">Select Branches</option>    
                                            @forelse($branches as $b)
                                                    <option value="{{ $b->id }}" {{old('branch_id')==$b->id?'selected':''}}>{{ $b->name }}</option>
                                                @empty
                                                    <option value="">No branch found</option>
                                                @endforelse          
                                            </select>      
                                        </div>
                                        @if($errors->has('branch_id'))
                                            <span class="text-danger"> {{ $errors->first('branch_id') }}</span>
                                        @endif
                                        
                                    @else
                                        <input type="hidden" value="{{ branch()['branch_id']}}" name="branch_id">
                                    @endif
                                    
                                        
                                    <div class="col-md-2 mt-2">
                                        <label for="supplierName" class="float-end"><h6>Supplier</h6></label>
                                    </div>
                                    <div class="col-md-4">
                                        
                                        <select required class="form-control form-select" name="supplierName" id="supplierName">
                                            <option value="">Select Supplier</option>
                                            @forelse($suppliers as $d)
                                                <option class="brnch brnch{{$d->branch_id}}" value="{{$d->id}}" {{ old('supplierName')==$d->id?"selected":""}}> {{ $d->supplier_name}}</option>
                                            @empty
                                                <option value="">No Supplier found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    
                                    @if($errors->has('supplierName'))
                                    <span class="text-danger"> {{ $errors->first('supplierName') }}</span>
                                    @endif


                                    <div class="col-md-2 mt-2">
                                        <label for="warehouse_id" class="float-end"><h6>Warehouse</h6></label>
                                    </div>
                                    <div class="col-md-4">
                                        <select required class="form-control form-select" name="warehouse_id" id="warehouse_id">
                                            <option value="">Select Warehouse</option>
                                            @forelse($Warehouses as $d)
                                                <option class="brnch brnch{{$d->branch_id}}" value="{{$d->id}}" {{ old('warehouse_id')==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No Warehouse found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    
                                    @if($errors->has('warehouse_id'))
                                        <span class="text-danger"> {{ $errors->first('warehouse_id') }}</span>
                                    @endif 
                                    

                                    <div class="col-md-2 mt-2">
                                        <label for="date" class="float-end"><h6>Date</h6></label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" id="purchase_date" class="form-control" value="{{ old('purchase_date')}}" name="purchase_date">
                                    </div>


                                    <div class="col-md-2 mt-2">
                                        <label for="reference_no" class="float-end"><h6>Reference Number</h6></label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ old('reference_no')}}" name="reference_no">
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <div class="col-8 offset-2">
                                        <input type="text" name="" id="item_search" class="form-control  ui-autocomplete-input" placeholder="Search Product">
                                    </div>
                                </div>
                                <table class="table mb-5">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th class="p-2">Product Name</th>
                                            <th class="p-2">Quantity</th>
                                            <th class="p-2">Purchase Price</th>
                                            <th class="p-2">Tax %</th>
                                            <th class="p-2">Discount Type</th>
                                            <th class="p-2">Discount</th>
                                            <th class="p-2">Unit Cost</th>
                                            <th class="p-2">Total Amount</th>
                                            <th class="p-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details_data">

                                    </tbody>
                                </table>


                                <div class="row mb-5">
                                    <div class="col-12 col-sm-6">
                                        <div class="row">
                                            <div class="col-4 offset-2 mt-2 text-end pe-3">
                                                <label for="" class="form-group"><h6>Total Quantities</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2">
                                                <label for="" class="form-group"><h6 class="total_qty">0</h6></label>
                                                <input type="hidden" name="total_qty" class="total_qty_p">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 offset-2 mt-2 text-end pe-3">
                                                <label for="" class="form-group"><h6>Other Charges</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2">
                                                <input type="text" class="form-control form-group" id="other_charge" name="other_charge" onkeyup="check_change()">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 offset-2 mt-2 text-end pe-3">
                                                <label for="" class="form-group"><h6>Discount on</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2">
                                                <input type="text" class="form-control form-group" id="discount_all" name="discount_all" onkeyup="check_change()">
                                            </div>
                                            <div class="col-2 mt-2">
                                                <select onchange="check_change()" class="form-control" id="discount_all_type" name="discount_all_type">
                                                    <option value="0">%</option>
                                                    <option value="1">Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 offset-2 mt-2 text-end pe-3">
                                                <label for="" class="form-group"><h6>Note</h6></label> 
                                            </div>
                                            <div class="col-6 mt-2">
                                                <textarea class="form-control" name="note" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="row">
                                            <div class="col-4 offset-4 mt-2 pe-2 text-end">
                                                <label for="" class="form-group"><h6>Subtotal</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2 pe-5 text-end">
                                                <label for="" class="form-group"><h6 class="tsubtotal">0.00</h6></label>
                                                <input type="hidden" name="tsubtotal" class="tsubtotal_p">
                                            </div>
                                        </div>    
                                        <div class="row">
                                            <div class="col-4 offset-4 mt-2 pe-2 text-end">
                                                <label for="" class="form-group"><h6>Other Charges</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2 pe-5 text-end">
                                                <label for="" class="form-group"><h6 class="tother_charge">0.00</h6></label>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-4 offset-4 mt-2 pe-2 text-end">
                                                <label for="" class="form-group"><h6>Discount on All</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2 pe-5 text-end">
                                                <label for="" class="form-group"><h6 class="tdiscount">0.00</h6></label>
                                                <input type="hidden" name="tdiscount" class="tdiscount_p">
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-4 offset-4 mt-2 pe-2 text-end">
                                                <label for="" class="form-group"><h6>Round Of</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2 pe-5 text-end">
                                                <label for="" class="form-group"><h6 class="troundof">0.00</h6></label>
                                                <input type="hidden" name="troundof" class="troundof_p">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 offset-4 mt-2 pe-2 text-end">
                                                <label for="" class="form-group"><h6>Grand Total</h6></label> 
                                            </div>
                                            <div class="col-4 mt-2 pe-5 text-end">
                                                <label for="" class="form-group"><h6 class="tgrandtotal">0.00</h6></label>
                                                <input type="hidden" name="tgrandtotal" class="tgrandtotal_p">
                                            </div>
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

@push('scripts')
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
    function change_data(e){
        $('.brnch').hide();
        $('.brnch'+e).show();
    }

</script>

<script>
$(function() {
    $("#item_search").bind("paste", function(e){
        $("#item_search").autocomplete('search');
    } );
    $("#item_search").autocomplete({
        source: function(data, cb){
            
            $.ajax({
            autoFocus:true,
                url: "{{route(currentUser().'.pur.product_search')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    name: data.term
                },
                success: function(res){
                console.log(res);
                    var result;
                    result = [{label: 'No Records Found ',value: ''}];
                    if (res.length) {
                        result = $.map(res, function(el){
                            return {
                                label: el.value +'--'+ el.label,
                                value: '',
                                id: el.id,
                                item_name: el.value
                            };
                        });
                    }

                    cb(result);
                },error: function(e){
                    console.log("error "+e);
                }
            });
        },

            response:function(e,ui){
            if(ui.content.length==1){
                $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                $(this).autocomplete("close");
            }
            //console.log(ui.content[0].id);
            },

            //loader start
            search: function (e, ui) {
            },
            select: function (e, ui) { 
                if(typeof ui.content!='undefined'){
                console.log("Autoselected first");
                if(isNaN(ui.content[0].id)){
                    return;
                }
                var item_id=ui.content[0].id;
                }
                else{
                console.log("manual Selected");
                var item_id=ui.item.id;
                }

                return_row_with_data(item_id);
                $("#item_search").val('');
            },   
            //loader end
    });


});

function return_row_with_data(item_id){
  $("#item_search").addClass('ui-autocomplete-loader-center');
    $.ajax({
            autoFocus:true,
                url: "{{route(currentUser().'.pur.product_search_data')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    item_id: item_id
                },
                success: function(res){
                    $('#details_data').append(res);
                    $("#item_search").val('');
                    $("#item_search").removeClass('ui-autocomplete-loader-center');
                },error: function(e){
                    console.log("error "+e);
                }
            });
	
}
//INCREMENT ITEM
function removerow(e){
  $(e).parents('tr').remove();
}

//CALCUALATED SALES PRICE
function get_cal(e){
  var purchase_price = (isNaN(parseFloat($(e).parents('tr').find('.price').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.price').val().trim()); 
  var qty = (isNaN(parseFloat($(e).parents('tr').find('.qty').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.qty').val().trim()); 
  var tax = (isNaN(parseFloat($(e).parents('tr').find('.tax').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.tax').val().trim()); 
  var discount_type = parseFloat($(e).parents('tr').find('.discount_type').val().trim()); 
  var discount = (isNaN(parseFloat($(e).parents('tr').find('.discount').val().trim()))) ? 0 :parseFloat($(e).parents('tr').find('.discount').val().trim()); 
  
  if(discount_type=="0")
    discount=(purchase_price*(discount/100));

    tax=((purchase_price ) *(tax/100));

    $(e).parents('tr').find('.discount_cal').val(discount)
    $(e).parents('tr').find('.tax_cal').val(tax)

  var unit_cost = ((purchase_price + tax));
  var subtotal = ((unit_cost * qty) - discount);

  $(e).parents('tr').find('.unit_cost').val(unit_cost);
  $(e).parents('tr').find('.subtotal').val(subtotal);
  total_calculate();
}
//END
//CALCULATE PROFIT MARGIN PERCENTAGE
function total_calculate(){
    var totalqty = 0;
    $('.qty').each(function(e){
        totalqty += parseFloat($(this).val());
    });
    
    var subtotal = 0;
    $('.subtotal').each(function(e){
        subtotal += parseFloat($(this).val());
    });

    $(".total_qty").text(totalqty);
    $(".total_qty_p").val(totalqty);

    $(".tsubtotal").text(subtotal);
    $(".tsubtotal_p").val(subtotal);
    
    check_change();
}
//END

function check_change(){
    var other_charge=(isNaN(parseFloat($('#other_charge').val().trim()))) ? 0 :parseFloat($('#other_charge').val().trim());
    var discount_all=(isNaN(parseFloat($('#discount_all').val().trim()))) ? 0 :parseFloat($('#discount_all').val().trim());$('#discount_all').val();
    var discount_all_type=$('#discount_all_type').val();
    var tsubtotal=$(".tsubtotal_p").val();

    if(discount_all_type=="0")
        discount_all=(tsubtotal*(discount_all/100));
    
    $(".tdiscount").text(discount_all.toFixed(2));
    $(".tdiscount_p").val(discount_all.toFixed(2));
    $(".tother_charge").text(other_charge.toFixed(2));

    cal_grandtotl()
}

function cal_grandtotl(){
    var tsubtotal_p=(isNaN(parseFloat($('.tsubtotal_p').val().trim()))) ? 0 :parseFloat($('.tsubtotal_p').val().trim());
    var other_charge=(isNaN(parseFloat($('#other_charge').val().trim()))) ? 0 :parseFloat($('#other_charge').val().trim());
    var tdiscount_p=(isNaN(parseFloat($('.tdiscount_p').val().trim()))) ? 0 :parseFloat($('.tdiscount_p').val().trim());
    var grandtotal=((tsubtotal_p+other_charge)-tdiscount_p);
    var roundof=Math.floor(grandtotal);

        subtotal_diff=grandtotal-roundof;
         
             $(".troundof").html(parseFloat(subtotal_diff).toFixed(2)); 
             $(".troundof_p").val(parseFloat(subtotal_diff).toFixed(2)); 
             $(".tgrandtotal").html(parseFloat(roundof).toFixed(2)); 
             $(".tgrandtotal_p").val(parseFloat(roundof).toFixed(2)); 

}

</script>

@endpush
