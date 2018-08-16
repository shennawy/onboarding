<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankAccount;
use App\User;

class BankAccountController extends Controller
{
    //
   
    public function show(User $user)
    {
        
        $bankAccount = BankAccount::where('user_id', $user->id)->get()->toArray();
        return $bankAccount;
    }

    public function showSingleAccount(BankAccount $bankAccount)
    {
        if ($bankAccount->isDeleted == 'true')
        {
            return json_decode('{"Status": "This Bank Account has been deleted"}', true);
        }

        else
            return $bankAccount;
    }

    public function store(Request $request)
    {
        $rules = array(
            'CurrencyId' => 'required|string|max:11',
            'BankName' => 'required|string|max:255',
            'HolderName' => 'required|string|max:255',
            'AccountNumber' => 'required|string|max:255',
            'BankLocation' => 'required|string|max:255',
            'SwiftCode' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id'
        );
        

        $this->validate(request(), $rules);
        $bankAccount = BankAccount::create($request -> all());
        return response()->json($bankAccount, 201);
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        $rules = array(
            'CurrencyId' => 'string|max:11',
            'BankName' => 'string|max:255',
            'HolderName' => 'string|max:255',
            'AccountNumber' => 'string|max:255',
            'BankLocation' => 'string|max:255',
            'SwiftCode' => 'string|max:255',
            'user_id' => 'exists:users,id'
        );

        $bankAccount->update($request->all());
        return response()->json($bankAccount, 200);
    }

    public function delete(BankAccount $bankAccount)
    {
        BankAccount::where('id',$bankAccount->id)->update(array('isDeleted'=>'true'));
        return response()->json(null, 204);
    }

}
