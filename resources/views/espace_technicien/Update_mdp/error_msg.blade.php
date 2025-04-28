@if($errors->any())
      <div class="bg-red-50 border-l-4 border-red-500 p-4 mx-6 mt-4 rounded">
        <div class="flex items-center">
          <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
          <h3 class="text-red-800 font-medium">Erreurs à corriger</h3>
        </div>
        <ul class="mt-2 text-red-600 text-sm list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
