<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Xendit\Xendit;

class InvoiceController extends Controller
{
    function __construct()
    {
        Xendit::setApiKey(env('API_KEY'));
    }

    public function createInv(Request $request)
    {
        $data = Validator::make($request->all(),[
            'external_id'   => 'required',
            'amount'        => 'required',
            'payer_email'   => 'required',
            'description'   => 'required',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $inv = \Xendit\Invoice::create([
            'external_id'   => $request->external_id,
            'amount'        => $request->amount,
            'payer_email'   => $request->payer_email,
            'description'   => $request->description,
        ]);

        return [
            'success'   => true,
            'message'   => 'Invoice berhasil dibuat',
            'data'      => $inv,
        ];
    }

    public function getInvoice(Request $request)
    {
       $id = $request->id;

       $inv = \Xendit\Invoice::retrieve($id);

        return [
            'success'   => true,
            'message'   => 'berhasil mendapatkan invoice',
            'data'      => $inv
        ];
    }

    public function paymentReq(Request $request)
    {
        $data = Validator::make($request->all(),[
            "external_id" => "required",
            "amount"    =>  "required",
            "bank_code" => "required",
            "account_number" => "required",
            'account_holder_name' => 'required',
            "description" => "required",
            
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $pay    = \Xendit\Disbursements::create([
            'external_id'       => $request->external_id,
            'amount'            => $request->amount,
            'account_number'    => $request->account_number,
            'account_holder_name'   => $request->account_holder_name,
            'bank_code'         => $request->bank_code,
            'description'       => $request->description,
        ]);

        return [
            'success'   => true,
            'message'   => 'Pembayaran berhasil dibuat',
            'data'      => $pay
        ];
    }

    
}
