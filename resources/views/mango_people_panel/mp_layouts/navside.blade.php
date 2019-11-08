<div style=" position: fixed; width: 200px" class="list-group" id="" role="">
      <a class="list-group-item list-group-item-action text-center" href="{{ route("donor") }}" role="tab" aria-controls="home">Home</a>
      <a class="list-group-item list-group-item-action text-center"  href="{{ route("donor.details") }}" role="tab" aria-controls="profile">Profile</a>
      <a class="list-group-item list-group-item-action text-center"  href="{{ route("donor.request") }}" role="tab" aria-controls="messages">Request list</a>
      <a class="list-group-item list-group-item-action text-center"  href="{{ route("donor.donate.create") }}" role="tab" aria-controls="messages">Manage donate</a>
    
     <form 
       action="{{ route('donor.logout') }}" method="POST" >
            @csrf
            <input align="left" style=" width: 12.5em; " type="submit" class="btn btn-xs btn-block pull-left btn-outline-warning  " style="font-weight: bold" name="" value="Logout">
        </form>
    
    </div>