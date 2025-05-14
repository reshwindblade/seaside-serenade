<x-layouts.error
    title="Conflict"
    code="409"
    message="Oops! Resource Conflict"
    description="The resource you're trying to access has been modified by another user."
    color="pink"
    :showAdminDetails="false">
    
    <x-slot:illustration>
        <x-errors.illustrations.409 />
    </x-slot>
    
    <x-slot:helpText>
        This magical item has been changed by another wizard. Please refresh and try again.
    </x-slot>
    
    <x-slot:actions>
        <x-errors.actions primaryColor="pink" :showTryAgain="true" />
    </x-slot>
</x-layouts.error>