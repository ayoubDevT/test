<x-layout>

    <div class="page-content">
        <div class="row mt-5">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Upload your file</h6>
                        <form action="{{ route('import.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="import" type="file" id="myDropify" class="border"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            @error('import')
                            <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                            @enderror
                            <input type="submit" value="Import" class="btn btn-primary btn-icon-text mb-2  mt-2">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Session::get('success') == 'setted')
    <script>
        alert('your data successfully imported')
    </script>
    @php
    Illuminate\Support\Facades\Session::forget('success');
    @endphp
    @endif
</x-layout>