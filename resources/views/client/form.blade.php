<x-layoutClient>
    <div class="center">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Registration</h6>
                        <!-- form start-->

                        <form action="{{ route('registration.store', ['origin' => $origin]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title_en">Name</label>
                                <input value="{{ old('name') }}" type="text" class="form-control" id="name" name="name">
                                @error('name')
                                <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title_de">E-mail</label>
                                <input value="{{ old('email') }}" type="text" class="form-control" id="email"
                                    name="email">
                                @error('email')
                                <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title_fr">Phone Number</label>
                                <input value="{{ old('phone') }}" type="text" class="form-control" id="phone"
                                    name="phone">
                                @error('phone')
                                <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title_fr">CNI</label>
                                <input value="{{ old('cni') }}" type="text" class="form-control" id="cni" name="cni">
                                @error('cni')
                                <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title_fr">CNE</label>
                                <input value="{{ old('cne') }}" type="text" class="form-control" id="cne" name="cne">
                                @error('cne')
                                <p class="text-red-500 text-xs ml-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <input name="sub" type="submit" value="Ajouter"
                                class="btn btn-primary btn-icon-text mb-2  mt-2">
                        </form>
                        <!-- form end-->

                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-layoutClient>