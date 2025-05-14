<x-layouts.error
    title="Access Denied"
    code="403"
    message="Oops! Access Denied"
    description="You don't have permission to access this page."
    color="pink"
    :showAdminDetails="false">
    
    <x-slot:illustration>
        <x-errors.illustrations.403 />
    </x-slot>
    
    <x-slot:helpText>
        This magical realm is restricted. Please check your permissions or contact an administrator.
    </x-slot>
    
    <x-slot:actions>
        <x-errors.actions primaryColor="pink" />
    </x-slot>
</x-layouts.error>