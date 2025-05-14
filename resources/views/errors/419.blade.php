<x-layouts.error
    title="Page Expired"
    code="419"
    message="Oops! Page Expired"
    description="Your session has expired. Please refresh the page and try again."
    color="pink"
    :showAdminDetails="false">
    
    <x-slot:illustration>
        <x-errors.illustrations.419 />
    </x-slot>
    
    <x-slot:helpText>
        Your magical session has expired. Please refresh the page to continue your journey.
    </x-slot>
    
    <x-slot:actions>
        <x-errors.actions primaryColor="pink" :showTryAgain="true" />
    </x-slot>
</x-layouts.error>