@if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    </div>
@endif

@if(Session :: has('success'))

  <p class="text-center">{{Session :: get('success') }}</p>


@endif
@if(Session :: has('error'))
<p class="text-center">{{Session :: get('error') }}</p>

@endif