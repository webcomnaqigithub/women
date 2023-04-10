<?php

namespace App\Http\Requests\Front\Mrchnt;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    { 
        //edit
        if(request()->item['product.code'] !== ''){
            return [
                'item.product\.label' => ['required'], //if the request name has doted name like : "prduct.label", we often use "\" before dot.
                'price.0.price\.currencyid' => ['required'],
                'price.0.price\.value' => ['required'],
                'price.1.price\.currencyid' => ['required'],
                'price.1.price\.value' => ['required'],
                'text.0.text\.content' => ['required'],
                'item.product\.code' => ['required'],
                'category.default-0.catalog\.id' => ['required', 'numeric'],
                'category.default-1.catalog\.id' => ['required', 'numeric'],
                'stock.0.stock\.stockdiff' => ['required', 'numeric'],
            ];
        }else{  //add
            return [
                'item.product\.label' => ['required'], //if the request name has doted name like : "prduct.label", we often use "\" before dot.
                // 'price.0.price\.rebate' => ['required'],
                'price.0.price\.currencyid' => ['required'],
                'text.0.text\.content' => ['required'],
                // 'item.product\.code' => ['required'],
                'media.0.file' => ['required'],
            ];
        }
        
    }

    public function messages()
    {
        return [
            'item.product.label.required' => 'ادخل اسم المنتج',
            'price.0.price.rebate.required' => 'ادخل نسبة الخصم',
            'price.0.price.currencyid.required' => 'ادخل سعر المنتج',
            'text.0.text.content.required' => 'ادخل وصف المنتج',
            'item.product.code.required' => 'ادخل كلمة رابط المنتج',
            'media.0.file.required' => 'ادخل صورة المنتج',
        ];
    }
}
