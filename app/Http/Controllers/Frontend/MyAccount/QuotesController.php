<?php

namespace App\Http\Controllers\Frontend\MyAccount;

use App\Http\Controllers\Controller;
use App\Models\Location\Location;
use App\Models\Quotation\Quote;
use App\Models\Quotation\QuoteComment;
use App\Notifications\NewQuoteMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use PDF;
use Sentinel;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::find(Sentinel::check()->id);
        $myquotes = $user->Quotes()->orderBy('created_at','Desc')->paginate(10);
        return view('frontend.account.my-quotes')->with('myquotes',$myquotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $myquote=[];
        $user=User::getUser();
        $myquote=$user->Quotes()->find($id);
        if($myquote)
            return view('frontend.account.quote-detail')->with('myquote',$myquote);
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $submitReq = $request->submit;

        if($submitReq =="addComment"){
            $quoteComment = new QuoteComment;
            $quoteComment->comment_type = '1';
            $quoteComment->quote_id = $id;
            $quoteComment->user_id = User::getId();
            $quoteComment->is_private = '0';
            $quoteComment->comment = $request->comment;

            $quoteComment->save();

            //Send Notification Assigned Sales Executive
            $quote=Quote::find($id);
            if($quote->AssignedTo)
            {
                $assignedUser=$quote->AssignedTo;
                $assignedUser->notify(new NewQuoteMessage($quote,"backend"));
            }
            //Send Notification to Supervisors
            //Get all Supervisors
            $role = Sentinel::findRoleBySlug('supervisor');
            $users = $role->users()->with('roles')->get();
            Notification::send($users, new NewQuoteMessage($quote,"backend"));

            return redirect()->route('quotes.show',$id)->with('success','Comment added successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function downloadPdf($id)
    {
        $myquote=[];
        $user=User::getUser();
        $myquote=$user->Quotes()->find($id);
        $quoteProducts = $myquote->QuoteDetails->where('status','=','3');
        $location = Location::first();

        
        $data['myquote'] = $myquote;
        $data['quoteProducts'] = $quoteProducts;
        $data['location'] = $location;

        $totalSum = $myquote->QuoteDetails()->where('status','=','3')->selectRaw('SUM(price * quantity) as total')->pluck('total');
        $data['total'] = $totalSum[0];


        $pdf = PDF::loadView('frontend.account.pdf',$data)->setOption('page-width', '210')
->setOption('page-height', '297')->setOption('margin-left', 2)->setOption('margin-right', 2)->setOption('margin-top', 2)->setOption('margin-bottom', 2);
        return $pdf->stream('Gap-Quotation-'.$id.'.pdf');
    }

}
