<?php

namespace App\Http\Controllers;

use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function createWallet(Request $requist){
        $requist->validate([
            'devise' => 'required|string'
        ]);

        $isExest = wallet::where('user_id',Auth::user()->id)->where('devise',$requist->devise)->exists();
        if($isExest){
            return response()->json([
                'status' => 'error',
                'message' => 'wallet dija exist'
            ]);
        }
        $wallet = wallet::create([
            'solde' => 0,
            'devise' => $requist->devise,
            'user_id' => Auth::user()->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'wallet create successfolly',
            'data' => $wallet
        ]);
    }

    public function index(){
        $wallets = Auth::user()->wallets;

        return response()->json([
            'status' => 'success',
            'data' => $wallets
        ]);
    }

    public function detailWallet($id){
        $wallet = wallet::where('id',$id)->first();

        return response()->json([
            'status' => 'success',
            'data' => $wallet
        ]);
    } 
}
