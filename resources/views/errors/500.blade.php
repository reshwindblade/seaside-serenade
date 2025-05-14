<x-layouts.error
    title="Server Error"
    code="500"
    message="Oops! Something went wrong"
    description="We're experiencing some technical difficulties. Please try again later."
    color="pink"
    :showAdminDetails="true"
    :exception="$exception">
    
    <x-slot:illustration>
        <x-errors.illustrations.500 />
    </x-slot>
    
    <x-slot:helpText>
        Our magical servers are having a moment. Our team of wizards is working to fix this.
    </x-slot>
    
    <x-slot:actions>
        <x-errors.actions primaryColor="pink" :showTryAgain="true" />
    </x-slot>
</x-layouts.error>