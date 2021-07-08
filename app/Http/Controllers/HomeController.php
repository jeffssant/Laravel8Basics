<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::all();

        return view('admin.slider.index', compact('sliders'));
    }

    public function StoreSlider(Request $request) {

        //Pega dados da imagem
        $slider_image = $request->file('image');

         //Gera um nome unico
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();

        //Local de uploado
        $up_location = 'image/sliders/';

        //Redimenciona e move imagem
        Image::make($slider_image)->save($up_location.$name_gen); //Pra redmensionar use resize(400,100) antes do save

        //Salva os dados no banco
        $sliderData = new Slider;
        $sliderData->title = $request->title;
        $sliderData->description = $request->description;
        $sliderData->image = $up_location.$name_gen;
        $sliderData->save();

        return Redirect()->route('home.slider')->with('success', "Slider insert successful");

    }

    public function EditSlider($id){
        $slider = Slider::find($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function UpdateSlider(Request $request, $id){

        $sliderData= Slider::find($id);

        if($request->file('image')){
            //Pega dados da imagem
            $slider_image = $request->file('image');

            //Pega extenção da imagem
            $img_ext = strtolower($slider_image->getClientOriginalExtension());

            //Gera um nome unico
            $name_gen = hexdec(uniqid());

            //Gera um novo nome unico para imagem com a extenção
            $img_name = $name_gen.'.'.$img_ext;

            //Local de uploado
            $up_location = 'image/brand/';

            //Sobe a imagem para a pasta com o novo nome unico
            $slider_image->move($up_location,$img_name);

            //Aplica imagem ao objeto brand
            $sliderData->image = $up_location.$img_name;

            //exclui imagem antiga
            unlink($request->old_img);
        }

        //Salva os dados
        $sliderData->title = $request->title;
        $sliderData->description = $request->description;

        $sliderData->save();

        return Redirect()->back()->with('success', "Slider updated");

    }

    public function DeleteSlider($id) {

        $slider = Slider::find($id);
        unlink($slider->image);

        $slider->delete();

        return Redirect()->back()->with('success', "Slider Deleted");
    }


}
