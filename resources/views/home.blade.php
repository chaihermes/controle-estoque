@extends('layouts.app')  <!--está extendendo os layouts de app, dentro da pasta layouts tem o arquivo app.blade.php que tem o template padrão. Se quiser trocar, por exemplo, pro natal é só fazer um arquivo natal.blade.php e usar esse no extends.-->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
