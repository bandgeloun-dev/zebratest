@if(session('success-add'))
    <div class="alert alert-success">
        {{ session('success-add') }}
    </div>
@endif
