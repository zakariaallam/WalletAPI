<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function deposit(Request $request , $id){

        $request->validate([
            'montant' => 'required|numeric|min:0'
        ]);

        $wallet = wallet::where('id',$id)->firstOrFail();
        if(!$wallet){
            return response()->json([
                'status' => 'error',
                'message' => 'wallet not found'
            ]);
        }
        try{
            DB::beginTransaction();

            $wallet->solde += $request->montant;
            $wallet->save();

            Transaction::create([
                'amount' => $request->montant,
                'type' => 'deposit',
                'wallet_id' => $wallet->id
            ]);

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
              return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
              ]);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'deposit successfolly',
            'data' => $wallet
        ]);
    }
    public function withdraw(Request $request ,$id){
             $request->validate([
                'montant' => 'required|numeric|min:0'
             ]);

             $wallet = wallet::where('id',$id)->firstOrFail();
             if(!$wallet){
                return response()->json([
                    'status' => 'error',
                    'message' => 'wallet not found'
                ]);
             }
             if($request->montant > $wallet->solde){
                return response()->json([
                    'status' => 'error',
                    'message' => 'montant > solde'
                ]);
             }

            try{
            DB::beginTransaction();

            $wallet->solde -= $request->montant;
            $wallet->save();

            Transaction::create([
                'amount' => $request->montant,
                'type' => 'withdraw',
                'wallet_id' => $wallet->id
            ]);

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
              return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
              ]);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'withdraw successfolly',
            'data' => $wallet
        ]); 
    }
    public function transfer(Request $request ,$id){
        $request->validate([
            'montant' => 'required|numeric|min:0'
        ]);

        
    }
    public function transactions($id){

    }
}
