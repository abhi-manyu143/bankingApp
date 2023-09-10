<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts;
use App\Models\Credits;
use App\Models\Debits;
use App\Models\User;
use App\Models\Transactions;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class BankingController extends Controller
{
    public function creditAmount(Request $request)
    {
        return view('banking.credit_view');
    }

    public function add_amount(Request $request)
    {
        // dd($request->all());
        if (Auth::user()) {
            $id = Auth::user()->id;
        }
        $validator = Validator::make($request->all(), [
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => 'Amount is required']);
        }

        $amount = $request->amount;
        $account_balance = Accounts::select('balance')->where('user_id', $id)->first();
        // dd($account_balance);
        if ($account_balance) {
            $balance = $account_balance->balance;
            $update_amount = $balance + $amount;

            // $account_balance->update(['balance' => $update_amount]);
            Accounts::where('user_id', $id)->update(['balance' => $update_amount]);
            $credit = new Transactions();
            $credit->user_id = $id;
            $credit->transaction_amount = $amount;
            $credit->type = 'Credit';
            $credit->details = 'Deposit';
            $credit->current_balance = $update_amount;
            $credit->save();

            return response()->json(['Updated' => 'Amount Added successfully']);
        } else {

            $new = new Accounts();
            $new->user_id = $id;
            $new->balance = $amount;
            $new->save();

            $credit = new Transactions();
            $credit->user_id = $id;
            $credit->transaction_amount = $amount;
            $credit->type = 'Credit';
            $credit->details = 'Deposit';
            $credit->current_balance = $amount;
            $credit->save();

            return response()->json(['Updated' => 'Account Added successfully']);

        }
    }

    public function withdrawView()
    {
        return view('banking.debit_view');
    }

    public function withdraw_amount(Request $request)
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
        }
        // dd($request->all());  

        $validator = Validator::make($request->all(), [
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => 'Amount is required']);
        }

        $amount = $request->amount;

        $acoount_balance = Accounts::select('balance')->where('user_id', $id)->first();

        if ($acoount_balance) {
            $balance = $acoount_balance->balance;
            if ($balance < $amount) {
                return response()->json(['Low_balance' => 'Insufficient Balance']);
            } else {
                $update_balance = $balance - $amount;
                Accounts::where('user_id', $id)->update(['balance' => $update_balance]);
                $debit = new Transactions();
                $debit->user_id = $id;
                $debit->transaction_amount = $amount;
                $debit->type = 'Debit';
                $debit->details = 'Withdraw';
                $debit->current_balance = $update_balance;
                $debit->save();

                return response()->json(['success' => 'Transaction Success']);
            }

        } else {
            return response()->json(['Low_balance' => 'Insufficient Balance']);
        }
    }

    public function Transfer_view()
    {
        return view('banking.Transfer');
    }

    public function Transfer_Money(Request $request)
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => 'Check Your Inputs']);
        }

        $email = $request->email;
        $amount = $request->amount;

        $acoount_balance = Accounts::select('balance')->where('user_id', $id)->first();

        $balance = $acoount_balance->balance;

        $rec_email = User::where('email', $email)->first();
        $rec_account_details = Accounts::where('user_id', $rec_email->id)->first();
        if ($rec_account_details) {
            $rec_acc_balance = $rec_account_details->balance;
        }

        if ($rec_email) {
            if ($rec_email->email == Auth::user()->email) {
                return response()->json(['errors' => 'Something went wrong']);
            } else {
                if ($acoount_balance->balance < $amount) {
                    return response()->json(['errors' => 'Insufficient Balance']);
                } else {
                    $update_balance = $balance - $amount;
                    $type_to = 'Transfer to ' . $email;
                    $type_from = 'Transfer from ' . Auth::user()->email;
                    Accounts::where('user_id', $id)->update(['balance' => $update_balance]);
                    $debit = new Transactions();
                    $debit->user_id = $id;
                    $debit->transaction_amount = $amount;
                    $debit->details = $type_to;
                    $debit->type = 'Debit';
                    $debit->current_balance = $update_balance;
                    $debit->save();

                    if ($rec_account_details) {
                        $update_balance_in = $rec_acc_balance + $amount;
                        Accounts::where('user_id', $rec_email->id)->update(['balance' => $update_balance_in]);

                        $credit_to = new Transactions();
                        $credit_to->user_id = $rec_email->id;
                        $credit_to->transaction_amount = $amount;
                        $credit_to->type = 'Credit';
                        $credit_to->details = $type_from;
                        $credit_to->current_balance = $update_balance_in;
                        $credit_to->save();

                        return response()->json(['success' => 'Transaction Success']);
                    } else {

                        $new = new Accounts();
                        $new->user_id = $rec_email->id;
                        $new->balance = $amount;
                        $new->save();

                        $credit_to = new Transactions();
                        $credit_to->user_id = $rec_email->id;
                        $credit_to->transaction_amonut = $amount;
                        $credit_to->type = 'Credit';
                        $credit_to->current_balance = $amount;
                        $credit_to->details = $type_from;
                        $credit_to->save();

                        return response()->json(['success' => 'Transaction Success']);
                    }
                }
            }
        } else {
            return response()->json(['errors' => 'Email is not available']);
        }

    }

    public function view_statement(Request $request)
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $account_statement = Transactions::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        }else
        {
            $account_statement = null;
        }
        return view('banking.statement', compact('account_statement'));
    }
}