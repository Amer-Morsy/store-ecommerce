<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OptionsController extends Controller
{
    public function index()
    {
        $options = Option::with(['product' => function ($prod) {
            $prod->select('id');
        }, 'attribute' => function ($attr) {
            $attr->select('id');
        }])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);

        return view('dashboard.options.index', compact('options'));
    }

    public function create()
    {
        $data = [];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('dashboard.options.create', $data);
    }

    public function store(OptionsRequest $request)
    {


        DB::beginTransaction();

        //validation
        $option = Option::create([
            'attribute_id' => $request->attribute_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
        ]);
        //save translations
        $option->name = $request->name;
        $option->save();
        DB::commit();

        return redirect()->route('admin.options')->with(['success' => 'تم ألاضافة بنجاح']);
    }


    public function edit($id)
    {
        $data = [];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        $option = Option::find($id);
        if (!$option)
            return redirect()->route('admin.options')->with(['error' => 'this item is not found']);

        $data['option'] = $option;
        return view('dashboard.options.edit', $data);

    }


    public function update($id, OptionsRequest $request)
    {
        try {
            $option = Option::find($id);
            if (!$option)
                return redirect()->route('admin.options')->with(['error' => 'this item is not found']);

            DB::beginTransaction();

            $option->attribute_id = $request->attribute_id;
            $option->product_id = $request->product_id;
            $option->price = $request->price;

            //save translations
            $option->name = $request->name;
            $option->save();

            DB::commit();
            return redirect()->route('admin.options')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.options')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {


    }

}
