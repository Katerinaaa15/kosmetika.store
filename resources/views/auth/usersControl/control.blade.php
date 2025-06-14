@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lietotāju pārvaldība</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vārds</th>
                <th>E-pasts</th>
                <th>Reģistrēts</th>
                <th>Statuss</th>
                <th>Darbība</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ optional($user->created_at)->format('Y-m-d H:i') }}</td>
                    <td>
                        @if($user->isBanned())
                            <span class="text-danger">Bloķēts ({{ optional($user->banned_at)->format('Y-m-d H:i') }})</span>
                        @else
                            <span class="text-success">Aktīvs</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.toggle-ban', $user) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $user->isBanned() ? 'btn-success' : 'btn-danger' }}"
                                onclick="return confirm('Vai tiešām vēlies {{ $user->isBanned() ? 'atbloķēt' : 'bloķēt' }} šo lietotāju?');">
                                {{ $user->isBanned() ? 'Atbloķēt' : 'Bloķēt' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nav atrastu lietotāju.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
