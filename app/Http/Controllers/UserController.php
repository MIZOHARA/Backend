<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpCodeRequest;
use App\Http\Resources\OtpCodeResource;
use App\Models\otp;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login_user(Request $request)
    {
        $user = User::where('number', $request->number)->first();
        if ($user) {
            $otp = otp::create([
                'number'=>$request->number,
                'otp'=>rand(100000,999999
                )]);
            return response()->json(['message'=>'user exist','data'=> new OtpCodeResource($otp)]);
        }
        else {
            return response()->json(['user not found']);
        }
    }

    public function check_otp(OtpCodeRequest $otpCodeRequest)
    {
        $otp = otp::where('number',$otpCodeRequest->number)->where('otp',$otpCodeRequest->otp)->first();
        if ($otp){
            $otp->delete();
            $user = User::where('number',$otpCodeRequest->number)->first();
            $token = $user->createToken($user->name);
            return response()->json(['message'=>'done','data'=> $user, $token->plainTextToken]);
        }
        else {
            return response()->json(['otp not found']);
        }
    }
}
