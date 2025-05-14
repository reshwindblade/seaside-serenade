<x-layouts.error
    title="Service Unavailable"
    code="503"
    message="Oops! Service Unavailable"
    description="We're currently performing some magical maintenance. Please try again later."
    color="pink"
    :showAdminDetails="false">
    
    <x-slot:illustration>
        <x-errors.illustrations.503 />
    </x-slot>
    
    <x-slot:helpText>
        Our magical servers are taking a short rest. They'll be back to casting spells soon!
    </x-slot>
    
    <x-slot:actions>
        <x-errors.actions primaryColor="pink" :showTryAgain="true" />
    </x-slot>
</x-layouts.error>