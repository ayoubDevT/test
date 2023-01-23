<x-layoutClient>
    <div class="center">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Choose your platform</h6>
                        <div class="row center">
                            <div class="col-6">
                                <a href="{{ route('registration.create', ['origin' => 'facebook']) }}"><img
                                        src="{{ asset('assets/images/104498_facebook_icon.png') }}" alt="facebook"
                                        class="img-width py-2"></a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('registration.create', ['origin' => 'instagram']) }}"><img
                                        src="{{ asset('assets/images/1161953_instagram_icon.png') }}" alt="instagram"
                                        class="img-width py-2"></a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('registration.create', ['origin' => 'linkdin']) }}"><img
                                        src="{{ asset('assets/images/104493_linkedin_icon.png') }}" alt="linkdin"
                                        class="img-width py-2"></a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('registration.create', ['origin' => 'youtube']) }}"><img
                                        src="{{ asset('assets/images/5279120_play_video_youtube_youtuble logo_icon.png') }}"
                                        alt="youtube" class="img-width py-2"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layoutClient>