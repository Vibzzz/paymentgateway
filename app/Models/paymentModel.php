<?php

namespace App\Models;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;


use App\paymentStatus;
use App\paymentInfo;


/**
    payment model  class to intract 
    db and process data
    
**/

class paymentModel {



      /**
        insert data in mysql db
        and if in env mongo_use is on then also log request header and request param in mongo db
      **/

      public function processUserPaymentDetails($requestParam,$headers) {

      	$paymentStatus    = new paymentStatus();
            $paymentInfo      = new paymentInfo();

            $formatedHeaders        =     $this->formatHeaders($headers);
            $requestParam           =     $this->formatRequest($requestParam);
           
            // insert initiated transaction  in db 
            $paymentStatus->txn_id        = $requestParam['txnid'];
            $paymentStatus->payment_flag  = 'initiate';
            $paymentStatus->amount        = $requestParam['amount'];
            $paymentStatus->user_id       = $requestParam['email'];

            $paymentStatus->save();

         //    DB::Insert('insert into payment_status (txn_id, payment_flag,amount,user_id) 
      	 	// values (?, ?,?,?)', [$requestParam['txnid'],'initiate' ,$requestParam['amount'],$requestParam['email']]);

      	// insert payment info  in db 
            $paymentInfo->email           = $requestParam['email'];
            $paymentInfo->first_name      = $requestParam['firstname'];
            $paymentInfo->last_name       = $requestParam['lastname'];
            $paymentInfo->mobile          = $requestParam['phone'];
            $paymentInfo->product_info    = $requestParam['productinfo'];
            $paymentInfo->name_on_card    = $requestParam['ccname'];
            $paymentInfo->txn_id          = $requestParam['txnid'];
            $paymentInfo->amount          = floatval($requestParam['amount']);
            $paymentInfo->user_id         = $requestParam['email'];

            $paymentInfo->save();

         //    DB::Insert('insert into payment_info (email,first_name,last_name,mobile,product_info,name_on_card,txn_id ,amount,user_id) 
      	 	// values (?, ?,?,?,?,?,?,?,?)', [$requestParam['email'],$requestParam['firstname'] ,$requestParam['lastname'],$requestParam['phone'],$requestParam['productinfo'],$requestParam['ccname'],$requestParam['txnid'],floatval($requestParam['amount']),$requestParam['email']]);


             
           // if MONGO_USE is yes in env then log all data in mongo
             if(env('MONGO_USE')=="YES") {
                  // storing request log and headers in mongo
                 echo "hii"; die;
                  DB::connection('mongodb')->collection('log')->insert($requestParam);
                  DB::connection('mongodb')->collection('requestHeaders')->insert($formatedHeaders);
             }
                   
      	 
             
      }

      /**
        method to use update status of transaction
    **/
      public function updateStatus($requestParam,$status,$headers) {

      	
             $formatedHeaders = $this->formatHeaders($headers);
             
             // update status of initiated transation whether failed or success
             
             $paymentStatus    = new paymentStatus;

             paymentStatus::where('txn_id', $requestParam['txnid'])
                                    ->update(['payment_flag' => $status['status']]);

             // DB::Update("update payment_status set payment_flag = '".$status['status']."'  where txn_id = '".$requestParam['txnid']."'"); 
      	 
             // if MONGO_USE is yes in env then log all data in mongo
             if(env('MONGO_USE')=="YES") {
                   // storing response log and headers in mongo
                   DB::connection('mongodb')->collection('responseLog')->insert($requestParam);
                   DB::connection('mongodb')->collection('responseHeaders')->insert($formatedHeaders);
             }
      }

      public function formatHeaders($headers){
            $formatedHeaders = array();
            foreach($headers as $key=>$val){
               $formatedHeaders[$key] = $val[0];
             
            }
            return $formatedHeaders;
      }

      public function formatRequest($requestParam){

            unset($requestParam['ccnum']);
            unset($requestParam['ccexpyr']);
            unset($requestParam['ccexpmon']);
            return $requestParam;
      }

}
?>