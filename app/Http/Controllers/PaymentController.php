<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    // public function process(Request $request)
    // {
    //     $selectedRoute = $request->input('payment');

    //     switch ($selectedRoute) {
    //         case 'pay':
    //             return $this->pay($request);
    //         case 'link':
    //             return $this->linkPay($request);
    //             // Add more cases for other routes
    //         default:
    //             flash()->addError('Invalid Route');
    //             return redirect()->back();
    //     }
    // }

    public function pay(Request $request)
    {
        $cardid = $request->input('cardid');

        // Debugging statement
        // dd($cardid);

        // Check if the cardid exists in the revenue table
        $revenueRecord = Card::where('card_id', $cardid)->first();

        if (!$revenueRecord) {
            // Cardid does not exist in the revenue table, you can handle this case as per your requirement
            // For example, redirect back with an error message
            return redirect()->back()->with('error', 'Card ID not found in the revenue table.');
        }

        // If the cardid exists, continue with the payment process
        // Rest of your payment processing code here...
        $amount = $request->input('credits');
        // $cardid = $request->input('cardid');
        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => [
                        [
                            'currency'      => 'PHP',
                            'amount'        => $amount * 100,
                            'description'   => 'text',
                            'name'          => 'Add Credits',
                            'quantity'      => 1,
                        ]
                    ],
                    'payment_method_types' => [
                        'card', 'gcash'
                    ],
                    'success_url' => route('payment.success', ['cardid' => $cardid, 'credits' => $amount]),
                    'cancel_url' => 'http://127.0.0.1:8000/cancel',
                    'description' => 'text'
                ],
            ]
        ];

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
            ->withHeader('Content-Type: application/json')
            ->withHeader('accept: application/json')
            ->withHeader('Authorization: Basic c2tfdGVzdF9xeEdvR3g0dXZycG1yaXJ0VkVpY2lmNGg6')
            ->withData($data)
            ->asJson()
            ->post();

        // dd($response);
        Session::put('session_id', $response->data->id);

        return redirect()->to($response->data->attributes->checkout_url);
    }

    public function success(Request $request, $cardid)
    {
        // $sessionId = Session::get('session_id');

        // $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/' . $sessionId)
        //     ->withHeader('accept: application/json')
        //     ->withHeader('Authorization: Basic c2tfdGVzdF9xeEdvR3g0dXZycG1yaXJ0VkVpY2lmNGg6')
        //     ->asJson()
        //     ->get();

        // dd($response);


        $creditsToAdd = $request->input('credits'); // Credits from the request

        // Retrieve the current card_amount from the database
        $user = Card::where('card_id', $cardid)->first();

        if ($user) {
            // Calculate the new card_amount by adding the existing value to the creditsToAdd
            $newCardAmount = $user->card_amount + $creditsToAdd;

            // Update the User record with the new card_amount
            $user->update([
                'card_amount' => $newCardAmount,
            ]);

            flash()->addSuccess('Successful Credits Transaction');
        } else {
            flash()->addError('User not found'); // Handle the case where the user is not found
        }

        // Redirect or return a success response
        return redirect()->route('dashboard');
    }

    public function cancel()
    {
        flash()->addError('Unsuccessfull Credits Transaction');

        return view('dashboard');
    }




    // public function linkPay(Request $request)
    // {
    //     $amount = $request->input('credits');
    //     $data['data']['attributes']['amount'] = $amount * 100;
    //     $data['data']['attributes']['description'] = 'Add Credits.';

    //     $response = Curl::to('https://api.paymongo.com/v1/links')
    //         ->withHeader('Content-Type: application/json')
    //         ->withHeader('accept: application/json')
    //         ->withHeader('Authorization: Basic c2tfdGVzdF9xeEdvR3g0dXZycG1yaXJ0VkVpY2lmNGg6')
    //         ->withData($data)
    //         ->asJson()
    //         ->post();

    //     // dd($response);

    //     return redirect()->to($response->data->attributes->checkout_url);
    // }

    // public function linkStatus($linkid)
    // {
    //     $response = Curl::to('https://api.paymongo.com/v1/links/' . $linkid)
    //         ->withHeader('accept: application/json')
    //         ->withHeader('Authorization: Basic c2tfdGVzdF9xeEdvR3g0dXZycG1yaXJ0VkVpY2lmNGg6')
    //         ->asJson()
    //         ->get();

    //     // dd($response);
    //     dd($response);
    // }


    // public function refund()
    // {

    //     $data['data']['attributes']['amount']       = 5000;
    //     $data['data']['attributes']['payment_id']   = 'pay_sA83KrtmJUdue8prEHD6rZrY';
    //     $data['data']['attributes']['reason']       = 'duplicate';

    //     $response = Curl::to('https://api.paymongo.com/refunds')
    //         ->withHeader('Content-Type: application/json')
    //         ->withHeader('accept: application/json')
    //         ->withHeader('Authorization: Basic c2tfdGVzdF9xeEdvR3g0dXZycG1yaXJ0VkVpY2lmNGg6')
    //         ->withData($data)
    //         ->asJson()
    //         ->post();

    //     dd($response);
    // }

    // public function refundStatus($id)
    // {
    //     $response = Curl::to('https://api.paymongo.com/refunds/' . $id)
    //         ->withHeader('accept: application/json')
    //         ->withHeader('Authorization: Basic c2tfdGVzdF9xeEdvR3g0dXZycG1yaXJ0VkVpY2lmNGg6')
    //         ->asJson()
    //         ->get();

    //     dd($response);
    // }
}
