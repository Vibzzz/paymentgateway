<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\paymnet;
use App\Helpers\Helper;
use App\Models\paymentModel;

class paymentController extends BaseController
{
    /**
        method to process payment data and send to model to insert in db 
        return to checkout view to send to form data to payu
    **/
    public function userPaymentDetails(Request $request)
    {
        $headers                = $request->header();
        $param                  = $request->all();
        $helperObj              = new Helper();
        $txnid                  = $helperObj->getRandomString();
        $param['txnid']         = $txnid;
        $requestParam           = array_merge($param,config('customConfig'));

        $hash                   = $helperObj->generateHash($requestParam);
        $requestParam['hash']   = $hash;
        // $requestParam['bankcode']   = "CC";
        $paymentModelObj         = new paymentModel();
        
        $paymnetResponse         = $paymentModelObj->processUserPaymentDetails($requestParam,$headers);

        return view('checkout', ['url' => 'https://test.payu.in/_payment','param' => $requestParam]);
        
    }

    /**
        if payu send success response then update status for txn id
    **/

    public function userPaymentSuccess(Request $request)
    {
        $headers                = $request->header();
        $param                  = $request->all();
        $paymentModelObj         = new paymentModel();
        
        $paymnetResponse         = $paymentModelObj->updateStatus($param,array("status"=>"success"),$headers);
        return view('success'); 
    }

    /**
        if payu send fail response then update status for txn id
    **/
    public function userPaymentFail(Request $request)
    {
        $headers                = $request->header();
        $param                  = $request->all();
        $paymentModelObj         = new paymentModel();
        
        $paymnetResponse         = $paymentModelObj->updateStatus($param,array("status"=>"failure"),$headers);
        return view('failure'); 
    }
    /**
        if payu send cancel response then update status for txn id
    **/
    public function userPaymentCancel(Request $request)
    {
        $headers                = $request->header();
        $param                  = $request->all();
        $paymentModelObj         = new paymentModel();
        
        $paymnetResponse         = $paymentModelObj->updateStatus($param,array("status"=>"failure"),$headers);
        return view('failure');  
    }
}
