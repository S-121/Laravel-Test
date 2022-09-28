<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends BaseController
{


    public function UserRegister(Request $request){
            
            if($request->username == ""){
                $response["status"] = "false";
                $response["msg"] = "Name field is required";
                $response["data"] = [];
                $response["response"] = "0";
                return response()->json($response);
            }else if($request->email == ""){
                $response["status"] = "false";
                $response["msg"] = "Email field is required";
                $response["data"] = [];
                $response["response"] = "0";
                return response()->json($response);
            }else if($request->mobile == ""){
                $response["status"] = "false";
                $response["msg"] = "Mobile field is required";
                $response["data"] = [];
                $response["response"] = "0";
                return response()->json($response);
            }else if($request->password ==""){
                $response["status"] = "false";
                $response["msg"] = "Password field is required";
                $response["data"] = [];
                $response["response"] = "0";
                return response()->json($response);
            }
            else{

                $insertData = new User;


                $insertData->username = $request->username;
                $insertData->email = $request->email;
                $insertData->mobile = $request->mobile;
                $insertData->password = Hash::make($request->password);

                $res = $insertData->save();

                if($res){

                    $details = [
                        'title' => 'Mail from ItSolutionStuff.com',
                        'body' => 'This is for testing email using smtp'
                    ];

                    Mail::to($request->email)->send(new \App\Mail\welcomeMail($details));

                    if (Mail::failures()) {
                        return response()->Fail('Sorry! Please try again latter');
                   }else{  
                        $response["status"] = "true";
                        $response["msg"] = "Your Data Successfuly Save..";
                        $response["data"] = $res;
                        $response["response"] = "1";
                        return response()->json($response);
                      }

                }else{
                    $response["status"] = "false";
                    $response["msg"] = "Your Data Not be Save...";
                    $response["data"] = [];
                    $response["response"] = "0";
                    return response()->json($response);
                }
            }
    }

    public function getData(Request $request){
        $getData = User::select()->get();


        if(count($getData) > 0){
            $response["status"] = "true";
            $response["msg"] = "Data Found Successful";
            $response["data"] = $getData;
            $response["response"] = count($getData);;
            return response()->json($response);
        }else{
            $response["status"] = "false";
            $response["msg"] = "Data not Found";
            $response["data"] = [];
            $response["response"] = "0";
            return response()->json($response);
        }
    }


    public function delete(Request $request){

        if($request->id == ""){
            $response["status"] = "false";
            $response["msg"] = "Please Enter id";
            $response["data"] = [];
            $response["response"] = "0";
            return response()->json($response);
        }else{
            $getData = User::where('id',$request->id)->get("email");
    
            if($getData){
                foreach($getData as $value){
                    $email =  $value["email"];
                }    
            }else{
                $response["status"] = "false";
                $response["msg"] = "Incorrect id";
                $response["data"] = [];
                $response["response"] = "0";
                return response()->json($response);
            }
        }

       

        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];

        

        if($getData){
            Mail::to($email)->send(new \App\Mail\removeAccount($details));
        }

        $delete = User::where('id',$request->id)->delete();


        if($getData){
            $response["status"] = "true";
            $response["msg"] = "Data Delete Successful";
            $response["response"] = 1;
            return response()->json($response);
        }else{
            $response["status"] = "false";
            $response["msg"] = "Data not Delete";
            $response["data"] = [];
            $response["response"] = "0";
            return response()->json($response);
        }
    }


    public function update(Request $request){
        $getData = User::where('id',$request->id)->get();


       

        if($getData){
            $updateData = ["username"=>$request->username , "mobile"=>$request->mobile , "email"=> $request->email];
            
            $requestUpdate = User::where("id",$request->id)->update($updateData);

            if($requestUpdate){
                $response["status"] = "true";
                $response["msg"] = "Data Update Successful";
                $response["response"] = 1;
                return response()->json($response);
            }else{
                $response["status"] = "false";
                $response["msg"] = "Data Not Be Update";
                $response["response"] = 0;
                return response()->json($response);
            }

            
        }else{
            $response["status"] = "false";
            $response["msg"] = "Data not Found";
            $response["data"] = [];
            $response["response"] = "0";
            return response()->json($response);
        }
    }
  
  
}
