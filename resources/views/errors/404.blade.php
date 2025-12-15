<x-layout>
    <div class="bg-gradient-to-br from-black/5 to-black/2 max-w-300 mx-auto mb-28 p-8 rounded-xl
    flex flex-col justify-center items-center gap-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-[var(--primary)] mt-4 text-center"
            >The page you are looking for could not be found...</h1>
        <div class="flex justify-center">
        <img src="{{ asset('images/404.png') }}" class="p-4  !w-100 !h-100" alt="sad lil guy 404">
        </div>
        <a href="/" class="btn"></i>Return Home</a>
    </div>
</x-layout>