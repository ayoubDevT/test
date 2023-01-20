<?php

namespace App\Http\Controllers;

use App\Models\registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RegistrationController extends Controller
{
    public function index($origin)
    {
        return view('client.form', ['origin' => $origin]);
    }

    public function store(Request $request, $origin)
    {

        $att = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'cni' => 'required',
            'cne' => 'required',
        ]);

        $att['referral'] = $origin;


        registration::create($att);
        
        return back();
    }

    public function show()
    {
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

        return view('admin.dashboard.dashboard', ['registrations' => $registrations, 'referral' => $referral, 'count' => $count, 'debutDate' => '', 'endDate' => '']);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'debutDate' => 'required|before_or_equal:endDate',
            'endDate' => 'required|after_or_equal:debutDate',

        ]);

        $debutDate = $request->input('debutDate');
        $endDate = $request->input('endDate');
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

        return view('admin.dashboard.dashboard', ['registrations' => $registrations, 'referral' => $referral, 'count' => $count, 'debutDate' => $debutDate, 'endDate' => $endDate]);
    }
}
