<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $query = DB::table('ads')
            ->where('status', 'active');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $ads = $query->orderByDesc('created_at')->paginate(12)->withQueryString();

        // Suggestions: latest ads regardless of search (for empty state)
        $suggestions = DB::table('ads')
            ->where('status', 'active')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('ads.index', compact('ads', 'search', 'suggestions'));
    }
}
