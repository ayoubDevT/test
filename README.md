<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Test
## Technologies and languages used

- **[laravel](https://laravel.com/)**
- **[jetstream](https://jetstream.laravel.com/2.x/introduction.html)**
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
1- routes in the middleware are for admin because he has to login for consulting the dashboard <br>
2- login routes are not visible because I used jetstream to manage users

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

```php
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

<img src="https://github.com/ayoubDevT/test/blob/master/public/assets/images/readme/dashboadfiltered.png">

```php

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

```

<b>- That's how I get filtered data for chart and datatable and then send it to the blade</b><br>

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

### chart

<b>- how I use data coming from controller </b><br>

```js

        var xdata = JSON.parse('{!! json_encode($referral) !!}')
        var ydata = JSON.parse('{!! json_encode($count) !!}')
        var colors = []
        for (let index = 0; index <= xdata.length; index++) {
            if (xdata[index] == 'facebook') colors.push('#139BF6')
            
            else if (xdata[index] == 'instagram') colors.push('#FC0A61')

            else if (xdata[index] == 'linkdin') colors.push('#0E68C3')

            else colors.push('#FF0000')

            }
                
        
        
```

```js
var ctx = document.getElementById("myBarChart").getContext("2d");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: xdata,
        datasets: [{
            label: "Registrations",
            backgroundColor: colors,
            hoverBackgroundColor: "#2e59d9",
            borderColor: colors,
            data: ydata,
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
        }

    }
});
```

<h1 align="center">Thanks for reading</h1>
