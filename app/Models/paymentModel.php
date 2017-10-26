<?php

namespace App\Models;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
 use Log;
class paymentModel {

      /**
        insert data in mysql db
        and if in env mongo_use is on then also log request header and request param in mongo db
      **/

      public function processUserPaymentDetails($requestParam,$headers) {

      	// echo '<pre>';print_r($headers); die;
            $formatedHeaders  =     $this->formateHeaders($headers);
            $requestParam      =     $this->formateRequest($requestParam);
      	 // $headers = array_values($headers);
             DB::Insert('insert into payment_status (txn_id, payment_flag,amount,user_id) 
      	 	values (?, ?,?,?)', [$requestParam['txnid'],'initiate' ,$requestParam['amount'],$requestParam['email']]);

      	 DB::Insert('insert into payment_info (email,first_name,last_name,mobile,product_info,name_on_card,txn_id ,amount,user_id) 
      	 	values (?, ?,?,?,?,?,?,?,?)', [$requestParam['email'],$requestParam['firstname'] ,$requestParam['lastname'],$requestParam['phone'],$requestParam['productinfo'],$requestParam['ccname'],$requestParam['txnid'],floatval($requestParam['amount']),$requestParam['email']]);


             
                 // if MONGO_USE is yes in env then log all data in mongo
                   if(env(MONGO_USE)=="YES") {
                        DB::connection('mongodb')->collection('log')->insert($requestParam);
                        DB::connection('mongodb')->collection('requestHeaders')->insert($formatedHeaders);
                   }
                   
      	 
             
      }

      /**
        method to use update status of transaction
    **/
      public function updateStatus($requestParam,$status,$headers) {

      	// echo "update payment_status set payment_flag = '".$status['status']."'  where txn_id = '".$requestParam['txnid']."'"; die;
      	 // print_r($requestParam); die;
             $formatedHeaders = $this->formateHeaders($headers);
             DB::Update("update payment_status set payment_flag = '".$status['status']."'  where txn_id = '".$requestParam['txnid']."'"); 
      	 if(env(MONGO_USE)=="YES") {
                   DB::connection('mongodb')->collection('responseLog')->insert($requestParam);
                   DB::connection('mongodb')->collection('responseHeaders')->insert($formatedHeaders);
             }
      }

      public function formateHeaders($headers){
            $formatedHeaders = array();
            foreach($headers as $key=>$val){
               $formatedHeaders[$key] = $val[0];
             
            }
            return $formatedHeaders;
      }

      public function formateRequest($requestParam){

            unset($requestParam['ccnum']);
            unset($requestParam['ccexpyr']);
            unset($requestParam['ccexpmon']);
            return $requestParam;
      }

}
?>