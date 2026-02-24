<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\VazifaResource;

class VazifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vazifalar = auth()->user()->vazifalar;

        return VazifaResource::collection($vazifalar);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Kelayotgan ma'lumotni tekshirish
    $request->validate([
        'nomi' => 'required|string|min:3'
    ]);

    // 2. Login qilgan foydalanuvchiga bog'lab saqlash
    $vazifa = auth()->user()->vazifalar()->create([
        'nomi' => $request->nomi,
        'bajarildi' => false
    ]);

    // 3. Muvaffaqiyatli javob qaytarish
    return response()->json([
        'status' => 'success',
        'message' => 'Vazifa muvaffaqiyatli qo\'shildi',
        'data' => $vazifa
    ], 201); // 201 - "Muvaffaqiyatli yaratildi" degan kod
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $vazifa = auth()->user()->vazifalar()->findOrFail($id);

    $vazifa->update([
        'bajarildi' => !$vazifa->bajarildi
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Vazifa holati yangilandi',
        'data' => $vazifa
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vazifa = auth()->user()->vazifalar()->findOrFail($id);
    $vazifa->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Vazifa bazadan o\'chirildi'
    ]);
    }
}
