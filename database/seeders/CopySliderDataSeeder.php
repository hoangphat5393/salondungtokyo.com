<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumItem;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CopySliderDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = Slider::select('id', 'slider_id', 'name', 'name', 'name_en', 'sort', 'status', 'admin_id', 'created_at', 'updated_at')
            ->where('slider_id', 0)
            ->get();

        foreach ($sliders as $slider) {

            // $data = $slider->getAttributes();

            $data = Arr::except($slider->getAttributes(), ['id', 'slider_id']);

            // Tạo album mới
            $album = Album::create($data);

            $sliders_item = Slider::select(
                'id',
                'slider_id',
                'sub_name',
                'sub_name_en',
                'name',
                'name_en',
                'description',
                'description_en',
                'image',
                'image_en',
                'video',
                'video_en',
                'link_name',
                'link_name_en',
                'link',
                'link_en',
                'sort',
                'status',
                'admin_id',
                'created_at',
                'updated_at'
            )->where('slider_id', $slider->id)->get();

            // dd($album->id);

            if ($sliders_item) {
                foreach ($sliders_item as $item) {
                    // $data_child = collect($item)->except('id', 'slider_id', 'status');

                    $data_child = $item->getAttributes();
                    $data_child = Arr::except($item->getAttributes(), ['id', 'slider_id', 'status', 'admin_id']);

                    $album_item = new AlbumItem;
                    foreach ($data_child as $k => $v) {
                        $album_item->$k = $v;
                        $album_item->admin_id = 1;
                        $album_item->album_id = $album->id;
                        // $data_child['target'] = '_blank';
                    }
                    $album_item->save();
                }
            }
        }
    }
}
