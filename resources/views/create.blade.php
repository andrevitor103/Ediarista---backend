    @extends('app')
    @section('titulo', 'Nova Diárista')

    @section('conteudo')

    <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Nova Diárista</h1>
        <form action="{{ route('diarista.store') }}" method="POST" enctype="multipart/form-data">
        @include('_form');
        </form>
    </div>
    @endsection

