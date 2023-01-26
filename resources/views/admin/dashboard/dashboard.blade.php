<x-layout>


    <div class="page-content">
        <div class="row mt-5">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Registrations</h6>
                        <!-- form start-->
                        <form action="{{ route('dashboard') }}" method="get" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="datePickerExample">Debut Date</label>
                                <div class="input-group date datepicker" id="datePickerExample1">
                                    <input type="text" class="form-control" name="debutDate" {!! $debutDate==''
                                        ? ' value="' .now()->format('Y-m-d').'"'
                                    : ' value="' .$debutDate.'"' !!}><span class="input-group-addon"><i
                                            data-feather="calendar"></i></span>
                                    @error('debutDate')
                                    <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="datePickerExample">End Date</label>
                                <div class="input-group date datepicker" id="datePickerExample">
                                    <input type="text" class="form-control" name="endDate" {!! $endDate=='' ? ' value="'
                                        .now()->format('Y-m-d').'"'
                                    : ' value="' .$endDate.'"' !!}><span class="input-group-addon"><i
                                            data-feather="calendar"></i></span>
                                    @error('endDate')
                                    <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <input name="sub" type="submit" value="Filter"
                                class="btn btn-primary btn-icon-text mb-2  mt-2">
                            <!-- button to clear filters-->
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">clear</a>
                        </form>
                        <!-- form end-->
                        <!-- chart start-->
                        <div class="row">
                            <div class="col-6">
                                <canvas id="myBarChartRegistered"></canvas>
                            </div>
                            <div class="col-6">
                                <canvas id="myBarChartTurnover"></canvas>
                            </div>
                        </div>
                        <!-- chart end-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Registrations</h6>
                    <!-- dataview table start-->

                    <div class="table-responsive">
                        <table id="{!! $endDate == '' ? '' : 'dataTableExample' !!}" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>CNI</th>
                                    <th>CNE</th>
                                    <th>Referral</th>
                                    <th>Turnover</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($registrations as $registration)


                                <tr>
                                    <td>{{ $registration->name }}</td>
                                    <td>{{ $registration->email }}</td>
                                    <td>{{ $registration->phone }}</td>
                                    <td>{{ $registration->cni }}</td>
                                    <td>{{ $registration->cne }}</td>
                                    <td>{{ $registration->referral }}</td>
                                    <td>{{ $registration->turnover }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- dataview table start-->

                        <!-- links for pagination if the variable is empty-->
                        {!! $endDate == '' ? $registrations->links(): '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
    </div>
    </div>
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script>
        //code for turnover chart
        var xdataTurnover = JSON.parse('{!! json_encode($referralTurnover) !!}')
        var ydataTurnover = JSON.parse('{!! json_encode($sum) !!}')
        var colorsTurnover = []
        for (let index = 0; index <= xdataTurnover.length; index++) {
            if (xdataTurnover[index] == 'facebook') colorsTurnover.push('#139BF6')
            
            else if (xdataTurnover[index] == 'instagram') colorsTurnover.push('#FC0A61')

            else if (xdataTurnover[index] == 'linkdin') colorsTurnover.push('#0E68C3')

            else colorsTurnover.push('#FF0000')

        }
        //end

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
    </script>
    <script src="{{ asset('assets/js/myChart.js') }}"></script>
</x-layout>