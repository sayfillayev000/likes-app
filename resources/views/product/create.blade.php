<x-app-layout>
    <div class="container mx-auto max-w-4xl py-8 px-4">
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

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Yangi Mahsulot Qo'shish</h1>
            <p class="text-gray-600">Mahsulot haqida ma'lumotlarni kiriting va saqlang.</p>
        </div>

        <!-- Form -->
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Mahsulot nomi</label>
                <input type="text" name="title" id="title"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Mahsulot nomi..." required>
            </div>

            <!-- Description Input -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mahsulot Tavsifi</label>
                <textarea name="description" id="description" rows="5"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Mahsulot haqida batafsil ma'lumot..." required></textarea>
            </div>

            <!-- Photo Input -->
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Mahsulot Rasm</label>
                <input type="file" name="photo" id="photo"
                    class="block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    accept="image/*" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-1"
                    style="background-color: #4f46e5; color: white;">
                    Mahsulotni Saqlash
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
