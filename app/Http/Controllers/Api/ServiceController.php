<?php

namespace Modules\Service\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Service\Models\Service;
use Nwidart\Modules\Facades\Module;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $products = Service::query()
            ->with(['images'])
            ->when(
                $request->str('q')->trim()->isNotEmpty(),
                fn(Builder $query,) => $query->where(
                    DB::raw('LOWER(`name`)'),
                    'like',
                    $request->str('q')
                        ->trim()
                        ->lower()
                        ->prepend('%')
                        ->append('%')
                        ->toString()
                )
            )
            ->when(Module::has('ServiceModule') && Module::find('ServiceModule')->isEnabled(), function ($query) {
                $query->with('category.image');
            })
            ->when($request->input('category_id') && Module::has('ServiceModule') && Module::find('ServiceModule')->isEnabled(), function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            })->active()
            ->simplePaginate();
        return response()->json($products);
    }


    public function show($id)
    {
        $product = Service::active()->with(['images'])->when(Module::has('ServiceModule') && Module::find('ServiceModule')->isEnabled(), function ($query) {
            $query->with('category.image');
        })->findOrFail($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        $product = Service::find($id);
        $product->delete();
        return response()->json(['message' => __('Deleted if existed.')]);

    }
}
