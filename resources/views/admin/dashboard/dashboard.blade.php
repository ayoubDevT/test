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
                        <canvas id="myBarChart"></canvas>
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
        var xdata = JSON.parse('{!! json_encode($referral) !!}')
        var ydata = JSON.parse('{!! json_encode($count) !!}')
        var colors = []
        for (let index = 0; index <= xdata.length; index++) {
            if (xdata[index] == 'facebook') colors.push('#139BF6')
            
            else if (xdata[index] == 'instagram') colors.push('#FC0A61')

            else if (xdata[index] == 'linkdin') colors.push('#0E68C3')

            else colors.push('#FF0000')

            }
                
        
        console.log(colors)
    </script>
    <script src="{{ asset('assets/js/myChart.js') }}"></script>
</x-layout>