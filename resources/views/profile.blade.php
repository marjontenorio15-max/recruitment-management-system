<div class="header bg-primary text-center">
   <div class="card-title m-3">
       @if(auth()->user()->role_id == 1)
           <h1 class="text-white">Admin Profile</h1>
       @elseif(auth()->user()->role_id == 2)
           <h1 class="text-white">Employer Profile</h1>
       @else
           <h1 class="text-white">Applicant Profile</h1>
       @endif
   </div>

</div>
