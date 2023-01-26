<?php

namespace App\Http\Controllers;

use App\Imports\RegistrationsImport;
use Maatwebsite\Excel\Facades\Excel;
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

        $referralTurnover = [];
        $sum = [];
        $referralRegistered = [];
        $count = [];

        if (isset($request->sub)) {
            $request->validate([
                'debutDate' => 'required|before_or_equal:endDate',
                'endDate' => 'required|after_or_equal:debutDate',

            ]);

            $debutDate = $request->debutDate;
            $endDate = $request->endDate;


            //code of chart data with turnover
            
            $charts = DB::table('registrations')
                ->select(DB::raw('referral,sum(turnover) as sum'))
                ->whereDate('created_at', '>=', $debutDate)
                ->whereDate('created_at', '<=', $endDate)
                ->groupBy('referral')
                ->get();


            foreach ($charts as $chart) {
                $referralTurnover[] = $chart->referral;
                $sum[] = number_format((float)$chart->sum, 2, '.', '') ;
            }
            //end

            //code of chart data with registrations
            
            $charts = DB::table('registrations')
                ->select(DB::raw('referral,count(*) as count'))
                ->whereDate('created_at', '>=', $debutDate)
                ->whereDate('created_at', '<=', $endDate)
                ->groupBy('referral')
                ->get();


            foreach ($charts as $chart) {
                $referralRegistered[] = $chart->referral;
                $count[] = $chart->count;
            }
            //end

            //code of datatable
            $registrations = registration::whereDate('created_at', '>=', $debutDate)
                ->whereDate('created_at', '<=', $endDate)
                ->get();
            //end
        } else {

            $debutDate = '';
            $endDate = '';

            //code of chart data with turnover
           
            $charts = DB::table('registrations')
                ->select(DB::raw('referral,sum(turnover) as sum'))
                ->groupBy('referral')
                ->get();


            foreach ($charts as $chart) {
                $referralTurnover[] = $chart->referral;
                $sum[] = number_format((float)$chart->sum, 2, '.', '') ;
            }
            //end

            //code of chart data with registrations
            
            $charts = DB::table('registrations')
                ->select(DB::raw('referral,count(*) as count'))
                ->groupBy('referral')
                ->get();


            foreach ($charts as $chart) {
                $referralRegistered[] = $chart->referral;
                $count[] = $chart->count;
            }
            //end

            //code of datatable
            $registrations = registration::paginate(15);
            //end
        }

        return view('admin.dashboard.dashboard', [
            'registrations' => $registrations,
            'referralRegistered' => $referralRegistered,
            'count' => $count,
            'referralTurnover' => $referralTurnover,
            'sum' => $sum,
            'debutDate' => $debutDate,
            'endDate' => $endDate
        ]);
    }
}
