<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Update Products
        $products = DB::table('products')->get();
        foreach ($products as $p) {
            $name = str_ireplace('Nordic', 'Danone', $p->name);
            $desc = str_ireplace('Nordic', 'Danone', $p->description);
            $mat = str_ireplace('Nordic', 'Danone', $p->material);
            $slug = Str::slug($name);

            if ($name !== $p->name || $desc !== $p->description || $slug !== $p->slug) {
                DB::table('products')->where('id', $p->id)->update([
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $desc,
                    'material' => $mat,
                ]);
            }
        }

        // Update Inspirations
        $inspirations = DB::table('inspirations')->get();
        foreach ($inspirations as $item) {
            $title = str_ireplace('Nordic', 'Danone', $item->title);
            $content = str_ireplace('Nordic', 'Danone', $item->content);
            $author = str_ireplace('Nordic', 'Danone', $item->author);
            $slug = Str::slug($title);

            if ($title !== $item->title || $content !== $item->content || $slug !== $item->slug) {
                DB::table('inspirations')->where('id', $item->id)->update([
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'author' => $author,
                ]);
            }
        }

        // Update Settings if any
        $settings = DB::table('settings')->get();
        foreach ($settings as $setting) {
            $val = str_ireplace('Nordic', 'Danone', $setting->value);
            if ($val !== $setting->value) {
                DB::table('settings')->where('id', $setting->id)->update(['value' => $val]);
            }
        }
    }

    public function down(): void
    {
        // irreversible
    }
};
