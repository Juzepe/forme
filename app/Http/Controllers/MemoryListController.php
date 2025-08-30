<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MemoryListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memoryLists = Auth::user()->memoryLists()->with('items')->get();

        return Inertia::render('MemoryLists/Index', [
            'memoryLists' => $memoryLists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('MemoryLists/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.content' => 'required|string|max:1000',
        ]);

        $memoryList = Auth::user()->memoryLists()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        foreach ($request->items as $index => $item) {
            $memoryList->items()->create([
                'content' => $item['content'],
                'position' => $index + 1,
            ]);
        }

        return redirect()->route('memory-lists.show', $memoryList)->with('success', 'Memory list created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $memoryList = Auth::user()->memoryLists()->with('items')->findOrFail($id);

        return Inertia::render('MemoryLists/Show', [
            'memoryList' => $memoryList,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $memoryList = Auth::user()->memoryLists()->with('items')->findOrFail($id);

        return Inertia::render('MemoryLists/Edit', [
            'memoryList' => $memoryList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.content' => 'required|string|max:1000',
        ]);

        $memoryList = Auth::user()->memoryLists()->findOrFail($id);
        $memoryList->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Delete existing items and recreate them
        $memoryList->items()->delete();

        foreach ($request->items as $index => $item) {
            $memoryList->items()->create([
                'content' => $item['content'],
                'position' => $index + 1,
            ]);
        }

        return redirect()->route('memory-lists.show', $memoryList)->with('success', 'Memory list updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $memoryList = Auth::user()->memoryLists()->findOrFail($id);
        $memoryList->delete();

        return redirect()->route('memory-lists.index')->with('success', 'Memory list deleted successfully!');
    }

    /**
     * Start memory test for the specified list.
     */
    public function startTest(string $id)
    {
        $memoryList = Auth::user()->memoryLists()->with('items')->findOrFail($id);

        return Inertia::render('MemoryLists/Test', [
            'memoryList' => $memoryList,
        ]);
    }

    /**
     * Check memory test results.
     */
    public function checkTest(Request $request, string $id)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'nullable|string',
        ]);

        $memoryList = Auth::user()->memoryLists()->with('items')->findOrFail($id);
        $items = $memoryList->items;

        $correct = 0;
        $total = $items->count();
        $results = [];

        foreach ($items as $index => $item) {
            $userAnswer = $request->answers[$index] ?? '';
            // Ensure empty answers are treated as empty strings
            $userAnswer = is_string($userAnswer) ? trim($userAnswer) : '';
            $isCorrect = !empty($userAnswer) && strtolower($userAnswer) === strtolower(trim($item->content));

            if ($isCorrect) {
                $correct++;
            }

            $results[] = [
                'position' => $item->position,
                'expected' => $item->content,
                'user_answer' => $userAnswer,
                'is_correct' => $isCorrect,
            ];
        }

        $score = round(($correct / $total) * 100, 2);

        return Inertia::render('MemoryLists/TestResults', [
            'memoryList' => $memoryList,
            'results' => $results,
            'score' => $score,
            'correct' => $correct,
            'total' => $total,
        ]);
    }
}
