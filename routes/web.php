<?php
// routes/web.php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CyberpunkController;
use App\Http\Controllers\Admin\CharacterController as AdminCharacterController;
use App\Http\Controllers\Admin\CombatSuitController;
use App\Http\Controllers\Admin\CyberpunkAdminController;
use App\Http\Controllers\Admin\ShortStoryController;
use App\Http\Controllers\Admin\SignatureAbilityController;
use App\Http\Controllers\Admin\TalentController;
use App\Http\Controllers\Admin\WeaknessController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth routes
Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

// Front-facing routes
Route::get('/', [CyberpunkController::class, 'home'])->name('home');
Route::get('/rules', [CyberpunkController::class, 'rules'])->name('rules');
Route::get('/npcs', [CyberpunkController::class, 'npcs'])->name('npcs');
Route::get('/npcs/{id}', [CyberpunkController::class, 'showNpc'])->name('npcs.show');

// Character routes with detail page
Route::get('/characters', [CharacterController::class, 'index'])->name('characters');
Route::get('/characters/{id}', [CharacterController::class, 'show'])->name('characters.show');

Route::get('/world', [CyberpunkController::class, 'world'])->name('world');
Route::get('/recaps', [CyberpunkController::class, 'recaps'])->name('recaps');
Route::get('/powers', [CyberpunkController::class, 'powers'])->name('powers');

Route::get('/combat-suits/{id}', [CyberpunkController::class, 'combatSuitDetail'])->name('combat-suits.show');
Route::get('/talents/{id}', [CyberpunkController::class, 'talentDetail'])->name('talents.show');
Route::get('/weaknesses/{id}', [CyberpunkController::class, 'weaknessDetail'])->name('weaknesses.show');
Route::get('/signature-abilities/{id}', [CyberpunkController::class, 'signatureAbilityDetail'])->name('signature-abilities.show');
Route::get('/short-stories/{id}', [CyberpunkController::class, 'shortStoryDetail'])->name('short-stories.show');

// Add these to the existing routes
Route::get('/combat-suits', [CyberpunkController::class, 'combatSuits'])->name('combat-suits');
Route::get('/talents', [CyberpunkController::class, 'talents'])->name('talents');
Route::get('/weaknesses', [CyberpunkController::class, 'weaknesses'])->name('weaknesses');
Route::get('/signature-abilities', [CyberpunkController::class, 'signatureAbilities'])->name('signature-abilities');
Route::get('/short-stories', [CyberpunkController::class, 'shortStories'])->name('short-stories');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [CyberpunkAdminController::class, 'dashboard'])->name('dashboard');
    
    // Rules management
    Route::get('/rules', [CyberpunkAdminController::class, 'rules'])->name('rules.index');
    Route::get('/rules/create', [CyberpunkAdminController::class, 'createRule'])->name('rules.create');
    Route::post('/rules', [CyberpunkAdminController::class, 'storeRule'])->name('rules.store');
    Route::get('/rules/{rule}/edit', [CyberpunkAdminController::class, 'editRule'])->name('rules.edit');
    Route::put('/rules/{rule}', [CyberpunkAdminController::class, 'updateRule'])->name('rules.update');
    Route::delete('/rules/{rule}', [CyberpunkAdminController::class, 'destroyRule'])->name('rules.destroy');
    
    // NPCs management
    Route::get('/npcs', [CyberpunkAdminController::class, 'npcs'])->name('npcs.index');
    Route::get('/npcs/create', [CyberpunkAdminController::class, 'createNpc'])->name('npcs.create');
    Route::post('/npcs', [CyberpunkAdminController::class, 'storeNpc'])->name('npcs.store');
    Route::get('/npcs/{npc}/edit', [CyberpunkAdminController::class, 'editNpc'])->name('npcs.edit');
    Route::put('/npcs/{npc}', [CyberpunkAdminController::class, 'updateNpc'])->name('npcs.update');
    Route::delete('/npcs/{npc}', [CyberpunkAdminController::class, 'destroyNpc'])->name('npcs.destroy');
    
    // Characters management
    Route::resource('characters', AdminCharacterController::class);
    
    // Combat Suits management
    Route::resource('suits', CombatSuitController::class);
    
    // Talents management
    Route::resource('talents', TalentController::class);
    
    // Weaknesses management
    Route::resource('weaknesses', WeaknessController::class);
    
    // Signature Abilities management
    Route::resource('abilities', SignatureAbilityController::class);
    
    // Short Stories management
    Route::resource('stories', ShortStoryController::class);
    
    // World setting management
    Route::get('/world', [CyberpunkAdminController::class, 'world'])->name('world.index');
    Route::post('/world', [CyberpunkAdminController::class, 'updateWorld'])->name('world.update');
    
    // Recaps management
    Route::get('/recaps', [CyberpunkAdminController::class, 'recaps'])->name('recaps.index');
    Route::get('/recaps/create', [CyberpunkAdminController::class, 'createRecap'])->name('recaps.create');
    Route::post('/recaps', [CyberpunkAdminController::class, 'storeRecap'])->name('recaps.store');
    Route::get('/recaps/{recap}/edit', [CyberpunkAdminController::class, 'editRecap'])->name('recaps.edit');
    Route::put('/recaps/{recap}', [CyberpunkAdminController::class, 'updateRecap'])->name('recaps.update');
    Route::delete('/recaps/{recap}', [CyberpunkAdminController::class, 'destroyRecap'])->name('recaps.destroy');
    
    // Powers management
    Route::get('/powers', [CyberpunkAdminController::class, 'powers'])->name('powers.index');
    Route::get('/powers/create', [CyberpunkAdminController::class, 'createPower'])->name('powers.create');
    Route::post('/powers', [CyberpunkAdminController::class, 'storePower'])->name('powers.store');
    Route::get('/powers/{power}/edit', [CyberpunkAdminController::class, 'editPower'])->name('powers.edit');
    Route::put('/powers/{power}', [CyberpunkAdminController::class, 'updatePower'])->name('powers.update');
    Route::delete('/powers/{power}', [CyberpunkAdminController::class, 'destroyPower'])->name('powers.destroy');
});