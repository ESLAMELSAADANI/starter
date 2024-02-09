<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function getOffers()
    {
        return Offer::get(); //$hiddenومش هترجع ال موجوده في ال$fillableال موجوده في الtable = offersبترجعلي كل البيانات بتاع ال 
    }

    public function getSpecificOffer()
    {
        return Offer::select('id', 'name')->get(); //مش كله$fillableدي لو عايز ارجع حاجه معينه من 
    }

    public function store()
    {
        Offer::create([ //to insert data into database
            'name' => 'Eslam',
            'price' => '500',
            'details' => 'this price after discount',
        ]);
    }

    public function form()
    {
        return view('offers.form');
    }
    public function store2(Request $request)
    {
        //validate $request(name,price,details) before inserting to database
        //make($request,[rules],[messages])3arraysبتاخد makeفي لارفل وبتاخد ميثود اسمهاclassدي عباره عنvalidatorال 
        //$request->all()  =>make جوا arrayدا عشان احول الريكوست ال جايلي ل 

        //best practice ->make([],[],[]) بدل الكتابه جوا 
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // return $validator->errors(); //$validator->errors()->first();عشان يرجعلي كل الأخطاءوعشان يرجعلي اول خطأ بس بستخدم

            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
        ]);

        return redirect()->back()->with(['success' => 'تم إضافة العرض بنجاح']);
    }
    // best practice =>$this->(function name);عملنا فانكشن للرولز والماسدج ونادينا عليهم فوق ب 
    function getRules()
    {
        return $rules = [
            'name' => 'required|max:191|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required'
        ];
    }

    function getMessages()
    {
        return $messages = [
            //دا في حالة لو الموقع بيدعم لغات مختلفه
            //messages =>lang دا اسم الفولدر جوا ال 
            //messages.key => key-> عباره عن الاسم ال هيترجم في اللغات كلها
            'name.required' => __('messages.offer name required'),
            'name.unique' => __('messages.offer must be unique'),
            'price.required' => __('messages.offer price required'),
            'price.numeric' => __('messages.offer price must be numeric'),
            'details.required' => __('messages.offer details required')
        ];
    }
}
