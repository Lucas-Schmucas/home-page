<div>
    @auth
        <div class="mt-6">
            <form wire:submit="save" class="space-y-4">
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-300 mb-2">
                        Upload Profile Image (max 2MB)
                    </label>
                    <input type="file"
                           id="image"
                           wire:model="image"
                           accept="image/*"
                           class="block w-full text-sm text-gray-300
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-medium
                                  file:bg-blue-500 file:text-white
                                  file:cursor-pointer
                                  hover:file:bg-blue-600
                                  file:transition-colors">
                    @error('image')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div wire:loading wire:target="image" class="text-sm text-blue-400">
                    Processing image...
                </div>

                @if ($image)
                    <div class="flex items-center gap-4">
                        @if(method_exists($image, 'isPreviewable') && $image->isPreviewable())
                            <img src="{{ $image->temporaryUrl() }}"
                                 alt="Preview"
                                 class="w-20 h-20 rounded-lg object-cover">
                        @endif
                        <button type="submit"
                                wire:loading.attr="disabled"
                                wire:target="image,save"
                                class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="save">Upload</span>
                            <span wire:loading wire:target="save">Uploading...</span>
                        </button>
                    </div>
                @endif
            </form>
        </div>
    @endauth
</div>
