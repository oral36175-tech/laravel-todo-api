<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mening Vazifalarim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Salom, {{ $ism }}! 👋</h3>
                <p class="text-gray-600 mb-6">Maqsad: Senior Laravel Dasturchi bo'lish 🚀</p>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vazifa.store') }}" method="POST" class="mb-6 flex gap-2">
                    @csrf
                    <input type="text" name="nomi" placeholder="Yangi vazifa yozing..." 
                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Qo'shish
                    </button>
                </form>

                <ul class="space-y-3">
                    @forelse ($vazifalar as $vazifa)
                        <li class="flex justify-between items-center bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm">
                            
                            <span class="text-lg {{ $vazifa->bajarildi ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                {{ $vazifa->nomi }}
                            </span>

                            <div class="flex gap-2">
                                <form action="{{ route('vazifa.update', $vazifa->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="text-sm px-3 py-1 rounded font-semibold text-white transition {{ $vazifa->bajarildi ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }}">
                                        {{ $vazifa->bajarildi ? 'Bekor qilish' : 'Bajarildi' }}
                                    </button>
                                </form>

                                <form action="{{ route('vazifa.destroy', $vazifa->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded font-semibold transition">
                                        O'chirish
                                    </button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <p class="text-lg">Hozircha vazifalar yo'q. Birinchi vazifangizni qo'shing!</p>
                        </div>
                    @endforelse
                </ul>

            </div>
        </div>
    </div>
</x-app-layout>