<?php

namespace App\Http\Controllers;

use App\Models\registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RegistrationController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function create()
    {
        return view('client.form', ['origin' => request()->origin]);
    }

    public function store(Request $request)
    {

        $att = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10|starts_with:06,07',
            'cni' => 'required',
            'cne' => 'required',
        ]);

        $att['referral'] = request()->origin;


        registration::create($att);

        session(['alert' => 'set']);

        return back();

        
    }

    public function show(Request $request)
    {

        if (isset($request->sub)) {
            $request->validate([
                'debutDate' => 'required|before_or_equal:endDate',
                'endDate' => 'required|after_or_equal:debutDate',

            ]);

            $debutDate = $request->debutDate;
            $endDate = $request->endDate;
            $referral = [];
            $count = [];

            $charts = DB::table('registrations')
                ->select(DB::raw('referral,count(*) as count'))
                ->whereDate('created_at', '>=', $debutDate)
                ->whereDate('created_at', '<=', $endDate)
                ->groupBy('referral')
                ->get();


            foreach ($charts as $chart) {
                $referral[] = $chart->referral;
                $count[] = $chart->count;
            }

            $registrations = registration::whereDate('created_at', '>=', $debutDate)
                ->whereDate('created_at', '<=', $endDate)
                ->get();
        } else {

            $debutDate = '';
            $endDate = '';
            $referral = [];
            $count = [];
            $charts = DB::table('registrations')
                ->select(DB::raw('referral,count(*) as count'))
                ->groupBy('referral')
                ->get();


            foreach ($charts as $chart) {
                $referral[] = $chart->referral;
                $count[] = $chart->count;
            }

            $registrations = registration::paginate(15);
        }

        return view('admin.dashboard.dashboard', [
            'registrations' => $registrations,
            'referral' => $referral, 
            'count' => $count, 
            'debutDate' => $debutDate, 
            'endDate' => $endDate
        ]);
    }
}
