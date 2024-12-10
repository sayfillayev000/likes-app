<x-app-layout>
    <div class="container mx-auto max-w-4xl py-8 px-6 contain-content">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                    </svg>
                </span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                    </svg>
                </span>
            </div>
        @endif

        <!-- Mahsulot haqida -->
        <div class="bg-white shadow-md rounded-lg mb-6 p-6">
            <div class="flex items-start space-x-6 justify-between">
                <!-- Mahsulot rasmi -->
                <img width="300" src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->title }}"
                    class="w-1/3 rounded-lg shadow-md">

                <div class="p-5">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $product->title }}</h1>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="text-sm text-gray-500 mt-4">
                        Qo'shilgan vaqt: <span class="font-medium">{{ $product->created_at->diffForHumans() }}</span>
                    </p>

                    <!-- Like tugmasi -->
                    <div class="mt-4 flex items-center space-x-4">
                        <form action="{{ route('like.store', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-md">
                                👍 Like ({{ $product->likes->count() }})
                            </button>
                        </form>
                        @if (auth()->id() === $product->user_id || auth()->user()->hasRole('admin'))
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg shadow-md">
                                    Mahsulotni o'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Kommentlar bo'limi -->
        <div class="bg-white shadow-md rounded-lg mb-6 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kommentlar</h2>

            @forelse ($product->comments as $comment)
                <div class="bg-gray-100 rounded-lg p-4 mb-3 flex justify-between">
                    <div>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                        <p class="text-sm text-gray-500 mt-2">Muallif: <span
                                class="font-medium">{{ $comment->user->name }}</span> •
                            {{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    @if (auth()->id() === $comment->user_id || auth()->user()->hasRole('admin'))
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg shadow-md">
                                O'chirish
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="text-gray-600">Hozircha komentlar yo'q. Birinchi bo'lib koment qoldiring!</p>
            @endforelse

            <!-- Komment qo'shish formasi -->
            <form action="{{ route('comment.store') }}" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <textarea name="content" rows="3" placeholder="Komment yozing..."
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                <button type="submit"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-md">
                    Komment qoldirish
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
