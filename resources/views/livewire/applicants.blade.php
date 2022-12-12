
<div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


            @include('livewire.applicant-table')


            @if($updateMode)

                @include('livewire.applicant-update')

            @else
                {{--@guest()--}}
                @php
                    $app = DB::table('applicants')->where('applicants.applicant_id', auth()->user()->id)->get();
                @endphp
                @if($app == '[]')
                    @include('livewire.applicant-create')
                @endif


                {{--@endguest--}}
            @endif



</div>

