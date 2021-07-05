    @extends('app')

    @section('titulo', 'Página inicial')

    @section('conteudo')

    <div class="container">
        <h1>Página inicial</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOME</th>
                    <th scope="col">TELEFONE</th>
                    <th scope="col">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($diaristas as $diarista)
                <tr>
                    <th>{{ $diarista->id }}</th>
                    <td>{{ $diarista->nome_completo }}</td>
                    <td>{{ \Clemdesign\PhpMask\Mask::apply($diarista->telefone, '(00) 00000-0000') }}</td>
                    <td>
                        <a href=" {{route('diarista.edit', $diarista->id)}} "><button class="btn btn-primary">Editar</button></a>
                        <a href=" {{route('diarista.destroy', $diarista->id)}} "><button class="btn btn-danger" onClick=" return confirm('Deseja deletar?')">Deletar</button></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <th></th>
                    <td>Nenhum registro cadastrado</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('diarista.create') }}"><button class="btn btn-success">Cadastrar Diárista</button></a>
    </div>
    @endsection


