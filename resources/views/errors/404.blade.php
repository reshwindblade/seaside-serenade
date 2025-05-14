<x-layouts.error
    title="Page Not Found"
    code="404"
    message="Oops! Page Not Found"
    description="The page you're looking for doesn't exist or has been moved."
    color="pink"
    :showAdminDetails="false">
    
    <x-slot:illustration>
        <x-errors.illustrations.404 />
    </x-slot>
    
    <x-slot:helpText>
        Don't worry, even the most powerful wizards sometimes get lost in the magical realm.
    </x-slot>
    
    <x-slot:actions>
        <x-errors.actions primaryColor="pink" />
    </x-slot>
</x-layouts.error>