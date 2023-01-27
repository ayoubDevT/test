<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Test
## Technologies and languages used

- **[laravel](https://laravel.com/)**
- **[jetstream](https://jetstream.laravel.com/2.x/introduction.html)**
- **[laravel excel](https://laravel-excel.com/)**
- **[bootstrap](https://getbootstrap.com/)**
- **[jQuery](https://jquery.com/)**

## Configs and intallations

### clone the repo in your machine

### create new database in phpmyadmin

### Rename .env.example file to .env

### update composer

```
composer install
```

### generate your key

```
php artisan key:generate
```

### migrate database

```
php artisan migrate
```
### run seeder commande to fill database with fake data

```
php artisan db:seed
```

### run your project in your navigator

```
php artisan serve
```
## Explanations

### Routes

```php
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [RegistrationController::class, 'show'])->name('dashboard');
});

//client registration
Route::get('/', [RegistrationController::class, 'index'])->name('index');
Route::resource('registration', RegistrationController::class);
```

### Routes after adding excel

```php
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [RegistrationController::class, 'show'])->name('dashboard');
    Route::resource('import', ImportController::class);
});
```

1- routes in the middleware are for admin because he has to login for consulting the dashboard <br>
2- login routes are not visible because I used jetstream to manage users

### import data page for admin

![Screenshot 2023-01-26 142828](https://user-images.githubusercontent.com/54582274/214847384-8bb8029b-e19f-48dc-8e77-cead3fea6ca1.png)

<b>code I used for importing data from excel files :</b>

<b> In app\Imports\RegistrationsImport.php</b>

```php
<?php

namespace App\Imports;

use App\Models\registration;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegistrationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new registration([
            'updated_at'=>$row['updated_at'],
            'created_at'=> $row['created_at'],
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'cni' => $row['cni'],
            'cne' => $row['cne'],
            'referral' => $row['referral'],
            'turnover' => $row['turnover'],
        ]);
    }
}
```
<b> In the controller app\Http\Controllers\ImportController.php</b>

```php
public function store(Request $request)
    {
        $request->validate([
            'import' => 'required',
        ]);

        Excel::import(new RegistrationsImport, request()->file('import'));
        
        return back()->with('success', 'setted');
        
    }
    
```

<b> In the blade we have an input type file that accept only excel files</b>

```html
<input name="import" type="file" id="myDropify" class="border"
       accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
```

### First page
<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/index.png">

<b>I used this page to simplify getting traffic from where the user comes write it manually in the url because we don't have a real traffic to track</b>

### Form page
<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/createblank.png">

<b>- As you can see the traffic setted automatically in the url in the form page</b><br>

<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/createwitherrors.png">

```php
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
```
<b>- That's how I validate user's information with the code</b><br>

<b>- And after the form is validate I store it in the database and diffuse a message to the user</b><br>

<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/createwithalert.png">

### login page

<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/login.png">

<b>- Login page using jetstream</b><br>

### Dashboard admin

<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/dashboardadmin.png">

<b>- This is the dashboard with datatable and a chart grouped by traffic to show data to the admin </b><br>

### New Dashboard admin with additional Chart for Turnovers

![screencapture-127-0-0-1-8000-2023-01-26-14_37_30](https://user-images.githubusercontent.com/54582274/214849493-2b98e2c3-c5bb-4e77-97ff-1257d5352da0.png)


```php
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
```
<b>- That's the code how I retreive data with 2 conditions if the submit request is setted you get data filtered by date if not you get all data</b><br>

<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/filterwitherrors.png">

```php

            $request->validate([
                'debutDate' => 'required|before_or_equal:endDate',
                'endDate' => 'required|after_or_equal:debutDate',

            ]);

```

<b>- The end date given has to be greater or equal than the start date to submit the filter</b><br>

<b>- After the validation we get a filtered data by two dates with the conservation of the dates choosed by the admin </b><br>

<b>- Button clear is used for clearing all filters</b><br>

<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/dashboardfiltred.png">

```php

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

```

<b>- That's how I get filtered data for charts and datatable and then send it to the blade</b><br>


```php
return view('admin.dashboard.dashboard', [
            'registrations' => $registrations,
            'referral' => $referral, 
            'count' => $count, 
            'debutDate' => $debutDate, 
            'endDate' => $endDate
        ]);
    }
```
### Import data page

![Screenshot 2023-01-27 102824](https://user-images.githubusercontent.com/54582274/215053402-74f3d75f-aa56-4026-8b2f-ebe75e2dfdbf.png)

<b>- You are allowed to upload only excel extensions</b><br>

![Screenshot 2023-01-27 102850](https://user-images.githubusercontent.com/54582274/215054003-f958de8c-7c5c-47e1-907f-c4cee15db12c.png)

<b>- After you choose your file you have to click on import button and you get this message</b><br>

![Screenshot 2023-01-27 103003](https://user-images.githubusercontent.com/54582274/215054284-877d986c-8c90-495e-a7fa-c131f1b957a1.png)

### chart

<b>- how I use data coming from controller </b><br>

```js

        //code for registration chart
        var xdataRegistered = JSON.parse('{!! json_encode($referralRegistered) !!}')
        var ydataRegistered = JSON.parse('{!! json_encode($count) !!}')
        var colorsRegistered = []
        for (let index = 0; index <= xdataRegistered.length; index++) {
            if (xdataRegistered[index] == 'facebook') colorsRegistered.push('#139BF6')
            
            else if (xdataRegistered[index] == 'instagram') colorsRegistered.push('#FC0A61')

            else if (xdataRegistered[index] == 'linkdin') colorsRegistered.push('#0E68C3')

            else colorsRegistered.push('#FF0000')

        }
        //end
                
        
        
```

```js
var myBarChartRegistered = document.getElementById("myBarChartRegistered").getContext("2d");
//code for turnover chart
var myBarChartR = new Chart(myBarChartRegistered, {
    type: 'bar',
    data: {
        labels: xdataRegistered,
        datasets: [{
            label: "By registrations",
            backgroundColor: colorsRegistered,
            hoverBackgroundColor: "#2e59d9",
            borderColor: colorsRegistered,
            data: ydataRegistered,
        }],
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function (value) { if (value % 1 === 0) { return value; } }
                }

            }]
        },
        title:{
            display:true,
            text:'Registrations Chart',
            fontSize:25
        }

    }
});
//end
```

> **Note**
> the registrations chart and turnovers chart have the same code in javaScript that's why I explain one 


<h1 align="center">Thanks for reading</h1>
