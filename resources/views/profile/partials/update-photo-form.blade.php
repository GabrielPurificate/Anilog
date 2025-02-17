<form method="POST" action="{{ route('profile.update.photo') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="photo" class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
        <input type="file" name="photo" id="photo" class="mt-1 block w-full">
    </div>

    <div class="mt-4">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
            Atualizar Foto
        </button>
    </div>
</form>