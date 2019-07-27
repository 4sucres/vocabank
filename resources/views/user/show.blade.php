@extends('layouts.app')

@section('title')
    Profil de {{ $user->name }}
@endsection

@section('content')

<div class="flex flex-wrap">
    <div class="w-1/4">
        <div class="bg-white shadow p-3">
            <div class="text-teal-500 font-bold mb-3">{{ $user->name }}</div>
            <p class="mb-3">Enfant perdu sur l'internet. Passionné d'informatique, de vidéo et de musique depuis mon plus jeune âge.</p>
            <div class="mb-3 text-gray-600"><i class="fas fa-link"></i> 4sucres.org/u/YvonEnbaver</div>
            <div class="mb-3 font-bold">
                <div class="text-3xl pb-0">15</div>
                <div class="-mt-2">écoutes</div>
            </div>
        </div>
    </div>
    <div class="pl-5 flex-1">
        <div class="bg-white border rounded shadow mb-3">
            @forelse ($samples as $sample)
                <sample-preview :sample="{{ $sample }}" :views="{{ views($sample)->count() }}"></sample-preview>
            @empty
                Aucun sample envoyé par l'utilisateur !
            @endforelse
        </div>

        {{ $samples->links() }}
    </div>
</div>
@endsection
