<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use App\Http\Requests\Admin\Payments\CreatePaymentRequest;
use App\Http\Requests\Admin\Payments\UpdatePaymentRequest;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->get('status')) {
	        $payments = Payment::whereNull('status')->with(['project', 'user'])->latest()->paginate(20);
        }
        elseif ($request->get('group')) {
	        $payments = Payment::select('*', DB::raw('SUM(amount) as `amount`'))
		        ->whereNull('status')
		        ->groupBy('user_id')
		        ->orderBy('amount', 'desc')
		        ->with(['project', 'user'])
		        ->paginate(20);
        }
	    else {
		    $payments = Payment::with(['project', 'user'])->latest()->paginate(20);
	    }

        $no = $payments->firstItem();

        return view('admin.payments.index', compact('payments', 'no'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

}
