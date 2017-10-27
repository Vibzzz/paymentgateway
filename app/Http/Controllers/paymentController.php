<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\paymnet;
use App\Helpers\Helper;
use App\Models\paymentModel;


/**
    payment controller class to handel 
    all payment related routing
    
**/


class paymentController extends BaseController
{
    /**
        method to process payment data and send to model to insert in db 
        return to checkout view to send to form data to payu
    **/
    public function userPaymentDetails(Request $request)
    {
        // get headers and  params from request data
        $headers                = $request->header();
        $param                  = $request->all();
        $helperObj              = new Helper();
        $txnid                  = $helperObj->getRandomString();
        $param['txnid']         = $txnid;
        $requestParam           = array_merge($param,config('customConfig'));

        // generating hash by method which is provied by payu
        $hash                   = $helperObj->generateHash($requestParam);
        $requestParam['hash']   = $hash;
        // $requestParam['bankcode']   = "CC";
        $paymentModelObj        = new paymentModel();
        
        $paymnetResponse        = $paymentModelObj->processUserPaymentDetails($requestParam,$headers);

        // redirect to checkout view with all required data to send payu gateway
        return view('checkout', ['url' => 'https://test.payu.in/_payment','param' => $requestParam]);
        
    }

    /**
        if payu send success response then update status for txn id
    **/

    public function userPaymentSuccess(Request $request)
    {
        // get headers and  params from request data
        $headers                = $request->header();
        $param                  = $request->all();
        $paymentModelObj        = new paymentModel();
        
        // send data to model to update current status of transaction 
        $paymnetResponse        = $paymentModelObj->updateStatus($param,array("status"=>"success"),$headers);
        
        // redirect to sucess view if payu sends success response
        return view('success'); 
    }

    /**
        if payu send fail response then update status for txn id
    **/
    public function userPaymentFail(Request $request)
    {
        // get headers and  params from request data
        $headers                = $request->header();
        $param                  = $request->all();
        $paymentModelObj         = new paymentModel();
        
         // send data to model to update current status of transaction 
        $paymnetResponse         = $paymentModelObj->updateStatus($param,array("status"=>"failure"),$headers);
        
        // redirect to failue view if payu sends failure response
        return view('failure'); 
    }
    /**
        if payu send cancel response then update status for txn id
    **/
    public function userPaymentCancel(Request $request)
    {
        // get headers and  params from request data
        $headers                = $request->header();
        $param                  = $request->all();
        $paymentModelObj        = new paymentModel();
        
        // send data to model to update current status of transaction
        $paymnetResponse        = $paymentModelObj->updateStatus($param,array("status"=>"failure"),$headers);
        
        // redirect to failure view if payu sends failure response
        return view('failure');  
    }
}
