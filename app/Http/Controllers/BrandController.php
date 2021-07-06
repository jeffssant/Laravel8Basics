<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AllBrand(){

        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request){
        $validated = $request->validate(

            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg.jpeg,png'
            ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.unique' => 'Please Input different Brand Name',
                'brand_name.min' => 'Brand Name Must Contain min 4 Chars'
            ],
        );

        //Pega dados da imagem
        $brand_image = $request->file('brand_image');

        //Pega extenção da imagem
        $img_ext = strtolower($brand_image->getClientOriginalExtension());

        //Gera um nome unico
        $name_gen = hexdec(uniqid());

        //Gera um novo nome unico para imagem com a extenção
        $img_name = $name_gen.'.'.$img_ext;

        //Local de uploado
        $up_location = 'image/brand/';

        //Sobe a imagem para a pasta com o novo nome unico
        $brand_image->move($up_location,$img_name);

        //Salva os dados no banco
        $brandData = new Brand;
        $brandData->brand_name = $request->brand_name;
        $brandData->brand_image = $up_location.$img_name;
        $brandData->save();

        return Redirect()->back()->with('success', "Brand insert successful");
    }

    public function EditBrand($id){
        $brand = Brand::find($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function UpdateBrand(Request $request, $id) {

        $brand = Brand::find($id);

        if($request->file('brand_image')){
            //Pega dados da imagem
            $brand_image = $request->file('brand_image');

            //Pega extenção da imagem
            $img_ext = strtolower($brand_image->getClientOriginalExtension());

            //Gera um nome unico
            $name_gen = hexdec(uniqid());

            //Gera um novo nome unico para imagem com a extenção
            $img_name = $name_gen.'.'.$img_ext;

            //Local de uploado
            $up_location = 'image/brand/';

            //Sobe a imagem para a pasta com o novo nome unico
            $brand_image->move($up_location,$img_name);

            //Aplica imagem ao objeto brand
            $brand->brand_image = $up_location.$img_name;
        }

        //Salva os dados
        $brand->brand_name = $request->brand_name;

        $brand->save();

        return Redirect()->back()->with('success', "Brand updated");
    }
}
