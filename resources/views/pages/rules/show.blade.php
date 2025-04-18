<?php

use App\Models\Rule;
use function Laravel\Folio\{name};
use Livewire\Volt\Component;

name('rules.show');

new class extends Component
{
    public Rule $rule;
    public $relatedRules = [];

    public function mount(Rule $rule)
    {
        if (!$rule->is_active) {
            abort(404);
        }
        
        $this->rule = $rule;
        
        // Get related rules from the same category
        $this->relatedRules = Rule::active()
            ->where('id', '!=', $rule->id)
            ->byCategory($rule->category)
            ->ordered()
            ->limit(3)
            ->get();
    }
};

?>

<x-layouts.magical-ocean>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Breadcrumbs -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-300 inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('rules') }}" class="text-gray-700 dark:text-gray-300 hover:text-pink-600 dark:hover:text-pink-300 ml-1 md:ml-2">Rules</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500 dark:text-gray-400 ml-1 md:ml-2 font-medium">{{ $rule->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <article class="magical-card overflow-hidden">
            <div class="magical-card-header px-6 py-4 flex justify-between items-center">
                <div>
                    <span class="badge-magical">{{ ucfirst($rule->category) }}</span>
                </div>
            </div>
            <div class="magical-card-body px-6 py-6">
                <h1 class="text-3xl font-bold text-pink-600 dark:text-pink-300 mb-4">{{ $rule->name }}</h1>
                
                <div class="prose prose-pink dark:prose-invert max-w-none markdown-content">
                    {!! \Illuminate\Support\Str::markdown($rule->description) !!}
                </div>
            </div>
        </article>

        <!-- Related Rules -->
        @if($relatedRules->count() > 0)
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Related Rules</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedRules as $relatedRule)
                        <a href="{{ route('rules.show', $relatedRule) }}" class="magical-card flex flex-col h-full transform transition hover:scale-[1.02]">
                            <div class="magical-card-body flex-grow">
                                <h3 class="text-lg font-bold mb-2 text-pink-600 dark:text-pink-300">{{ $relatedRule->name }}</h3>
                                <div class="mb-4">
                                    <span class="badge-magical">{{ ucfirst($relatedRule->category) }}</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 line-clamp-3">
                                    {{ Str::limit(strip_tags($relatedRule->description), 100) }}
                                </p>
                            </div>
                            <div class="px-6 py-3 bg-pink-50 dark:bg-pink-900/20 text-right">
                                <span class="text-pink-600 dark:text-pink-300 font-medium inline-flex items-center">
                                    Read More
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-10 text-center">
            <a href="{{ route('rules') }}" class="btn-magical-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Rules
            </a>
        </div>
    </div>
</x-layouts.magical-ocean>