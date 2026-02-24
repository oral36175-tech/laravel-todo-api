<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vazifa;

class DarsController extends Controller
{
    // 1. Sahifani ko'rsatish
    public function index()
    {
        $vazifalar = auth()->user()->vazifalar; 
        $ism = auth()->user()->name;

        return view('dars', compact('ism', 'vazifalar'));
    }

    // 2. Yangi vazifa qo'shish
    public function store(Request $request)
    {
        $request->validate(['nomi' => 'required|min:3']);

        auth()->user()->vazifalar()->create([
            'nomi' => $request->nomi
        ]);

        return redirect()->back();
    }

    // 3. Vazifani bajarildi/bajarilmadi deb belgilash
    public function update($id)
    {
        // Faqat o'ziga tegishli vazifani topish
        $vazifa = auth()->user()->vazifalar()->findOrFail($id);
        
        // Holatni teskarisiga o'zgartirish (0 bo'lsa 1, 1 bo'lsa 0)
        $vazifa->update([
            'bajarildi' => !$vazifa->bajarildi
        ]);

        return redirect()->back();
    }

    // 4. Vazifani o'chirish
    public function destroy($id)
    {
        // Faqat o'ziga tegishli vazifani topish va o'chirish
        $vazifa = auth()->user()->vazifalar()->findOrFail($id);
        $vazifa->delete();

        return redirect()->back();
    }
}