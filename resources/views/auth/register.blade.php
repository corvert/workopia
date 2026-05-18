<x-layout>
    <div class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4">Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <x-inputs.text id="name" name="name" placeholder="John Doe" />
            <x-inputs.text id="email" name="email" type="email" placeholder="john@example.com" />
            <x-inputs.text id="password" name="password" type="password" placeholder="••••••••" />
            <x-inputs.text id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" />

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none">Register</button>
        </form>

        <p class="mt-4 text-gray-500">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a></p>
    </div>
</x-layout>