<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;


use App\Models\Purchases\Purchase;
use App\Models\Sales\Sales_details;
use App\Models\Sales\Sales;
use App\Models\Suppliers\Supplier;
use App\Models\Customers\customer;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
 
    /**
     * Purchase Report
     */
    public function preport(Request $request)
    {
        $data= Purchase::where(company());

        if($request->fdate){
            $tdate=$request->tdate?$request->tdate:$request->fdate;
            $data=$data->whereBetween('purchase_date',[$request->fdate,$tdate]);
        }

        if($request->sup){
            $data=$data->where('supplier_id',$request->sup);
        }

        $suppliers = Supplier::where(company())->get();
        $data= $data->paginate(10);
        return view('reports.pview',compact('data','suppliers'));
    }

    public function stockreport()
    {
        $stock= DB::select("SELECT products.product_name,stocks.*,sum(stocks.quantity) as qty, AVG(stocks.unit_price) as avunitprice FROM `stocks` join products on products.id=stocks.product_id GROUP BY stocks.product_id");
        return view('reports.sview',compact('stock'));
    }

   

    public function salesReport(Request $request)
    {
        

        $data = Sales::where(company());

        if($request->fdate){
            $tdate=$request->tdate?$request->tdate:$request->fdate;
            $data=$data->whereBetween('sales_date',[$request->fdate,$tdate]);
        }

        if($request->cus){
            $data=$data->where('customer_id',$request->cus);
        }
        $customers = customer::where(company())->get();
        $data= $data->paginate(10);
        //$sales = Sales_details::all();
        return view('reports.salesview',compact('data','customers'));
    }
}