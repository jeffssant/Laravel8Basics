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


}
