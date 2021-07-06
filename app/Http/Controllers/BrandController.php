<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


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

        /* //Pega extenção da imagem
        $img_ext = strtolower($brand_image->getClientOriginalExtension());

        //Gera um nome unico
        $name_gen = hexdec(uniqid());

        //Gera um novo nome unico para imagem com a extenção
        $img_name = $name_gen.'.'.$img_ext;

        //Local de uploado
        $up_location = 'image/brand/';

        //Sobe a imagem para a pasta com o novo nome unico
        $brand_image->move($up_location,$img_name); */


        //Gera um nome unico
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();

        //Local de uploado
        $up_location = 'image/brand/';

        //Redimenciona e move imagem
        Image::make($brand_image)->resize(300,200)->save($up_location.$name_gen);


        //Salva os dados no banco
        $brandData = new Brand;
        $brandData->brand_name = $request->brand_name;
        $brandData->brand_image = $up_location.$name_gen;
        $brandData->save();

        return Redirect()->back()->with('success', "Brand insert successful");
    }

    public function EditBrand($id){
        $brand = Brand::find($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function UpdateBrand(Request $request, $id) {

        $validated = $request->validate(

            [
                'brand_name' => 'required|min:4'
            ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => 'Brand Name Must Contain min 4 Chars'
            ],
        );

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

            //exclui imagem antiga
            unlink($request->old_img);
        }

        //Salva os dados
        $brand->brand_name = $request->brand_name;

        $brand->save();

        return Redirect()->back()->with('success', "Brand updated");
    }

    public function DeleteBrand($id) {

        $brand = Brand::find($id);
        unlink($brand->brand_image);

        $brand->delete();

        return Redirect()->back()->with('success', "Brand Deleted");
    }

    public function Multi(){
        $multi = Multipic::all();
        return view('admin.multi.index', compact('multi'));
    }

    public function AddImage(Request $request){

        //Pega dados da imagem
        $images = $request->file('image');

        foreach($images as $image){

            //Gera um nome unico
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            //Local de uploado
            $up_location = 'image/multi/';

            //Redimenciona e move imagem
            Image::make($image)->resize(300,200)->save($up_location.$name_gen);

            //Salva os dados no banco
            $imageData = new Multipic;
            $imageData->image = $up_location.$name_gen;
            $imageData->save();

        }

        return Redirect()->back()->with('success', "Images add succesfull");
    }
}
